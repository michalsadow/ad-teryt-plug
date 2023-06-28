<?php

declare(strict_types=1);

require 'vendor/autoload.php';

// Include configs.
$_ENV = require('.env.php');

// Define ROOT_PATH.
define('ROOT_PATH', dirname(__FILE__) );

use Przeslijmi\AgileDataTerytPlug\RecalcTerc;

/**
 *
 * ```
 * // Recal TERC.
 * if (
 *     isset($_ENV['PRZESLIJMI_ADTERYTPLUG_SOURCES_TERC']) === true
 *     && empty($_ENV['PRZESLIJMI_ADTERYTPLUG_SOURCES_TERC']) === false
 * ) {
 *     $rct = new RecalcTerc();
 *     $rct->perform();
 * }
 * ```
 *
 */
