<?php
namespace app\models;

class Feedback extends Model {
    public $id;
    public $nameUser;
    public $subject;
    public $message;

    public function moderateFeedback() {

    }

    public function getTableName() {
        return 'feedbacks';
    }
}
?>