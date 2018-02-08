<?php

namespace alexantr\datetimepicker;

use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\web\View;
use yii\widgets\InputWidget;

/**
 * DateTimePicker input widget uses flatpickr
 * @link https://chmln.github.io/flatpickr/
 */
class DateTimePicker extends InputWidget
{
    /**
     * @var string flatpickr CDN base URL
     */
    public static $cdnBaseUrl = 'https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.2.4/';

    /**
     * @inheritdoc
     */
    public $options = ['class' => 'form-control datetimepicker-input'];
    /**
     * @var string flatpickr's theme.
     * @see $allowedThemes for possible variants.
     */
    public $theme;
    /**
     * @var array flatpickr's plugins.
     * @see $allowedPlugins for possible variants.
     * @link https://chmln.github.io/flatpickr/plugins/
     * You must set plugin config manually:
     * ```
     * 'clientOptions' => [
     *     'plugins' => [
     *         new \yii\web\JsExpression('new minMaxTimePlugin({table:{"2025-01-10":{minTime:"16:00",maxTime:"22:00"}}})'),
     *     ],
     * ],
     * ```
     */
    public $plugins = [];
    /**
     * @var string the locale to use.
     */
    public $locale;
    /**
     * @var array flatpickr's options.
     * @link https://chmln.github.io/flatpickr/options/
     */
    public $clientOptions = [];
    /**
     * @var bool register css for old IE.
     */
    public $ieSupport = false;

    /**
     * @var array the default options for the plugin. Will be merged with clientOptions.
     */
    protected $defaultClientOptions = [
        'allowInput' => true,
        'dateFormat' => 'Y-m-d H:i:S',
        'enableTime' => true,
        'enableSeconds' => true,
        'minuteIncrement' => 1,
        'time_24hr' => true,
    ];
    /**
     * @var array list of theme names
     */
    protected $allowedThemes = [
        'airbnb',
        'confetti',
        'dark',
        'light',
        'material_blue',
        'material_green',
        'material_orange',
        'material_red',
    ];
    /**
     * @var array list of plugins with css & js URLs
     */
    protected $allowedPlugins = [
        'confirmDate' => [
            'css' => ['plugins/confirmDate/confirmDate.css'],
            'js' => ['plugins/confirmDate/confirmDate.js'],
        ],
        'labelPlugin' => [
            'js' => ['plugins/labelPlugin/labelPlugin.js'],
        ],
        'minMaxTimePlugin' => [
            'js' => ['plugins/minMaxTimePlugin.js'],
        ],
        'rangePlugin' => [
            'js' => ['plugins/rangePlugin.js'],
        ],
        'weekSelect' => [
            'js' => ['plugins/weekSelect/weekSelect.js'],
        ],
    ];

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        $this->clientOptions = ArrayHelper::merge($this->defaultClientOptions, $this->clientOptions);

        if ($this->locale === null) {
            $this->locale = substr(Yii::$app->language, 0, 2);
        }
        if (!empty($this->locale)) {
            $this->clientOptions['locale'] = $this->locale;
        }
    }

    /**
     * @inheritdoc
     */
    public function run()
    {
        $input = $this->hasModel()
            ? Html::activeTextInput($this->model, $this->attribute, $this->options)
            : Html::textInput($this->name, $this->value, $this->options);
        $this->registerClientScript();
        return $input;
    }

    /**
     * Registers flatpickr
     */
    protected function registerClientScript()
    {
        $view = $this->getView();
        $this->registerAssets();

        $id = $this->options['id'];
        $encodedOptions = !empty($this->clientOptions) ? Json::htmlEncode($this->clientOptions) : '{}';

        $view->registerJs("alexantr.dateTimePickerWidget.init('$id', $encodedOptions)", View::POS_END);
    }

    /**
     * Registers flatpickr's assets
     */
    protected function registerAssets()
    {
        $view = $this->getView();

        $view->registerCssFile(self::$cdnBaseUrl . 'flatpickr.min.css');
        $view->registerJsFile(self::$cdnBaseUrl . 'flatpickr.min.js');

        if (!empty($this->theme) && in_array($this->theme, $this->allowedThemes)) {
            $view->registerCssFile(self::$cdnBaseUrl . 'themes/' . $this->theme . '.css');
        }

        if ($this->ieSupport) {
            $view->registerCssFile(self::$cdnBaseUrl . 'ie.css');
        }

        foreach ($this->plugins as $plugin) {
            if (isset($this->allowedPlugins[$plugin]['css'])) {
                foreach ($this->allowedPlugins[$plugin]['css'] as $css) {
                    $view->registerCssFile(self::$cdnBaseUrl . $css);
                }
            }
            if (isset($this->allowedPlugins[$plugin]['js'])) {
                foreach ($this->allowedPlugins[$plugin]['js'] as $js) {
                    $view->registerJsFile(self::$cdnBaseUrl . $js);
                }
            }
        }

        if (!empty($this->locale)) {
            $view->registerJsFile(self::$cdnBaseUrl . 'l10n/' . $this->locale . '.js');
        }

        WidgetAsset::register($view);
    }
}
