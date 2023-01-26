<?php

namespace healthfirst\hfdashboard\utils;

use craft\web\AssetBundle;
use craft\web\assets\cp\CpAsset;

class Assets extends AssetBundle
{
    public function init()
    {
        $this->sourcePath = '/plugins/hf-dashboard/assets';
        $this->depends = [CpAsset::class];

        $this->js = [
            'js/chartJs.js'
        ];

        parent::init();
    }
}