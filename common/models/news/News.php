<?php

namespace common\models\news;

use Yii;

/**
 * This is the model class for table "news".
 *
 * @property int $id
 * @property string $text
 * @property string $time
 * @property string $author
 * @property string $image
 * @property string $title
 * @property string $short
 */
class News extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'news';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['text', 'time', 'author', 'image', 'title', 'short'], 'required'],
            [['text'], 'string'],
            [['time'], 'safe'],
            [['author'], 'string', 'max' => 150],
            [['image', 'title'], 'string', 'max' => 250],
            [['short'], 'string', 'max' => 300],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'text' => Yii::t('ML','Text'),
            'time' => Yii::t('ML','Time'),
            'author'=> Yii::t('ML','Author'),
            'image' => Yii::t('ML','Image'),
            'title' => Yii::t('ML','Title'),
            'short' => Yii::t('ML','Short'),
            'create'=>Yii::t('ML','Create'),
            'update'=>Yii::t('ML','Update'),
            'delete'=>Yii::t('ML','Delete'),
        ];
    }
}

// public function beforeSave($insert)
// {
//     die;
//  if (parent::beforeSave($insert)) {
//  if ($insert) {
// // $this->time=date("Y-m-d H:i:s",strotime($this->time));
// $this->time=date_create();
 
// return true;
//  } else {
//  return false;
//  }
// }
// }
// }
