<?php
class A {
    public function foo() {
        static $x = 0;//Статическая переменная - это переменная, которая доступна между вызовами функций. Т.е. не создается каждый раз новая переменная, а используется одна и та же. Одна для всего класса A.
        echo ++$x;//Сначала увеличиваем значение на 1, а затем выводим.
    }
}
$a1 = new A();
$a2 = new A();
$a1->foo();//1
$a2->foo();//2
$a1->foo();//3
$a2->foo();//4
?>