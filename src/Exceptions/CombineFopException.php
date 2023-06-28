<?php

declare(strict_types=1);

namespace Przeslijmi\AgileDataTerytPlug\Exceptions;

use Przeslijmi\Sexceptions\Sexception;

/**
 * Count of header is not exact to count of row - though `array_combine` is impossible.
 */
class CombineFopException extends Sexception
{

    /**
     * Hint.
     *
     * @var string
     */
    protected $hint = 'Count of header is not exact to count of row - though `array_combine` is impossible.';

    /**
     * Keys for extra data array.
     *
     * @var array
     */
    protected $keys = [
        'headerContents',
        'rowContents',
    ];
}
