<h2>Регистрация</h2>
<form action="/register" name="register" method="post">
    <div><label for="username">Логин</label><input id="username" name="register[username]" type="text"/></div>
    <div><label for="email">E-mail</label><input id="email" name="register[email]" type="email"/></div>
    <div><label for="first_name">Имя</label><input id="first_name" name="register[first_name]" type="text"/></div>
    <div><label for="last_name">Фамилия</label><input id="last_name" name="register[last_name]" type="text"/></div>
    <div><label for="father_name">Отчество</label><input id="father_name" name="register[father_name]" type="text"/></div>
    <div><label for="password">Пароль</label><input id="password" name="register[password]" type="password"/></div>
    <button type="submit">Зарегистрировать</button>
</form>
