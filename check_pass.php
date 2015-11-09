<?php
session_start();
require('db.class1.php');
require('config.php');
// Возвращаемые значения:
//login_emty
//password_emty
//auth_true
//auth_false

function blowfishSalt($cost = 13)
{
    $rand = array();
    for ($i = 0; $i < 8; $i += 1) {
        $rand[] = pack('S', mt_rand(0, 0xffff));
    }
    $rand[] = substr(microtime(), 2, 6);
    $rand = sha1(implode('', $rand), true);
    $salt = '$2a$' . sprintf('%02d', $cost) . '$';
    $salt .= strtr(substr(base64_encode($rand), 0, 22), array('+' => '.'));
    return $salt;
}

$l = $_POST['l'];
$p = $_POST['p'];
//$password_hash = crypt($p, blowfishSalt());

if (strlen($l) == 0) {
    exit ("login_emty");
};
if (strlen($p) == 0) {
    exit ("password_emty");
}
$db = new Database(HOST, USER, PASSWORD, DB);
$db->query('select id, name, password_hash from users where login = :l');
$db->bind(':l', $l);
$rows = $db->resultset();

if ($db->rowCount($rows) == 0) {
    $_SESSION["is_auth"] = false;
    exit("auth_false");
} else {
    $record_password_hash = $rows[0][password_hash];
    if ($record_password_hash === crypt($p, $record_password_hash)) {
        $_SESSION["is_auth"] = true;
        exit("auth_true");
    } else {
        $_SESSION["is_auth"] = false;
        exit("auth_false");
    }
}

?>