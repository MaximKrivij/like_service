{% if SESSION_LOGIN is empty %}
NO!
{% else %}
<head>
    <title>Home_Page</title>
</head>
<body>
    <div class="navbar" id="navbar">
        <a href="/home" id="reg_link";>{{SESSION_LOGIN}}</a>
        <form action="out.php" method="post">
            <input type="submit" name="out" value="Выйти">
        </form>
    </div>
</body>
{% endif %}








