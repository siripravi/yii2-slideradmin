<?php

namespace siripravi\slideradmin\models;

use Yii;

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
class Image extends \yii\db\ActiveRecord
{
    
    public $imageSrc;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'nxt_slider';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [[ 'extension', 'filename', 'byteSize', 'mimeType'], 'required'],
            [['byteSize'], 'integer'],
            [['created','hash','imageSrc','fkValue'], 'safe'],
            [['extension', 'filename', 'mimeType'], 'string', 'max' => 255],
        ];
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
            'created' => 'Created',
            'fkValue' => 'Foreign Key',
        ];
    }
}
