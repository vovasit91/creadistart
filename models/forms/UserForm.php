<?php

namespace app\models\forms;

use app\models\User;
use Yii;
use yii\base\Model;

class UserForm extends Model
{
    public $first_name;
    public $last_name;
    public $email;
    public $personal_code;
    public $phone;
    public $lang;
    private $user;

    public function rules()
    {
        return [
            [['first_name', 'last_name', 'email', 'personal_code', 'phone'], 'required'],
        ];
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
            'lang'          => Yii::t('app', 'Language'),
        ];
    }

    public function save()
    {
        $user = new User($this->toArray());
        $result = $user->save();
        if($result){
            $this->user = $user;
        }
        else {
            $this->errors = $user->errors;
        }
        return $result;
    }

    public function getUser()
    {
        return $this->user;
    }
}