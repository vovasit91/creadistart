<?php

use yii\db\Migration;

/**
 * Class m200206_150946_import_users
 */
class m200206_150946_import_users extends Migration
{

    public function safeUp()
    {
        $loans = json_decode(file_get_contents(Yii::getAlias('@app/users.json')), true);
        foreach ($loans as $row) {
            ($this->getUser($row))->save();
        }
    }


    public function safeDown()
    {
        $this->truncateTable('{{%users}}');
    }

    protected function getUser($data)
    {
        $data['id']             = (int) $data['id'];
        $data['personal_code']  = (int) $data['personal_code'];
        $data['active']         = (bool) $data['active'];
        $data['dead']           = (bool) $data['dead'];
        return new \app\models\User($data);
    }
}
