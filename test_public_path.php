<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->usePublicPath('C:/Test');
echo public_path('build/manifest.json');
