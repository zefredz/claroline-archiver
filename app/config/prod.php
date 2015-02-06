<?php

// Tmp
$app['tmp.path'] = __DIR__ . '/../../tmp';

// Cache
$app['cache.path'] = $app['tmp.path'] . '/cache';

// Http cache
$app['http_cache.cache_dir'] = $app['cache.path'] . '/http';
