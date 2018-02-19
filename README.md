# Datetime picker input widget for Yii 2

This extension renders an input with [flatpickr](https://chmln.github.io/flatpickr/).

[![Latest Stable Version](https://img.shields.io/packagist/v/alexantr/yii2-datetimepicker.svg)](https://packagist.org/packages/alexantr/yii2-datetimepicker)
[![Total Downloads](https://img.shields.io/packagist/dt/alexantr/yii2-datetimepicker.svg)](https://packagist.org/packages/alexantr/yii2-datetimepicker)
[![License](https://img.shields.io/github/license/alexantr/yii2-datetimepicker.svg)](https://raw.githubusercontent.com/alexantr/yii2-datetimepicker/master/LICENSE)

## Installation

Install extension through [composer](http://getcomposer.org/):

```
composer require alexantr/yii2-datetimepicker
```

## Usage

The following code in a view file would render an input with color picker:

```php
<?= alexantr\datetimepicker\DateTimePicker::widget(['name' => 'attributeName']) ?>
```

If you want to use this input widget in an ActiveForm, it can be done like this:

```php
<?= $form->field($model, 'attributeName')->widget(alexantr\datetimepicker\DateTimePicker::className()) ?>
```

Configuring the [flatpickr options](https://chmln.github.io/flatpickr/options/) should be done
using the `clientOptions` attribute:

```php
<?= alexantr\datetimepicker\DateTimePicker::widget([
    'name' => 'attributeName',
    'clientOptions' => [
        'allowInput' => false,
        'enableTime' => false,
        'enableSeconds' => false,
        'dateFormat' => 'Y-m-d',
    ],
]) ?>
```

By default widget uses flatpickr's options:

```php
[
    'allowInput' => true,
    'dateFormat' => 'Y-m-d H:i:S',
    'enableTime' => true,
    'enableSeconds' => true,
    'minuteIncrement' => 1,
    'time_24hr' => true,
]
```
