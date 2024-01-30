<?php

namespace siripravi\slideradmin\models;

use Yii;

use siripravi\slideradmin\behaviors\LanguageBehavior;
use omgdef\multilingual\MultilingualQuery;

use yii\behaviors\TimestampBehavior;
use yii\helpers\Html;
use yii\helpers\Url;
/**
 * This is the model class for table "image".
 *
 * @property int $id
 * @property string $name
 * @property string $extension
 * @property string $filename
 * @property int $byteSize
 * @property string $mimeType
 * @property string $created
 * @property string $fkValue
 */
class SliderImage extends \yii\db\ActiveRecord
{
    
  
	public $imageFile;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%slider_image}}';
    }
	
	/**
     * @inheritdoc
     */
    public function behaviors()
    {
		 return [  
           /*'ml'=>[ 'class' =>  MultilingualBehavior::class,		     
		         'attributes' => ['title', 'html'],	
				 'tableName' => 'nxt_slider_image_lang',
				  'langClassName' => SliderImageLang::class, 
				 'languageField' => 'lang_id',
                  'languages'  => Language::nameList(),			 
			 'langForeignKey' => 'slider_image_id',
		  	     
		   ],*/
		  [
		   'class' => LanguageBehavior::className(),
			 'tableName' => '{{%slider_image_lang}}', 
		    'langForeignKey' => 'slider_image_id',
		  ], 
		  TimestampBehavior::className()
         
	    ];		
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [[ 'extension', 'filename', 'byteSize', 'mimeType'], 'required'],
            [['byteSize'], 'integer'],
            [['hash','slider_id'], 'safe'],
            [['extension', 'filename', 'mimeType'], 'string', 'max' => 255],
			[['imageFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],
			[['imageFile'], 'required', 'on'=>'slide'],
			[['title'], 'string', 'max' => 255],
            [['html'], 'string'],
        ];
    }
	
	/**
     * @return MultilingualQuery|\yii\db\ActiveQuery
     */
     public static function find()
    {
        return new MultilingualQuery(get_called_class());
    }
	
	
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSlider()
    {
        return $this->hasOne(Slider::class, ['id' => 'slider_id']);
    }

    /**
	 * Renders this image.
	 * @param string $version the image version to render.
	 * @param string $alt the alternative text.
	 * @param array $htmlOptions the html options.
	 */
	public function render($filename, $version,$htmlOptions=array())
	{
		/*$src = \Yii::$app->getModule('slider')->slider->getURL($this->id,$version);
                $htmlOptions['alt'] = $alt;*/
             $src =  '@web/files/images/versions/'.$version.'/'.$filename;		
           return Html::img($src,$htmlOptions);
	}

	/**
	 * @return string the path for this image.
	 */
	public function getPath()
	{
		return !empty($this->path) ? $this->path.'/' : '';
	}
        
        /**
	 * @return string the path for this image.
	 */
	public function setPath($path)
	{
		$this->path = $path;
	}
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'hash' => 'Name',
            'extension' => 'Extension',
            'filename' => 'Filename',
            'byteSize' => 'Byte Size',
            'mimeType' => 'Mime Type',
            'created_at' => 'Created',
			'updated_at' => 'Updated',
            'slider_id' => 'Slider Id',
        ];
    }
}
