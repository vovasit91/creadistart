<?php
namespace app\assets;

use yii\web\AssetBundle;

class FontAwesomeAsset extends AssetBundle
{
    public $depends = [
        \rmrevin\yii\fontawesome\NpmFreeAssetBundle::class
    ];
}