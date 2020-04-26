<html lang="en">
    <head>
        <title>Like_Service</title>
    </head>
    <body>
    <div class="navbar" id="navbar">
        {% if SESSION_LOGIN is empty %}
        <a href="#" id="login_link" onclick="login();">Войти</a>
        <a href="#" id="reg_link" onclick="registr()";>Зарегистрироваться</a>
        {% else %}
        <a href="/home" id="reg_link";>{{SESSION_LOGIN}}</a>
        {% endif %}
    </div>
    <div class="content">
        <form action="/login" method="POST" id="login_form">
            <input type="hidden" name="token" value="{{token}}">
            <input type="text" name="login" id="auth_login" placeholder="Введите Логин"><br>
            <input type="text" name="password" id="auth_password" placeholder="Введите Пароль"><br>
            <input type="submit" name="submit" id="auth_submit" value="Войти">
        </form>
        <form action="/registration" method="POST" id="registration_form">
            <input type="hidden" name="token" value="{{token}}">
            <input type="text" name="reg_login" id="reg_login" placeholder="Придумайте Логин"><br>
            <input type="email" name="reg_email" id="reg_email" placeholder="Введите Емайл"><br>
            <input type="number" name="reg_age" id="reg_age" min="13" max="120" placeholder="Введите Ваш Возраст"><br>
            <input type="text" name="reg_password" id="reg_password" placeholder="Введите Пароль"><br>
            <input type="text" name="reg_password2" id="reg_password2" placeholder="Повторите Пароль"><br>
            <input type="submit" name="reg_submit" id="reg_submit" value="Зарегистрироваться">
        </form>
    </div>
    </body>
</html>




