<h3>Введите данные для входа на сайт</h3>
<div id="login">
    <h2><?= $message; ?></h2>
    <h3>Форма для входа на сайт: </h3>
    <form action="/user/login" method="POST" class="regist">
        <input type="login" name="login" placeholder="login" required/>
        <input type="password" name="password" required/>
        <input type="submit" />
    <form>
    <a href="/user/registration">Зарегистрироваться на сайте</a>
</div>