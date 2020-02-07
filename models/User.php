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
            [['personal_code'], 'integer'],
            [['personal_code'], 'validatePersonalCode'],
            [['active', 'dead'], 'boolean'],
            [['personal_code', 'phone'], 'filter', 'filter' => 'intval'],
            [['active', 'dead'], 'filter', 'filter' => 'boolval'],
        ];
    }

    public function validateExactLength($attribute, $params, $validator)
    {
        if(mb_strlen($this->$attribute) !== $params['length']){
            $validator->addError($this, $attribute, Yii::t('app', '{attribute} must be exactly {length}', ['length' => $params['length']]));
        }
    }

    public function validatePersonalCode($attribute, $params, $validator)
    {
        $month  = substr($this->personal_code, 3, 2);
        $day    = substr($this->personal_code, 5, 2);
        $year   = $this->extractBirthYear();
        if(checkdate($month, $day, $year)) {
            $this->validateExactLength($attribute, ['length' => 11], $validator);
        }
        else{
            $validator->addError($this, $attribute, Yii::t('app', '{attribute} doesn\'t look like valid estonian personal code'));
        }
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

    public function getBirthday()
    {
        $year   = $this->extractBirthYear();
        $month  = substr($this->personal_code, 3, 2);
        $day    = substr($this->personal_code, 5, 2);

        $dateString = $year . $month . $day;
        return checkdate($month, $day, $year) ? date_create_from_format('Ymd', $dateString) : false;
    }

    private function extractBirthYear()
    {
        $g = substr($this->personal_code, 0, 1);
        $firstPart  = $g < 3 ? 18 : ($g < 5 ? 19 : ($g < 7 ? 20 : false));
        $secondPart = substr($this->personal_code, 1, 2);

        return $firstPart ? $firstPart . $secondPart : false;
    }

    public function getFullName()
    {
        return $this->last_name . ' ' . $this->first_name;
    }
}
