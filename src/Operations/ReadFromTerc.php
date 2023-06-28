<?php

declare(strict_types=1);

namespace Przeslijmi\AgileDataTerytPlug\Operations;

use Przeslijmi\AgileData\Operations\OperationsInterface as MyInterface;
use Przeslijmi\AgileData\Operations\Reading\ReadFromJson as MyParent;
use Przeslijmi\AgileDataTerytPlug\Dictionaries;
use stdClass;

/**
 * Operation that reads data from TERYT TERC JSON file.
 */
class ReadFromTerc extends MyParent implements MyInterface
{

    /**
     * Operation key.
     *
     * @var string
     */
    protected static $opKey = 'sNrNJB93';

    /**
     * Only those fields are accepted for this operation.
     *
     * @var array
     */
    public static $operationFields = [
        'scope',
        'details',
    ];

    /**
     * Get info (mainly name and category of this operation).
     *
     * @return stdClass
     */
    public static function getInfo(): stdClass
    {

        // Lvd.
        $locSta = 'Przeslijmi.AgileDataTerytPlug.Operations.ReadFromTerc.';

        // Lvd.
        $result             = new stdClass();
        $result->name       = $_ENV['LOCALE']->get($locSta . 'title');
        $result->vendor     = 'Przeslijmi\AgileDataTerytPlug';
        $result->class      = self::class;
        $result->depr       = false;
        $result->category   = 100;
        $result->sourceName = $_ENV['LOCALE']->get($locSta . 'sourceName');

        return $result;
    }

    /**
     * Deliver fields to edit settings of this operation.
     *
     * @param string        $taskId Id of task in which edited step is present.
     * @param stdClass|null $step   Opt. Only when editing step (when creating it is null).
     *
     * @return array
     *
     * @phpcs:disable Generic.CodeAnalysis.UnusedFunctionParameter
     */
    public static function getStepFormFields(string $taskId, ?stdClass $step = null): array
    {

        // Lvd.
        $fields = [];
        $loc    = $_ENV['LOCALE'];
        $locSta = 'Przeslijmi.AgileDataTerytPlug.Operations.ReadFromTerc.fields.';
        $locSco = 'Przeslijmi.AgileDataTerytPlug.scope.';

        // Create fields.
        $fields[] = [
            'type' => 'select',
            'id' => 'scope',
            'value' => ( $step->scope ?? null ),
            'name' => $loc->get($locSta . 'scope.name'),
            'desc' => $loc->get($locSta . 'scope.desc'),
            'options' => [
                'v' => $loc->get($locSco . 'v'),
                'c' => $loc->get($locSco . 'c'),
                'm' => $loc->get($locSco . 'm'),
                'a' => $loc->get($locSco . 'a'),
            ],
            'rulesField' => [ 'details' ],
            'htmlData' => [
                'update-depending-field' => '',
            ],
            'group' => $loc->get('Przeslijmi.AgileData.tabs.operation'),
        ];
        $fields[] = [
            'type' => 'select',
            'multiple' => 6,
            'noDefaultOptions' => true,
            'dependsOnField' => 'scope',
            'id' => 'details',
            'value' => ( $step->details ?? null ),
            'name' => $loc->get($locSta . 'details.name'),
            'desc' => $loc->get($locSta . 'details.desc'),
            'options' => Dictionaries::getDetails(),
            'group' => $loc->get('Przeslijmi.AgileData.tabs.operation'),
        ];

        return $fields;
    }

    /**
     * Prevalidator is optional in operation class and converts step if it is needed.
     *
     * @param stdClass $step Original step.
     *
     * @return stdClass Converted step.
     */
    public function preValidation(stdClass $step): stdClass
    {

        // Define file uri.
        if (isset($step->scope) === true) {
            $step->fileUri = Dictionaries::getFileUriForScope($step->scope);
        }

        // Define map columns.
        if (isset($step->details) === true) {

            // Lvd.
            $step->mapColumns = [];

            // Define map columns.
            foreach ($step->details as $detail) {

                // Convert `m.voivodeship.name` into `voivodeship.name`.
                $def            = Dictionaries::getDetails()[$detail];
                $noPrefix       = substr($detail, 2);
                $columnNameLoc  = 'Przeslijmi.AgileDataTerytPlug.details.';
                $columnNameLoc .= $detail . '.column';
                $columnName     = $_ENV['LOCALE']->get($columnNameLoc);

                $step->mapColumns[] = (object) [
                    'sourceColumn' => $noPrefix,
                    'destinationProp' => $columnName,
                    'dataType' => $def['dataType'],
                ];
            }
        }//end if

        // Add human name.
        if (empty($step->humanName) === true && empty($step->fileUri) === false) {
            $step->humanName = 'odczyt z bazy TERYT TERC';
        }

        return $step;
    }
}
