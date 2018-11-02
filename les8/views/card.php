<?php if($model): ?>
    <h2>Подробное описание товара: </h2>
    <div id="one_product">
        <h2><?= $model->name ?></h2>
        <div class="images">
            <?php foreach($images as $image): ?>
            <img src="/image/products/full/<?= $image ?>" />
            <?php endforeach; ?>
        </div>
        <p class="descrip"><?= $model->full_description ?></p>
        <h2>Цена: <?= $model->price ?> руб.</h2>
        <div class="form">
            <input class="input_qty" type="number" min="1" max="100" value="1" name="count" />
            <button name="id_product" data-id="<?= $model->id ?>" data-action="add">Добавить в корзину</button>
        </div>
    </div>
<?php else: ?>
    <h2>Запрашиваемый товар не найден!</h2>
<?php endif; ?>
<!--<script>
    $('button').click((event) => {
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
