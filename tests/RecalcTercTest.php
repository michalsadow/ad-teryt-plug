<?php

declare(strict_types=1);

namespace Przeslijmi\AgileDataTerytPlug;

use PHPUnit\Framework\TestCase;
use Przeslijmi\AgileDataTerytPlug\Exceptions\CombineFopException;
use Przeslijmi\AgileDataTerytPlug\Exceptions\DestinationDirUnreachableException;
use Przeslijmi\AgileDataTerytPlug\Exceptions\FileUnreachableException;
use Przeslijmi\AgileDataTerytPlug\RecalcTerc;

/**
 * Methods for testing RecalcTerc tool.
 */
final class RecalcTercTest extends TestCase
{

    /**
     * Test if proper data works properly.
     *
     * @return void
     */
    public function testWorking(): void
    {

        // Config.
        $_ENV['PRZESLIJMI_ADTERYTPLUG_SOURCES_TERC']    = 'resources/forTests/tercExample.csv';
        $_ENV['PRZESLIJMI_ADTERYTPLUG_DESTINATION_DIR'] = 'resources/forTests/';

        // Lvd.
        $files = [
            'voivodeships.json' => [
                'length' => 16,
            ],
            'counties.json' => [
                'length' => 380,
            ],
            'municipalities.json' => [
                'length' => 2477,
            ],
            'areas.json' => [
                'length' => 1341,
            ],
            'terc.json' => [
                'length' => 4214,
            ],
        ];

        // Prepare.
        foreach (array_keys($files) as $fileName) {

            // Lvd.
            $uri = $_ENV['PRZESLIJMI_ADTERYTPLUG_DESTINATION_DIR'] . $fileName;

            // Delete file if it exists.
            if (file_exists($uri) === true) {
                unlink($uri);
            }

            // Check if it succeeded.
            $this->assertFalse(file_exists($uri));
        }

        // Start recalc.
        $rct = new RecalcTerc();
        $rct->perform();

        // Check if all files are present.
        foreach ($files as $fileName => $fileDef) {

            // Lvd.
            $uri = $_ENV['PRZESLIJMI_ADTERYTPLUG_DESTINATION_DIR'] . $fileName;

            // Check if succeeded.
            $this->assertTrue(file_exists($uri));
            $this->assertEquals($fileDef['length'], count((array) json_decode(file_get_contents($uri))));
        }
    }

    /**
     * Test if wrong csv file throws.
     *
     * @return void
     */
    public function testIfWrongCsvUriThrows(): void
    {

        // Config.
        $_ENV['PRZESLIJMI_ADTERYTPLUG_SOURCES_TERC']    = 'wrong.csv';
        $_ENV['PRZESLIJMI_ADTERYTPLUG_DESTINATION_DIR'] = 'resources/forTests/';

        // Prepare.
        $this->expectException(FileUnreachableException::class);

        // Start recalc.
        $rct = new RecalcTerc();
        $rct->perform();
    }

    /**
     * Test if wrong destination dir throws.
     *
     * @return void
     */
    public function testIfWrongDestinationDirThrows(): void
    {

        // Config.
        $_ENV['PRZESLIJMI_ADTERYTPLUG_SOURCES_TERC']    = 'resources/forTests/tercExample.csv';
        $_ENV['PRZESLIJMI_ADTERYTPLUG_DESTINATION_DIR'] = 'wrong-destination-dir';

        // Prepare.
        $this->expectException(DestinationDirUnreachableException::class);

        // Start recalc.
        $rct = new RecalcTerc();
        $rct->perform();
    }

    /**
     * Test if wrong csv contents throws.
     *
     * @return void
     */
    public function testIfWrongCsvContentsThrows(): void
    {

        // Config.
        $_ENV['PRZESLIJMI_ADTERYTPLUG_SOURCES_TERC']    = 'resources/forTests/tercWrong.csv';
        $_ENV['PRZESLIJMI_ADTERYTPLUG_DESTINATION_DIR'] = 'resources/forTests/';

        // Prepare.
        $this->expectException(CombineFopException::class);

        // Start recalc.
        $rct = new RecalcTerc();
        $rct->perform();
    }
}
