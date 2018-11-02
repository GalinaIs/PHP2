<div id="regist">
    <h2><?= $message; ?></h2>
    <h3>Форма для регистрации на сайте: </h3>
    <form action="/user/registration" method="POST" class="regist">
        <input type="text" name="name" placeholder="Введите имя" required/>
        <input type="login" name="login" placeholder="Введите логин" required/>
        <input type="password" name="password" required/>
        <input type="submit" />
    <form>
</div>