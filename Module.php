<?php

namespace app\modules\slider;

/**
 * image module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'siripravi\slideradmin\controllers';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();
        $this->registerTranslations();
		
        \Yii::setAlias('@foo', '@webroot/../../files/images');
        // custom initialization code goes here
    }
      public function registerTranslations()
    {
        \Yii::$app->i18n->translations['modules/slider/*'] = [
            'class' => 'yii\i18n\PhpMessageSource',
            'sourceLanguage' => 'en',
            'basePath' => '@app/modules/image/messages',
           
            'fileMap' => [
                'modules/slider/app' => 'app.php',
                'modules/slider/error' => 'error.php',
            ],
            
        ];
    }

    public static function t($category, $message, $params = [], $language = null)
    {
        return Yii::t('modules/slider/' . $category, $message, $params, $language);
    }
}
