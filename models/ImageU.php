<?php

namespace app\modules\image\models;
use yii\helpers\Html;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\widgets\ActiveForm;

use yii\db\ActiveRecord;
/**
 * Image active record class file.
 * @author Christoffer Niska <ChristofferNiska@gmail.com>
 * @copyright Copyright &copy; Christoffer Niska 2011-
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 * @since 0.5
 */

/**
 * This is the model class for table "Image".
 *
 * The followings are the available columns in table 'Image':
 * @property integer $id
 * @property string $name
 * @property string $path
 * @property string $extension
 * @property string $filename
 * @property integer $byteSize
 * @property string $mimeType
 * @property string $created
 * @property integer $deleted
 */
class ImageU extends ActiveRecord
{
	
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'image';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
         public function rules()
    {
        return [
            [
                ['byteSize'],
                'integer',
            ],
            [
                [
                    'id', 'name', 'path', 'extension', 'filename', 'byteSize', 'mimeType', 'created'
                ],
                'safe','on' => 'search'
            ],
			[
                [
                    'extension', 'filename', 'byteSize', 'mimeType'
                ],
                'required',
            ],
        
            [
                ['name', 'path', 'extension', 'filename', 'mimeType', 'created'],
                'string',
                'max' => 255,
            ],
        ];
    }
	/*public function rules()
	{
		return array(
			array('extension, filename, byteSize, mimeType','required'),
			array('byteSize, ad_id','numerical','integerOnly'=>true),
			array('name, path, extension, filename, mimeType, created','length','max'=>255),
			array('id, name, path, extension, filename, byteSize, mimeType, created','safe','on'=>'search'),
		);
	}*/


	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Img::t('core','Id'),
			'name' => Img::t('core','Name'),
			'path' => Img::t('core','Path'),
			'extension' => Img::t('core','Extension'),
			'filename' => Img::t('core','Filename'),
			'byteSize' => Img::t('core','Byte Size'),
			'mimeType' => Img::t('core','Mime Type'),
			'created' => Img::t('core','Created'),
		);
	}

        
        /**
	 * returns an array that contains the views name to be loaded
	 * @return array
	 */
	public function profileViews(){
		return array(
			//UserGroupsUser::VIEW => 'index',
			//UserGroupsUser::EDIT => 'update',
			
		);
	}
	

	/**
	 * Renders this image.
	 * @param string $version the image version to render.
	 * @param string $alt the alternative text.
	 * @param array $htmlOptions the html options.
	 */
	public function render($version,$alt='',$htmlOptions=array())
	{
		$src = \Yii::$app()->image->getURL($this->id,$version);
                $htmlOptions['alt'] = $alt;
		echo Html::img($src,$htmlOptions);
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
}
