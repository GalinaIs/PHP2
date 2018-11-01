<?php
namespace app\models\repositories;
use \app\models\Feedback as Feedback;

class FeedbackRepository extends Repository {
    public function getTableName() {
        return 'feedbacks';
    }

    public function getEntityClass() {
        return Feedback::class;
    }

    public function getException() {
        return ['db', 'exception', 'id'];
    }
}
?>