<?php

namespace alexantr\datetimepicker;

use yii\web\AssetBundle;

class DateTimePickerWidgetAsset extends AssetBundle
{
    public $sourcePath = '@alexantr/datetimepicker/assets';
    public $js = [
        'widget.js',
    ];
}
