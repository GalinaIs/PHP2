<h2>Каталог товаров в интернет-магазине "Настасья"</h2>
<div id="products">
<?php foreach($arrayModel as $model): ?>
    <div class="view_product">
        <a target="_blank " href="<?= "product/card?id={$model->id}" ?>">
            <img src="/image/products/min/<?= $model->image; ?>" />
            <div>
                <h3><?= $model->name ?></h3>
                <p><?= $model->short_description ?></p>
            </div>
            <div class="price"><?= $model->price ?> руб.</div>
        </a>
        <div class="form">
            <input class="input_qty" type="number" min="1" max="100" value="1" name="count" />
            <button name="id_product" data-id="<?= $model->id?>" data-action="add">Добавить в корзину</button>
        </div>
    </div>
<?php endforeach;?>
</div>
<script>
    $('button').click((event) => {
        const $element = $(event.currentTarget);
        const id = $element.data('id');
        const action = $element.data('action');
        let qty = $element.parent().children('.input_qty').val();

        $.ajax({
            url : "/basket/change",
            type: "POST",
            data: {
                id: id,
                qty: qty,
                action: action,
            },
            success : function (response) {
                console.log(response);
                response = JSON.parse(response);
                if(response.success == 'ok'){
                    alert(response.message);
                }
            }
        });
    });
</script>