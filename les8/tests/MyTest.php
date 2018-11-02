<?php
class MyTest extends \PHPUnit\Framework\TestCase {
    public function testFirst() {
        $a = 2 + 2;
        $this->assertEquals(4, $a);
        $this->assertGreaterThan(0, $a);
        $this->assertTrue(is_numeric($a));
    }

    public function testSecond() {
        $feedback = new \app\models\Feedback();
        $string = 'Спасибо за отличную работу!';
        $feedback->message = $string;
        $result = $feedback->getShortMessage();
        $this->assertEquals(5, mb_strlen($result));
        $this->assertEquals(mb_substr($string, 0, 5), $result);
    }

    public function testThird() {
        $basket = new \app\models\Basket();
        $count = 5;
        $price = 100;
        $basket->count = $count;
        $basket->price = $price;
        $basket->calculateCost();
        $cost = $basket->getCost();
        $this->assertTrue(is_numeric($cost));
        $this->assertEquals($cost, $count * $price);
    }
}