<?php

use Fas\Configuration\DotNotation;
use Fas\Configuration\FileCache;
use Fas\Configuration\YamlLoader;

require __DIR__ . '/../vendor/autoload.php';

// Compile configuration
$configuration = new DotNotation(YamlLoader::loadWithOverrides(__DIR__ . '/../config.yaml'));
FileCache::save(__DIR__ . '/../cache/config.php', $configuration, __DIR__ . '/../cache/preload.config.php');
