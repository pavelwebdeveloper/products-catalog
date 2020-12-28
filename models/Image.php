<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "announcement".
 *
 * @property int $announcementId
 * @property string $announcementTitle
 * @property string $announcementDescription
 * @property string $announcementAuthorName
 * @property string $announcementCreationDate
 * @property int $siteuserId
 */
class Image extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'image';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'imagePath'], 'required'],
            [['id'], 'integer'],
            [['imagePath'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Image ID',
            'imagePath' => 'Image Path',
           
        ];
    }
}

