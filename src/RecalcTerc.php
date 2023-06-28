<?php

declare(strict_types=1);

namespace Przeslijmi\AgileDataTerytPlug;

use Przeslijmi\AgileDataTerytPlug\Recalc;
use stdClass;

/**
 * Converts TERYT CSV file into JSON data.
 */
class RecalcTerc extends Recalc
{

    /**
     * Memory of voivodeships calculated from CSV file.
     *
     * @var array
     */
    private $voivodeships = [];

    /**
     * Memory of cuonties calculated from CSV file.
     *
     * @var array
     */
    private $cuonties = [];

    /**
     * Memory of municipalities calculated from CSV file.
     *
     * @var array
     */
    private $municipalities = [];

    /**
     * Memory of areas calculated from CSV file.
     *
     * @var array
     */
    private $areas = [];

    /**
     * Flat index calculated from CSV file.
     *
     * @var array
     */
    private $index = [];

    /**
     * Local dictionary of types of counties.
     *
     * @var array
     */
    private $countiesTypes = [
        'powiat' => 'std',
        'miasto na prawach powiatu' => 'city',
        'miasto stołeczne, na prawach powiatu' => 'city',
    ];

    /**
     * Local dictionary of types of municipalities.
     *
     * @var array
     */
    private $municipalitiesTypes = [
        'gmina miejska' => 'rural',
        'gmina wiejska' => 'urban',
        'gmina miejsko-wiejska' => 'mixed',
        'gmina miejska, miasto stołeczne' => 'capitalCity',
    ];

    /**
     * Local dictionary of types of areas.
     *
     * @var array
     */
    private $areasTypes = [
        'obszar wiejski' => 'rural',
        'miasto' => 'town',
        'delegatura' => 'delegacy',
        'dzielnica' => 'district',
    ];

    /**
     * Performs operation.
     *
     * @return void
     */
    public function perform(): void
    {

        // Prepare CSV source.
        $this->readCsv($_ENV['PRZESLIJMI_ADTERYTPLUG_SOURCES_TERC']);
        $csv = $this->getCsvDataWithHeader();
        $this->clearMemory();

        // Serve all data.
        foreach ($csv as $row) {

            // Lvd.
            $type   = null;
            $result = [];

            // Add one of levels.
            if (empty($row['POW']) === true) {
                $type   = 'voivodeship';
                $result = $this->addVoivodeship($row);
            } elseif (empty($row['GMI']) === true) {
                $type   = 'county';
                $result = $this->addCounty($row);
            } elseif (in_array((int) $row['RODZ'], [ 1, 2, 3 ]) === true) {
                $type   = 'municipality';
                $result = $this->addMunicipality($row);
            } else {
                $type   = 'area';
                $result = $this->addArea($row);
            }

            // Add flat teryt index dictionary.
            $this->addToIndex($type, $result);
        }//end foreach

        // Save to jsons.
        $this->saveToJson($this->voivodeships, 'voivodeships.json');
        $this->saveToJson($this->counties, 'counties.json');
        $this->saveToJson($this->municipalities, 'municipalities.json');
        $this->saveToJson($this->areas, 'areas.json');
        $this->saveToJson($this->index, 'terc.json');
    }

    /**
     * Adds voivodeship to object memory.
     *
     * @param array $row Full row from CSV file.
     *
     * @return array
     */
    private function addVoivodeship(array $row): array
    {

        // Define.
        $key  = (string) $row['WOJ'];
        $data = [
            'teryt' => $key,
            'name' => mb_strtolower($row['NAZWA']),
            'nameUc' => $row['NAZWA'],
        ];

        // Add.
        $this->voivodeships[$key] = $data;

        return $data;
    }

    /**
     * Adds county to object memory.
     *
     * @param array $row Full row from CSV file.
     *
     * @return array
     */
    private function addCounty(array $row): array
    {

        // Define.
        $key  = (string) ( $row['WOJ'] . $row['POW'] );
        $type = $this->countiesTypes[$row['NAZWA_DOD']];
        $data = [
            'teryt' => $key,
            'type' => $type,
            'typeOriginal' => $row['NAZWA_DOD'],
            'name' => $row['NAZWA'],
            'nameUc' => mb_strtoupper($row['NAZWA']),
            'suffix' => '',
            'voivodeship' => [
                'teryt' => (string) $row['WOJ'],
                'name' => $this->voivodeships[$row['WOJ']]['name'],
            ],
        ];

        // Correct name and suffix for `city`.
        if ($type === 'city') {
            $data['name']   = ucfirst($data['name']);
            $data['suffix'] = 'mnpp.';
        }

        // Add.
        $this->counties[$key] = $data;

        return $data;
    }

