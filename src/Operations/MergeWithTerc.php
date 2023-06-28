<?php

declare(strict_types=1);

namespace Przeslijmi\AgileDataTerytPlug\Operations;

use Przeslijmi\AgileData\Exceptions\Operations\ReadFromJson\JsonFileExtensionWrongException;
use Przeslijmi\AgileData\Exceptions\Operations\ReadFromJson\JsonFileUriDonoexException;
use Przeslijmi\AgileData\Exceptions\Operations\RecordToBeIgnoredCausedMissingMergeException;
use Przeslijmi\AgileData\Exceptions\Operations\RecordToBeIgnoredException;
use Przeslijmi\AgileData\FileReaders\JsonReader;
use Przeslijmi\AgileData\Operations\OperationsInterface as MyInterface;
use Przeslijmi\AgileData\Operations\Reading\MergeWithJson as MyParent;
use Przeslijmi\AgileDataTerytPlug\Dictionaries;
use stdClass;

/**
 * Operation that reads data from JSON and merges it with date in current possesion.
 */
class MergeWithTerc extends MyParent implements MyInterface
{

    /**
     * Operation key.
     *
     * @var string
     */
    protected static $opKey = 'yG3Q6UXr';

    /**
     * Only those fields are accepted for this operation.
     *
     * @var array
     */
    public static $operationFields = [
        'scope',
        'mergeProperties_sourceField_*',
        'mergeProperties_sourceProp_*',
        'mapColumns_sourceField_*',
        'mapColumns_destinationProp_*',
    ];

    /**
     * Get info (mainly name and category of this operation).
     *
     * @return stdClass
     */
    public static function getInfo(): stdClass
    {

        // Lvd.
        $locSta = 'Przeslijmi.AgileDataTerytPlug.Operations.MergeWithTerc.';

        // Lvd.
        $result           = new stdClass();
        $result->name     = $_ENV['LOCALE']->get($locSta . 'title');
        $result->vendor   = 'Przeslijmi\AgileDataTerytPlug';
        $result->class    = self::class;
        $result->depr     = false;
        $result->category = 200;

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
        $locSta = 'Przeslijmi.AgileDataTerytPlug.Operations.MergeWithTerc.fields.';
        $locSco = 'Przeslijmi.AgileDataTerytPlug.scope.';

        // Convert multi field aggregation into form records.
        $mergePropertiesRecords = self::packMultiFieldsIntoRecord($step, 'mergeProperties', [
            'sourceField' => '',
            'sourceProp' => '',
        ]);

        // Delete prefixes from separate field and concate them with `sourceField`.
        foreach ($mergePropertiesRecords as $id => $pack) {
            if (isset($pack['mergeProperties_sourceFieldPrefix']) === true) {

                // Define proper.
                $proper = $pack['mergeProperties_sourceFieldPrefix'] . '.' . $pack['mergeProperties_sourceField'];

                // Set proper and delete prefix.
                $mergePropertiesRecords[$id]['mergeProperties_sourceField'] = $proper;
                unset($mergePropertiesRecords[$id]['mergeProperties_sourceFieldPrefix']);
            }
        }

        // Convert multi field aggregation into form records.
        $mapColumnsRecords = self::packMultiFieldsIntoRecord($step, 'mapColumns', [
            'sourceField' => '',
            'destinationProp' => '',
        ]);

        // Delete prefixes from separate field and concate them with `sourceField`.
        foreach ($mapColumnsRecords as $id => $pack) {
            if (isset($pack['mapColumns_sourceFieldPrefix']) === true) {

                // Define proper.
                $proper = $pack['mapColumns_sourceFieldPrefix'] . '.' . $pack['mapColumns_sourceField'];

                // Set proper and delete prefix.
                $mapColumnsRecords[$id]['mapColumns_sourceField'] = $proper;
                unset($mapColumnsRecords[$id]['mapColumns_sourceFieldPrefix']);
            }
        }

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
            'rulesField' => [ 'mergeProperties_sourceField', 'mapColumns_sourceField' ],
            'htmlData' => [
                'update-depending-field' => '',
            ],
            'group' => $loc->get('Przeslijmi.AgileData.tabs.operation'),
        ];
        $fields[] = [
            'type' => 'multi',
            'id' => 'mergeProperties',
            'allowAdding' => true,
            'allowDeleting' => true,
            'allowReorder' => true,
            'name' => $loc->get($locSta . 'mergeProperties.name'),
            'desc' => $loc->get($locSta . 'mergeProperties.desc'),
            'subFields' => [
                [
                    'name' => $loc->get($locSta . 'mergeProperties.sourceField.name'),
                    'type' => 'select',
                    'id' => 'mergeProperties_sourceField',
                    'dependsOnField' => 'scope',
                    'options' => Dictionaries::getDetails(),
                ],
                [
                    'name' => $loc->get($locSta . 'mergeProperties.sourceProp.name'),
                    'type' => 'select',
                    'options' => [],
                    'id' => 'mergeProperties_sourceProp',
                    'isAvailablePropChooser' => true,
                ],
            ],
            'values' => $mergePropertiesRecords,
            'group' => $loc->get('Przeslijmi.AgileData.tabs.operation'),
        ];
        $fields[] = [
            'type' => 'multi',
            'id' => 'mapColumns',
            'allowAdding' => true,
            'allowDeleting' => true,
            'allowReorder' => true,
            'name' => $loc->get($locSta . 'mapColumns.name'),
            'desc' => $loc->get($locSta . 'mapColumns.desc'),
            'subFields' => [
                [
                    'name' => $loc->get($locSta . 'mapColumns.sourceField.name'),
                    'type' => 'select',
                    'id' => 'mapColumns_sourceField',
                    'dependsOnField' => 'scope',
                    'options' => Dictionaries::getDetails(),
                ],
                [
                    'name' => $loc->get($locSta . 'mapColumns.destinationProp.name'),
                    'type' => 'text',
                    'id' => 'mapColumns_destinationProp',
                ],
            ],
            'values' => $mapColumnsRecords,
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

        // Correct sourceFields from `c.name` into `name`.
        foreach ((array) $step as $key => $value) {

            // Ignore non-interesting records.
            if (strpos($key, '_sourceField_') === false) {
                continue;
            }

            // Make correction.
            $step->{str_replace('_sourceField_', '_sourceFieldPrefix_', $key)} = substr($value, 0, 1);
            $step->{$key}                                                      = substr($value, 2);
        }

        // Define file uri.
        if (isset($step->scope) === true) {
            $step->fileUri = Dictionaries::getFileUriForScope($step->scope);
        }

        // Add human name.
        if (empty($step->humanName) === true && empty($step->fileUri) === false) {
            $step->humanName = 'dodanie kolumn z bazy TERYT TERC';
        }

        $step = parent::preValidation($step);

        // Add data type to mapColumns.
        foreach ($step->mapColumns as $id => $map) {
            $step->mapColumns[$id]->dataType = 'txt';
        }

        return $step;
    }

    /**
     * Validates plug definition.
     *
     * @return void
     */
    public function validate(): void
    {

        // Test nodes.
        $this->testNodes($this->getStepPathInPlug(), $this->getStep(), [
            'scope' => [ '!stringEnum', [ 'v', 'c', 'm', 'a' ]],
        ]);

        // Test other.
        parent::validate();
    }
}
