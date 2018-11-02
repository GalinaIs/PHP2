<?php
namespace app\models;

class Feedback extends DataEntity {
    public $id;
    public $nameUser;
    public $subject;
    public $message;

    public function getShortMessage() {
        return mb_substr($this->message, 0, 5);
    }
}
?>