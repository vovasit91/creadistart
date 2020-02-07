<?php

use yii\db\Migration;

/**
 * Class m200206_144451_import_users
 */
class m200206_144451_import_loans extends Migration
{

    public function safeUp()
    {
        $loans = json_decode(file_get_contents(Yii::getAlias('@app/loans.json')), true);
        foreach ($loans as $row) {
            ($this->getLoan($row))->save();
        }
    }


    public function safeDown()
    {
        $this->truncateTable('{{%loans}}');
    }

    protected function getLoan($data)
    {
        $data['id']         = (int) $data['id'];
        $data['user_id']    = (int) $data['user_id'];
        $data['duration']   = (int) $data['duration'];
        $data['campaign']   = (int) $data['campaign'];
        $data['status']     = (bool) $data['status'];
        return new \app\models\Loan($data);
    }
}
