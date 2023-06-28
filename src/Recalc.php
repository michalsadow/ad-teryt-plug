<?php

declare(strict_types=1);

namespace Przeslijmi\AgileDataTerytPlug;

use Przeslijmi\AgileData\Tools\JsonSettings as Json;
use Przeslijmi\AgileDataTerytPlug\Exceptions\CombineFopException;
use Przeslijmi\AgileDataTerytPlug\Exceptions\DestinationDirUnreachableException;
use Przeslijmi\AgileDataTerytPlug\Exceptions\FileUnreachableException;
use stdClass;

/**
 * Parent for all recalcs.
 */
abstract class Recalc
{

    /**
     * Holds data from read CSV.
     *
     * @var array
     */
    private $data = [];

    /**
     * Reads CSV into memory, use `->getCsvDataAsIs` or `->getCsvDataWithHeader` to reach data.
     *
     * @param string $fileUri File uri to read from.
     *
     * @throws FileUnreachableException When file does not exists or is not reachable.
     * @return void
     */
    protected function readCsv(string $fileUri): void
    {

        // Check.
        if (file_exists($fileUri) === false || is_readable($fileUri) === false) {
            throw new FileUnreachableException([ $fileUri ]);
        }

        // Read from file.
        if (( $handle = fopen($fileUri, 'r') ) !== false) {
            while (( $record = fgetcsv($handle, 0, ';', '"') ) !== false) {

                // Add every record.
                $this->data[] = $record;
            }
        }
    }

    /**
     * Returns read data after adding keys to every record as contents of first row.
     *
     * @throws CombineFopException When count of header differs with count of row.
     * @return array
     */
    protected function getCsvDataWithHeader(): array
    {

        // Take header and make sure all columns are trimmed.
        $header = array_slice($this->data, 0, 1)[0];
        foreach ($header as $id => $head) {
            $header[$id] = $this->removeBomUtf8(trim($head));
        }

        // Prepare result array.
        $result = [];

        // Work with every row.
        foreach (array_slice($this->data, 1) as $rowId => $row) {

            // Ignore empty rows.
            if (empty($row) === true || empty(max($row)) === true) {
                continue;
            }

            // Check if combine is possible.
            if (count($header) !== count($row)) {
                throw new CombineFopException([
                    implode(', ', $header),
                    implode(', ', $row),
                ]);
            }

            // Add combined row to results.
            $result[$rowId] = array_combine($header, $row);
        }

        return $result;
    }

    /**
     * Clears memory of read data.
     *
     * @return void
     */
    protected function clearMemory(): void
    {

        $this->data = [];
    }

    /**
     * Saves array into json file.
     *
     * @param array  $data     Array to be saved.
     * @param string $fileName Name of a file to be used.
     *
     * @throws DestinationDirUnreachableException When it happenes.
     * @return void
     */
    protected function saveToJson(array $data, string $fileName): void
    {

        // Lvd.
        $dirUri = rtrim(str_replace('\\', '/', $_ENV['PRZESLIJMI_ADTERYTPLUG_DESTINATION_DIR']), '/') . '/';

        // Test.
        if (file_exists($dirUri) === false || is_dir($dirUri) === false) {
            throw new DestinationDirUnreachableException([ $dirUri ]);
        }

        // Convert data to JSON string and save it.
        file_put_contents(
            $dirUri . $fileName,
            json_encode($data, json_encode($info, Json::stdWrite()))
        );
    }

    /**
     * Removes BOM UTF-8 chars from string.
     *
     * @param string $string String to be cleared from BOM.
     *
     * @return string
     */
    private function removeBomUtf8(string $string): string
    {

        // Cut out if exists.
        if (substr($string, 0, 3) === chr(hexdec('EF')) . chr(hexdec('BB')) . chr(hexdec('BF'))) {
            return substr($string, 3);
        }

        return $string;
    }
}
