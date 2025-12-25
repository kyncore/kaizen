#!/usr/bin/env php
<?php

$feature = $argv[1] ?? null;

if (!$feature) {
    echo "Usage: bushido install <feature-name>\n";
    exit(1);
}

$featureDir = __DIR__ . "/../../packages/{$feature}";
if (!is_dir($featureDir)) {
    echo "Feature not found: $feature\n";
    exit(1);
}

$map = require "$featureDir/install.php";
foreach ($map['files'] as $src => $dest) {
    $srcPath = realpath("$featureDir/$src");
    $destPath = getcwd() . "/$dest";

    echo "Copying $srcPath → $destPath\n";
    @mkdir(dirname($destPath), 0777, true);
    copy($srcPath, $destPath);
}

echo "✅ Installed: $feature\n";
