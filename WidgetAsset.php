<?php

namespace alexantr\datetimepicker;

use yii\web\AssetBundle;

class WidgetAsset extends AssetBundle
{
    public $sourcePath = '@alexantr/datetimepicker/assets';
    public $js = [
        'widget.js',
    ];
    public $depends = [
        'alexantr\datetimepicker\FlatpickrAsset',
    ];
}
