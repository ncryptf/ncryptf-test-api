<?php

foreach (scandir(__DIR__ . '/routes') as $filename) {
    $path = dirname(__FILE__) . '/routes/' . $filename;
    if (is_file($path)) {
        require $path;
    }
}
