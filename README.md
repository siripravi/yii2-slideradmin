# Slideshow Image Administration using Yii2


Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist siripravi/yii2-slideradmin "@dev"
```

or add

```
"siripravi/yii2-slideradmin": "@dev"
```

to the require section of your `composer.json` file.


Usage
-----
Edit your application configuration file `config/web.php` as following:
```
'language' => 'hi',
...
'modules'  =>  [
     'slider' => [
                    'class' => 'siripravi\slideradmin\Module',
                ],
    'admin' => [
            'class' => 'app\admin\Module',
            'as access' => [
                'class' => 'yii\filters\AccessControl',
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                ],
            ],
            'modules' => [
                  'slider' => [
                    'class' => 'siripravi\slideradmin\Module',
                ],
                 ...
           ],      
],

```
Create database tables by running the command from application root directory:
```
     php yii migrate --migrationPath="@vendor/siripravi/yii2-slideradmin/migrations"
```
Now, Navigate to `http://<your site name>/admin`

and create application data for slider and slider_image tables using the forms provided.

You can manipulate language info by directly editing data inside the database table `nxt_language`.

Thats all regarding backend.

You can view an example slider in frontend by placing this code in any view/layout file of your applacation:
```php
 use siripravi\slideradmin\widgets\HomeSlider;
    
 echo HomeSlider::widget([
    'id' => 'home-slider',
	'options' => [       
        'data-interval' => 3000,
    ],
    'controls' => [
       '<span><i class="uil uil-angle-left-b"></i></span>',
        '<span><i class="uil uil-angle-right-b"></i></span>',
    ],
]);
```
## Credits

- [Language Module By Alexey Dench](https://github.com/dench/yii2-language)
- [Multilingual Behavior for Yii2](https://github.com/OmgDef/yii2-multilingual-behavior)
