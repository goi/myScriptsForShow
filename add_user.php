<!DOCTYPE HTML>
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=windows-1251"/>
    <link href="css/insert.css" rel="stylesheet" type="text/css" media="screen">
    <script type="text/javascript" src="js/jquery.js"></script>
    <script>
        function go_Ajax() {
            $.ajax({
                type: "POST",
                url: "insert_user.php",
                data: {
                    l: $("#login").val(),
                    p: $("#password").val(),
                    p1: $("#password1").val(),
                    n: $("#login_name").val()
                },
                dataType: "text",
                success: function (data) {
                    $("#err").html("");
                    $("#err").fadeOut('slow');
                    switch (data) {
                        case "login_emty" :
                            $("#err").html("�� �������� �����!");
                            break;
                        case "password_emty" :
                            $("#err").html("�� �������� ������!");
                            break;
                        case "password_not_compare" :
                            $("#err").html("������ �� ���������!");
                            break;
                        case "ins_true" :
                            $("#autorization_form").hide('slow').after('<h1>User added</h1>');
                            setTimeout(function () {
                                var url = "index.php";
                                $(location).attr('href', url);
                            }, 2000);
                            break;
                        case "ins_false" :
                            $("#err").html("������ �����������!");
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
    <a class="btn1" href="index.php">�������</a>
</div>

<div class="add_reg">
    <p style="margin-top: 0; margin-bottom: 0;">���������� ��������</p>
    <hr/>
    <form name="autorization_form" id="autorization_form">
        <p class="p1">��� ������������</p>
        <input type="text" size="34" id="login_name"/>

        <p class="p1">�����</p>
        <input type="text" size="34" id="login"/>

        <p class="p1">������</p>
        <input type="password" size="34" id="password"/>

        <p class="p1">������������� ������</p>
        <input type="password" size="34" id="password1"/>
        <br/>
        <a class="submit" href="#" id="okBtn">�����������</a>
    </form>
</div>
<div id="err"></div>
<?php
require('config.php');
if (USER == "XXX") {
    echo '
    <div class="help">
    <p>��� ������� ���������� � ����� config.php ������� ��������������� ������ ����� ��.</p>
    <p>� �� �� ������ ���� ������� � ������ users</p>
    </div>';
}
?>

</body>