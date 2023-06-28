<?php

declare(strict_types=1);

namespace Przeslijmi\AgileDataTerytPlug\EnvChecks;

use Przeslijmi\AgileData\Configure\EnvChecks\EnvChecksParent;

/**
 * Checks if given ENV value is proper.
 */
class DestinationDir extends EnvChecksParent
{

    /**
     * Standard rules to be checked.
     *
     * @var array
     */
    protected static $rules = [
        'dataType' => 'string',
        'canBeEmpty' => false,
        'secureUri' => true,
        'existingDir' => true,
    ];
}
