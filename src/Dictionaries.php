<?php

declare(strict_types=1);

namespace Przeslijmi\AgileDataTerytPlug;

use Exception;

/**
 * Operation that reads data from JSON and merges it with date in current possesion.
 */
class Dictionaries
{

    /**
     * Delivers array of columns (details) defining every scope of TERYT (eg. v - voivodeships).
     *
     * @return array
     */
    public static function getDetails(): array
    {

        // Lvd.
        $loc    = $_ENV['LOCALE'];
        $locDet = 'Przeslijmi.AgileDataTerytPlug.details.';

        return [
            'v.teryt' => [
                'text' => $loc->get($locDet . 'v.teryt.desc'),
                'dataType' => 'txt',
                'data' => [
                    'data-visibleWhen' => 'v',
                ],
            ],
            'v.name' => [
                'text' => $loc->get($locDet . 'v.name.desc'),
                'dataType' => 'txt',
                'data' => [
                    'data-visibleWhen' => 'v',
                ],
            ],
            'v.nameUc' => [
                'text' => $loc->get($locDet . 'v.nameUc.desc'),
                'dataType' => 'txt',
                'data' => [
                    'data-visibleWhen' => 'v',
                ],
            ],
            'c.teryt' => [
                'text' => $loc->get($locDet . 'c.teryt.desc'),
                'dataType' => 'txt',
                'data' => [
                    'data-visibleWhen' => 'c',
                ],
            ],
            'c.type' => [
                'text' => $loc->get($locDet . 'c.type.desc'),
                'dataType' => 'txt',
                'data' => [
                    'data-visibleWhen' => 'c',
                ],
            ],
            'c.typeOriginal' => [
                'text' => $loc->get($locDet . 'c.typeOriginal.desc'),
                'dataType' => 'txt',
                'data' => [
                    'data-visibleWhen' => 'c',
                ],
            ],
            'c.name' => [
                'text' => $loc->get($locDet . 'c.name.desc'),
                'dataType' => 'txt',
                'data' => [
                    'data-visibleWhen' => 'c',
                ],
            ],
            'c.nameUc' => [
                'text' => $loc->get($locDet . 'c.nameUc.desc'),
                'dataType' => 'txt',
                'data' => [
                    'data-visibleWhen' => 'c',
                ],
            ],
            'c.suffix' => [
                'text' => $loc->get($locDet . 'c.suffix.desc'),
                'dataType' => 'txt',
                'data' => [
                    'data-visibleWhen' => 'c',
                ],
            ],
            'c.voivodeship.teryt' => [
                'text' => $loc->get($locDet . 'c.voivodeship.teryt.desc'),
                'dataType' => 'txt',
                'data' => [
                    'data-visibleWhen' => 'c',
                ],
            ],
            'c.voivodeship.name' => [
                'text' => $loc->get($locDet . 'c.voivodeship.name.desc'),
                'dataType' => 'txt',
                'data' => [
                    'data-visibleWhen' => 'c',
                ],
            ],
            'm.teryt' => [
                'text' => $loc->get($locDet . 'm.teryt.desc'),
                'dataType' => 'txt',
                'data' => [
                    'data-visibleWhen' => 'm',
                ],
            ],
            'm.type' => [
                'text' => $loc->get($locDet . 'm.type.desc'),
                'dataType' => 'txt',
                'data' => [
                    'data-visibleWhen' => 'm',
                ],
            ],
            'm.typeOriginal' => [
                'text' => $loc->get($locDet . 'm.typeOriginal.desc'),
                'dataType' => 'txt',
                'data' => [
                    'data-visibleWhen' => 'm',
                ],
            ],
            'm.name' => [
                'text' => $loc->get($locDet . 'm.name.desc'),
                'dataType' => 'txt',
                'data' => [
                    'data-visibleWhen' => 'm',
                ],
            ],
            'm.county.teryt' => [
                'text' => $loc->get($locDet . 'm.county.teryt.desc'),
                'dataType' => 'txt',
                'data' => [
                    'data-visibleWhen' => 'm',
                ],
            ],
            'm.county.name' => [
                'text' => $loc->get($locDet . 'm.county.name.desc'),
                'dataType' => 'txt',
                'data' => [
                    'data-visibleWhen' => 'm',
                ],
            ],
            'm.voivodeship.teryt' => [
                'text' => $loc->get($locDet . 'm.voivodeship.teryt.desc'),
                'dataType' => 'txt',
                'data' => [
                    'data-visibleWhen' => 'm',
                ],
            ],
            'm.voivodeship.name' => [
                'text' => $loc->get($locDet . 'm.voivodeship.name.desc'),
                'dataType' => 'txt',
                'data' => [
                    'data-visibleWhen' => 'm',
                ],
            ],
            'a.teryt' => [
                'text' => $loc->get($locDet . 'a.teryt.desc'),
                'dataType' => 'txt',
                'data' => [
                    'data-visibleWhen' => 'a',
                ],
            ],
            'a.type' => [
                'text' => $loc->get($locDet . 'a.type.desc'),
                'dataType' => 'txt',
                'data' => [
                    'data-visibleWhen' => 'a',
                ],
            ],
            'a.typeOriginal' => [
                'text' => $loc->get($locDet . 'a.typeOriginal.desc'),
                'dataType' => 'txt',
                'data' => [
                    'data-visibleWhen' => 'a',
                ],
            ],
            'a.name' => [
                'text' => $loc->get($locDet . 'a.name.desc'),
                'dataType' => 'txt',
                'data' => [
                    'data-visibleWhen' => 'a',
                ],
            ],
            'a.municipality.teryt' => [
                'text' => $loc->get($locDet . 'a.municipality.teryt.desc'),
                'dataType' => 'txt',
                'data' => [
                    'data-visibleWhen' => 'a',
                ],
            ],
            'a.municipality.name' => [
                'text' => $loc->get($locDet . 'a.municipality.name.desc'),
                'dataType' => 'txt',
                'data' => [
                    'data-visibleWhen' => 'a',
                ],
            ],
            'a.county.teryt' => [
                'text' => $loc->get($locDet . 'a.county.teryt.desc'),
                'dataType' => 'txt',
                'data' => [
                    'data-visibleWhen' => 'a',
                ],
            ],
            'a.county.name' => [
                'text' => $loc->get($locDet . 'a.county.name.desc'),
                'dataType' => 'txt',
                'data' => [
                    'data-visibleWhen' => 'a',
                ],
            ],
            'a.voivodeship.teryt' => [
                'text' => $loc->get($locDet . 'a.voivodeship.teryt.desc'),
                'dataType' => 'txt',
                'data' => [
                    'data-visibleWhen' => 'a',
                ],
            ],
            'a.voivodeship.name' => [
                'text' => $loc->get($locDet . 'a.voivodeship.name.desc'),
                'dataType' => 'txt',
                'data' => [
                    'data-visibleWhen' => 'a',
                ],
            ],
        ];
    }

    /**
     * Delivers file uri basing on scope.
     *
     * @param string $scope Chosen scope (v, c, m, a).
     *
     * @throws Exception When scope is not recognized.
     * @return string
     */
    public static function getFileUriForScope(string $scope): string
    {

        // Define dir.
        $result = rtrim(str_replace('\\', '/', $_ENV['PRZESLIJMI_ADTERYTPLUG_DESTINATION_DIR']), '/') . '/';

        // Add file basing on scope.
        if ($scope === 'v') {
            return $result . 'voivodeships.json';
        } elseif ($scope === 'c') {
            return $result . 'counties.json';
        } elseif ($scope === 'm') {
            return $result . 'municipalities.json';
        } elseif ($scope === 'a') {
            return $result . 'areas.json';
        }

        return '';
    }
}
