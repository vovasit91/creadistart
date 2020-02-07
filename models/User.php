<?php

namespace app\models;

use Yii;
use yii\behaviors\AttributeBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%user}}".
 *
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property int $personal_code
 * @property int $phone
 * @property bool $active
 * @property bool $dead
 * @property string $lang
 * @property \DateTime $birthday
 */
class User extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return '{{%user}}';
    }

    public function rules()
    {
        return [
            [['first_name', 'last_name', 'email', 'personal_code', 'phone'], 'required'],
            [['first_name', 'last_name', 'email', 'lang'], 'string'],
            [['personal_code', 'phone'], 'integer'],
            [['active', 'dead'], 'boolean'],
            [['personal_code', 'phone'], 'filter', 'filter' => 'intval'],
            [['active', 'dead'], 'filter', 'filter' => 'boolval'],
        ];
    }

    public function beforeSave($insert)
    {
        if(!is_bool($this->active)){
            $this->active = true;
        }
        if(!is_bool($this->dead)){
            $this->dead = false;
        }
        return parent::beforeSave($insert);
    }

    public function attributeLabels()
    {
        return [
            'id'            => Yii::t('app', 'ID'),
            'first_name'    => Yii::t('app', 'First Name'),
            'last_name'     => Yii::t('app', 'Last Name'),
            'email'         => Yii::t('app', 'Email'),
            'personal_code' => Yii::t('app', 'Personal Code'),
            'phone'         => Yii::t('app', 'Phone'),
            'active'        => Yii::t('app', 'Active'),
            'dead'          => Yii::t('app', 'Dead'),
            'lang'          => Yii::t('app', 'Language'),
        ];
    }

    public static function find()
    {
        return new UserQuery(get_called_class());
    }

    public function getBirthday() : \DateTime
    {
        $g = substr($this->personal_code, 0, 1);
        $year = $g < 3 ? 18 : ($g < 5 ? 19 : 20);
        $dateString = $year . substr($this->personal_code, 1, 6);
        return date_create_from_format('Ymd', $dateString);
    }

    public function getFullName()
    {
        return $this->last_name . ' ' . $this->first_name;
    }
}
