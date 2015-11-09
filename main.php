<?php
session_start();
//Подключаем модули
//require('db.class.php');
require('db.class1.php');
require('utils.php');
require('html_table.class.php');
require('config.php');
require('page.class.php');
//*********************
if (!$_SESSION["is_auth"]) {
  mess("Страница не авторизована!");  
  exit;  
}
//*********************
//Создание объекта $tbl на классе HTML_Table 
$tbl = new HTML_Table('', 'demoTbl');
$tbl->addCaption('Заголовок!!!', 'cap', array('id'=> 'tblCap') );
//Заголовок
$tbl->addRow();
    $tbl->addCell('Id', 'first', 'header');
    $tbl->addCell('Строковое поле 1', '', 'header');
    $tbl->addCell('Строковое поле 2', '', 'header');
    $tbl->addCell('Цифровое поле с п/т 1', '', 'header');
//Создание объекта $db на классе Database
$db = new Database(HOST,USER,PASSWORD,DB);

$db->query('
    CREATE TABLE IF NOT EXISTS `tst_tbl` (
      `id` int(11) NOT NULL AUTO_INCREMENT,
      `field_s_1` varchar(255) NOT NULL,
      `field_s_2` varchar(255) NOT NULL,
      `field_n_1` float NOT NULL,
       PRIMARY KEY (`id`)
       ) ENGINE=InnoDB  DEFAULT CHARSET=cp1251 AUTO_INCREMENT=1');
$db->execute();

//Назначение SQL запроса
$db->query('SELECT id, field_s_1, field_s_2, field_n_1 FROM tst_tbl');
$rows = $db->resultset();
$numrows =  $db->rowCount($rows);
if ($numrows >0){
    foreach($rows as $m_rows){
        $tbl->addRow();
        $tbl->addCell($m_rows['id']);
        $tbl->addCell($m_rows['field_s_1']);
        $tbl->addCell($m_rows['field_s_2']);
        $tbl->addCell('$' . number_format($m_rows['field_n_1'], 2), 'num' );
    }
} else{
    $db->query("
        INSERT INTO `tst_tbl` (`id`, `field_s_1`, `field_s_2`, `field_n_1`) VALUES
        (1, 'Текстовое поле 1', 'Текстовое поле 2', 123),
        (2, 'Текстовое поле 321', 'Текстовое поле 333', 321)");
    $db->execute();
    $db->query('SELECT id, field_s_1, field_s_2, field_n_1 FROM tst_tbl');
    $rows = $db->resultset();
    foreach($rows as $m_rows){
        $tbl->addRow();
        $tbl->addCell($m_rows['id']);
        $tbl->addCell($m_rows['field_s_1']);
        $tbl->addCell($m_rows['field_s_2']);
        $tbl->addCell('$' . number_format($m_rows['field_n_1'], 2), 'num' );
    }
}
//Футер для таблицы
$tbl->addRow();
    $tbl->addCell('Футер для таблицы!', 'foot', 'data', array('colspan'=>4) );
//Создание объекта $page класca Page    
$page = new Page();
$out = $page->get_body('main_template',$tbl->display());
echo $out;
?>