    /**
     * Adds municipality to object memory.
     *
     * @param array $row Full row from CSV file.
     *
     * @return array
     */
    private function addMunicipality(array $row): array
    {

        // Define.
        $key  = (string) ( $row['WOJ'] . $row['POW'] . $row['GMI'] . $row['RODZ'] );
        $type = $this->municipalitiesTypes[$row['NAZWA_DOD']];
        $data = [
            'teryt' => $key,
            'type' => $type,
            'typeOriginal' => $row['NAZWA_DOD'],
            'name' => $row['NAZWA'],
            'county' => [
                'teryt' => (string) ( $row['WOJ'] . $row['POW'] ),
                'name' => $this->counties[( $row['WOJ'] . $row['POW'] )]['name'],
            ],
            'voivodeship' => [
                'teryt' => (string) $row['WOJ'],
                'name' => $this->voivodeships[$row['WOJ']]['name'],
            ],
        ];

        // Add.
        $this->municipalities[$key] = $data;

        return $data;
    }

    /**
     * Adds area to object memory.
     *
     * @param array $row Full row from CSV file.
     *
     * @return array
     */
    private function addArea(array $row): array
    {

        // Find type.
        $type = $this->areasTypes[$row['NAZWA_DOD']];

        // Find parent.
        if (in_array($type, [ 'rural', 'town' ]) === true) {
            $parent = (string) ( $row['WOJ'] . $row['POW'] . $row['GMI'] . '3' );
        } else {
            $parent = (string) ( $row['WOJ'] . $row['POW'] . '011' );
        }

        // Define.
        $key  = (string) ( $row['WOJ'] . $row['POW'] . $row['GMI'] . $row['RODZ'] );
        $data = [
            'teryt' => $key,
            'type' => $type,
            'typeOriginal' => $row['NAZWA_DOD'],
            'name' => $row['NAZWA'],
            'municipality' => [
                'teryt' => $parent,
                'name' => $this->municipalities[$parent]['name'],
            ],
            'county' => [
                'teryt' => (string) ( $row['WOJ'] . $row['POW'] ),
                'name' => $this->counties[( $row['WOJ'] . $row['POW'] )]['name'],
            ],
            'voivodeship' => [
                'teryt' => (string) $row['WOJ'],
                'name' => $this->voivodeships[$row['WOJ']]['name'],
            ],
        ];

        // Correct delegacy.
        if ($type === 'delegacy') {
            $data['name'] = substr($data['name'], ( strpos($data['name'], '-') + 1 ));
        }

        // Add.
        $this->areas[$key] = $data;

        return $data;
    }

    /**
     * Adds flat index entry to object memory.
     *
     * @param string $type    Is it municipality, county, etc.
     * @param array  $element Element from memory (actual voivodeship, county, etc.).
     *
     * @return void
     */
    private function addToIndex(string $type, array $element): void
    {

        // Define type.
        $key  = $element['teryt'];
        $name = '';

        // Define name.
        if ($type === 'voivodeship') {
            $name = 'woj. ' . $element['name'];

        } elseif ($type === 'county' && $element['type'] === 'city') {
            $name = 'woj. ' . $element['voivodeship']['name'] . ', ' . $element['name'] . ' (mnpp.)';

        } elseif ($type === 'county') {
            $name = 'woj. ' . $element['voivodeship']['name'] . ', pow. ' . $element['name'];

        } elseif ($type === 'municipality' && $element['type'] === 'capitalCity') {
            $name  = 'woj. ' . $element['voivodeship']['name'] . ', pow. ' . $element['county']['name'];
            $name .= ', m.st. ' . $element['name'];

        } elseif ($type === 'municipality') {
            $name  = 'woj. ' . $element['voivodeship']['name'] . ', pow. ' . $element['county']['name'];
            $name .= ', gm. ' . $element['name'];

        } elseif ($type === 'area' && $element['type'] === 'district') {
            $name  = 'woj. ' . $element['voivodeship']['name'] . ', pow. ' . $element['county']['name'];
            $name .= ', m.st. ' . $element['municipality']['name'] . '';
            $name .= ', dzielnica ' . $element['name'] . '';

        } elseif ($type === 'area' && $element['type'] === 'delegacy') {
            $name  = 'woj. ' . $element['voivodeship']['name'] . ', pow. ' . $element['county']['name'];
            $name .= ', gm. ' . $element['municipality']['name'] . '';
            $name .= ', delegatura ' . $element['name'] . '';

        } elseif ($type === 'area') {
            $name  = 'woj. ' . $element['voivodeship']['name'] . ', pow. ' . $element['county']['name'];
            $name .= ', gm. ' . $element['municipality']['name'] . ' (' . $element['typeOriginal'] . ')';

        }//end if

        // Define data.
        $data = [
            'teryt' => $key,
            'type' => $type,
            'name' => $name,
        ];

        // Add.
        $this->index[$key] = $data;
    }
}
