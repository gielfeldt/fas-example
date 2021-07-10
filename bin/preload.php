<?php

require __DIR__ . '/../vendor/autoload.php';

// configuration
if (file_exists(__DIR__ . '/../cache/preload.config.php')) {
    include __DIR__ . '/../cache/preload.config.php';
}

// container
if (file_exists(__DIR__ . '/../cache/preload.container.php')) {
    include __DIR__ . '/../cache/preload.container.php';
}

// router
if (file_exists(__DIR__ . '/../cache/preload.router.php')) {
    include __DIR__ . '/../cache/preload.router.php';
}

// app
if (file_exists(__DIR__ . '/preload.app.php')) {
    include __DIR__ . '/preload.app.php';
}
