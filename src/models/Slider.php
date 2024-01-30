<?php

namespace siripravi\slideradmin\models;

use siripravi\slideradmin\models\SliderImage;

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "brand".
 *
 * @property integer $id
 * @property integer $image_id
 * @property integer $position
 * @property boolean $enabled
 *
 * @property string $name
 *
 * @property Image $image
 * @property Product[] $products
 */
class Slider extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%slider}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['title'], 'string', 'max' => 255],
            [['image_count'], 'integer'],
            [['enabled'], 'boolean'],
            [['enabled'], 'default', 'value' => true],
            
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => Yii::t('app', 'Title'),
            'image_count' => Yii::t('app', 'No. of Images'),            
            'enabled' => Yii::t('app', 'Enabled'),
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSlides()
    {
        return $this->hasMany(SliderImage::class, ['slider_id' => 'id']);
    }

    /**
     * @param boolean|null $enabled
     * @return array
     */
    public static function getList($enabled)
    {
        return ArrayHelper::map(self::find()->andFilterWhere(['enabled' => $enabled])->all(), 'id', 'title');
    }
}
