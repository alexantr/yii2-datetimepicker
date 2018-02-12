<?php

namespace alexantr\datetimepicker;

use yii\web\AssetBundle;

class FlatpickrAsset extends AssetBundle
{
    public $sourcePath = '@npm/flatpickr/dist';
    public $css = [
        'flatpickr.min.css',
    ];
    public $js = [
        'flatpickr.min.js',
    ];
    public $publishOptions = [
        'except' => [
            '*.ts',
        ],
        'caseSensitive' => false,
    ];
}
