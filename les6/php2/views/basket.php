<h2>Корзина пользователя: </h2>
<div id="products">
<?php foreach($cart as $oneProductCart): ?>
    <div class="view_product">
        <a target="_blank " href="<?= "product/card?id={$oneProductCart->id}" ?>">
            <img class="my_img" src="/image/products/min/<?= $oneProductCart->image; ?>" />
            <div class="description">
                <h3><?= $oneProductCart->name; ?></h3>
            </div>
            <div class="price">Цена:<br> 
                <?= $oneProductCart->price; ?> руб.
            </div>
            <div class="price">Количество:<br> 
                <?= $oneProductCart->count; ?> шт.
            </div>
            <div class="price">Общая стоимость:<br> 
                <?= $oneProductCart->getCost(); ?> руб.
            </div>
        </a>
        <form class="my_form" method="POST" action="/basket/change">
            <input class="input_qty" type="number" min="1" max="100" value="<?= $oneProductCart->count; ?>" name="qty" />
            <input name="action" value="change" class="invisible">
            <input name="redirect" value="true" class="invisible">
            <button name="id" data-id="<?= $oneProductCart->id?>" data-action="change" class="button_cart" value="<?= $oneProductCart->id_product?>">Изменить количество</button>
        </form>
        <form class="my_form form_delete" method="POST" action="/basket/change">
            <input name="action" value="delete" class="invisible">
            <input name="redirect" value="true" class="invisible">
            <button name="id" data-id="<?= $oneProductCart->id?>" data-action="delete" class="button_cart" value="<?= $oneProductCart->id_product?>">Удалить товар из корзины</button>
        </form>
    </div>
<?php endforeach;?>
<div class="all_cost">
    <h3>Общая стоимость Вашего заказа: <?= $cost; ?> руб.</h3>
</div>
<?php if (count($cart) >= 1) : ?> 
<form method="POST" action="/order">
    <button>Сделать заказ</button>
</form>
<?php endif; ?>
</div>