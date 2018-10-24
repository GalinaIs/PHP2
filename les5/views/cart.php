<h2>Корзина пользователя: </h2>
<div id="products">
<?php foreach($cart as $oneProductCart): ?>
    <div class="view_product">
        <a target="_blank " href="<?= "product/card?id={$oneProductCart['id']}" ?>">
            <img class="my_img" src="/image/products/min/<?= $oneProductCart['min_image']; ?>" />
            <div class="description">
                <h3><?= $oneProductCart['name']; ?></h3>
            </div>
            <div class="price">Цена:<br> 
                <?= $oneProductCart['price']; ?> руб.
            </div>
            <div class="price">Количество:<br> 
                <?= $oneProductCart['count']; ?> шт.
            </div>
            <div class="price">Общая стоимость:<br> 
                <?= $oneProductCart['cost']; ?> руб.
            </div>
        </a>
        <form class="my_form" method="POST">
            <input class="input_qty" type="number" min="1" max="100" value="<?= $oneProductCart['count']; ?>" name="count" />
            <button name="id_product" data-id="<?= $oneProductCart['id']?>" data-action="change" class="button_cart">Изменить количество</button>
        </form>
        <form class="my_form form_delete" method="POST">
            <button name="id_product" data-id="<?= $oneProductCart['id']?>" data-action="delete" class="button_cart" >Удалить товар из корзины</button>
        </form>
    </div>
<?php endforeach;?>
<div class="all_cost">
    <h3>Общая стоимость Вашего заказа: <?= $cost; ?> руб.</h3>
</div>
<?php if (count($cart) >= 1) : ?> 
<form method="POST" action="cart/order">
    <button>Сделать заказ</button>
</form>
<?php endif; ?>
</div>
<!--<script>
    $('.button_cart').click((event) => {
        const $element = $(event.currentTarget);
        const id = $element.data('id');
        const action = $element.data('action');
        let qty = $element.parent().children('.input_qty').val();

        $.ajax({
            url : "/cart/change",
            type: "POST",
            data: {
                id: id,
                qty: qty,
                action: action,
            },
            success : function (response) {
                response = JSON.parse(response);
                if(response.success == 'ok'){
                    alert(response.message);
                }
            }
        });
    });
</script>-->

<?php
/*"app\\controllers\\": "../controllers/",
            "app\\models\\": "../models/",
            "app\\services\\": "../services/"*/