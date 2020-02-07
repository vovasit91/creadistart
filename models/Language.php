<?php

namespace app\models;

use yii\base\Model;

class Language extends Model
{
    public $code;
    public $name;

    private static $languages = [
        1 => [
            'code' => 'EN',
            'name' => 'English',
        ],
        2 => [
            'code' => 'EE',
            'name' => 'Estonian',
        ],
    ];

    public static function all()
    {
        $models = [];
        foreach (self::$languages as $language) {
            $models[] = new self($language);
        }
        return $models;
    }
}