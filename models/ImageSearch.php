<?php

namespace siripravi\slideradmin\models;
use yii\base\Model;
use yii\data\ActiveDataProvider;
/**
 * Description of ImageSearch
 *
 * @author prov
 */
class ImageSearch extends Image{
    //put your code here
    
    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        return Model::scenarios();
    }
    
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
                'safe'
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
    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Image::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $this->load($params);
        if (!$this->validate()) {
            return $dataProvider;
        }
        $query->andFilterWhere([
            'name' => $this->name,
            'path' => $this->path,
            'extension' => $this->extension,
            'filename' => $this->filename,
            'byteSize' => $this->byteSize,
            'mimeType' => $this->mimeType,
            'created' => $this->created,
           
        ]);
       
       /* $query
            ->andFilterWhere(['like', 'shortName', $this->shortName])
            ->andFilterWhere(['like', 'name', $this->name]);
        * 
        */
        return $dataProvider;
    }
}
