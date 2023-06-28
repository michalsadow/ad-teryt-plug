<?php

declare(strict_types=1);

namespace Przeslijmi\AgileDataTerytPlug\Exceptions;

use Przeslijmi\Sexceptions\Sexception;

/**
 * Dir to which app have to put JSON results is not reachable (maybe it does not exists?).
 */
class DestinationDirUnreachableException extends Sexception
{

    /**
     * Hint.
     *
     * @var string
     */
    protected $hint = 'Dir to which app have to put JSON results is not reachable (maybe it does not exists?).';

    /**
     * Keys for extra data array.
     *
     * @var array
     */
    protected $keys = [
        'dirUri',
    ];
}
