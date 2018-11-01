<h3>Добро пожаловать, <?= $user->name; ?>!</h3>
<p>Вы вошли в личный кабинет</p>
<p>Ваш логин: <?= $user->login; ?></p>
<div id="orders_user">
<h3>Заказы, совершенные в нашем интернет магазине: </h3>
<?php foreach ($orders as $oneOrder): ?>
<h4>Заказ номер <?= $oneOrder['id']; ?></h4>
<div class="one_order">
<?php foreach ($oneOrder['order'] as $oneProductOrder): ?>
<div class="one_product_order">
    <a target="_blank " href="/product/card?id=<?= $oneProductOrder->id_product; ?>">
        <img class="my_img" src="/image/products/min/<?= $oneProductOrder->image; ?>" />
        <div class="description">
            <h3><?= $oneProductOrder->name; ?></h3>
        </div>
        <div class="price">Цена:<br> 
            <?= $oneProductOrder->price; ?> руб.
        </div>
        <div class="price">Количество:<br> 
            <?= $oneProductOrder->product_count; ?> шт.
        </div>
    </a>
</div>
<?php endforeach ?>
<p>Общая стоимость заказа: <?= $oneOrder['cost']; ?> руб.<br></p>
<p class="state">Статус заказа: <?= $oneOrder['state']; ?></p>
<?php if( $oneOrder['id_status'] == 1 || $oneOrder['id_status'] == 2): ?>
    <button class="cancel_order" data-id="<?= $oneOrder['id']?>">Отменить заказ!</button>
<?php endif; ?>
</div>
<?php endforeach ?>
</div> 
<script>
    $('.cancel_order').click((event) => {
        const $element = $(event.currentTarget);
        const id = $element.data('id');

        $.ajax({
            url : "/order/cancel",
            type: "POST",
            data: {
                id: id,
            },
            success : function (response) {
                response = JSON.parse(response);
                if(response.success == 'ok'){
                    $element.parent().children('.state').html('Статус заказа: Отменен');
                    $element.parent().children('.state').addClass('cancel');
                    $element.hide();
                    alert(response.message);
                }
            }
        });
    });
</script>