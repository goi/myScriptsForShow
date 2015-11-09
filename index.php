<!DOCTYPE HTML>
<html>
<head>

<meta http-equiv="content-type" content="text/html; charset=windows-1251" />
<link href="css/index.css" rel="stylesheet" type="text/css" media="screen">
<script type="text/javascript" src="js/jquery.js"></script>

<script type="text/javascript">
    document.onkeyup = function (e) {
        e = e || window.event;
        if (e.keyCode === 13) {
            go_Ajax();
        }
        return false;
    }

    function go_Ajax() {
        $.ajax({
            type: "POST",
            url: "check_pass.php",
            data: {l: $("#login").val(), p: $("#password").val()},
            dataType: "text",
            success: function (data) {
                $("#err").html("");
                $("#err").fadeOut('slow');
                switch (data) {
                    case "login_emty" :
                        $("#err").html("Не заполнен логин!");
                        break;
                    case "password_emty" :
                        $("#err").html("Не заполнен пароль!");
                        break;
                    case "auth_true" :
                        $("#autorization_form").hide('slow').after('<h2>Успешная авторизация</h2>');
                        setTimeout(function () {
                            var url = "main.php";
                            $(location).attr('href', url);
                        }, 2000);
                        break;
                    case "auth_false" :
                        $("#err").html("Не верный логин или пароль!");
                        break;
                }
                $("#err").fadeIn('slow');
            }
        })
    }

    $(document).ready(function () {
        $("#okBtn").click(function () {
            go_Ajax()
        })
    });
</script>

</head>
<body>
<div class="header">
    <a class="add" href="add_user.php">+ Add user</a>
    <div class="redline"></div>
</div>



<div class="main_reg">
    <p style="margin-top: 0; margin-bottom: 0;">Регистрация в системе</p>
    <hr/>
    <form name="autorization_form" id="autorization_form">
        <p class="p1">Логин</p>
        <input type="text" size="34" id="login"/>

        <p class="p1">Пароль</p>
        <input type="password" size="34" id="password"/>
        <br/>
        <a class="submit" href="#" id="okBtn">Войти</a>
    </form>
</div>
<div id="err"></div>

</body>