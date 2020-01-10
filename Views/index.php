<h2>Профиль #<?php echo($_SESSION["user_id"]); ?></h2>
<a href="/logout">Выход</a>
<form action="/index" name="user_update" method="post">
    <div><label for="username">Логин</label><input id="username" name="index[username]" type="text"/></div>
    <div><label for="password">Пароль</label><input id="password" name="index[password]" type="password"/></div>
    <button type="submit">Обновить</button>
</form>
