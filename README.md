# Datetime picker input widget for Yii 2

This extension renders an input with [flatpickr](https://chmln.github.io/flatpickr/).

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
