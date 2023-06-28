<?php

declare(strict_types=1);

namespace Przeslijmi\AgileDataTerytPlug\Exceptions;

use Przeslijmi\Sexceptions\Sexception;

/**
 * File with CSV source is not reachable by app (maybe it does not exists?).
 */
class FileUnreachableException extends Sexception
{

    /**
     * Hint.
     *
     * @var string
     */
    protected $hint = 'File with CSV source is not reachable by app (maybe it does not exists?).';

    /**
     * Keys for extra data array.
     *
     * @var array
     */
    protected $keys = [
        'fileUri',
    ];
}
