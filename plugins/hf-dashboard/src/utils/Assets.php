<?php

namespace healthfirst\hfdashboard\utils;

use craft\web\AssetBundle;
use craft\web\assets\cp\CpAsset;

class Assets extends AssetBundle
{
    public function init()
    {
        $this->sourcePath = __DIR__ . '/../assets';
        $this->depends = [CpAsset::class];

        $this->js = [
            'js/chart.min.js',
            'js/chartJs.js'
        ];

        parent::init();
    }
}