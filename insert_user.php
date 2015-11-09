<?php

require('db.class1.php');
require('config.php');

// Возвращаемые значения:
//login_emty
//password_emty
//password_not_compare
//ins_true
//ins_false


function blowfishSalt($cost = 13){
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
$p1 = $_POST['p1'];
$n = $_POST['n'];

if (strlen ($l)==0){
  exit ("login_emty");
};
  if (strlen ($p)==0){
  exit ("password_emty");
}

if ($p!==$p1){
    exit("password_not_compare");
}

$password_hash = crypt($p, blowfishSalt());

$db = new Database(HOST,USER,PASSWORD,DB);
$db->query("CREATE TABLE IF NOT EXISTS `users` (
            `id` int(10) NOT NULL AUTO_INCREMENT,
            `name` varchar(255) NOT NULL,
            `login` varchar(20) NOT NULL,
            `password_hash` varchar(255) NOT NULL,
            PRIMARY KEY (`id`)) ENGINE=InnoDB  DEFAULT CHARSET=cp1251 AUTO_INCREMENT=1 ;");
$db->execute();

$db->query('insert into users (name, login, password_hash) VALUES(:n,:l,:password_hash)');
$db->bind(':n', $n);
$db->bind(':l', $l);
$db->bind(':password_hash', $password_hash);

if ($db->execute()) {
    echo ("ins_true");
} else{
    echo ("ins_false");
}



?>