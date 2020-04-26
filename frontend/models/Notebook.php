<?php

namespace frontend\models;

use common\models\User;
use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "notebook".
 *
 * @property int $id
 * @property int $user_id
 * @property string|null $name
 * @property string|null $phone
 * @property string|null $email
 *
 * @property User $user
 */
class Notebook extends ActiveRecord
{
    /**
     * @var string
     */
    public $cacheUserNotesKey = 'user_notes';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{notebook}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id'], 'required'],
            [['user_id'], 'integer'],
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
            [['phone', 'email'], 'string', 'max' => 50],
            [['email'], 'email'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    public function beforeValidate()
    {
        $this->name = strip_tags($this->name);
        $this->phone = strip_tags($this->phone);
        $this->email = strip_tags($this->email);
        return parent::beforeValidate();
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'name' => 'ФИО',
            'phone' => 'Телефон',
            'email' => 'Email',
        ];
    }


    public function getUserNotes()
    {
        $userNotes = Yii::$app->cache->get($this->cacheUserNotesKey);
        if (!$userNotes) {
            $conditions['user_id'] = Yii::$app->user->id;
            $userNotes = Notebook::find()->where($conditions)->all();
            Yii::$app->cache->set($this->cacheUserNotesKey, $userNotes, 10);
        }

        return $userNotes;
    }

}
