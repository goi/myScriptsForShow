<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="content-type" content="text/html" />

<style type="text/css">
    body, td {font: 14px/1.3 verdana, arial, helvetica, sans-serif;}
    table.demoTbl {border-collapse: collapse; margin: 0 auto;}
    table.demoTbl td, table.demoTbl th {padding: 6px 8px; border:1px solid #000;}
    table.demoTbl th { text-align:left;}
    table.demoTbl td.num {text-align:right;}
    table.demoTbl td.foot {text-align: center;}
    #main_table {opacity: 0; top: 150px; position: relative;  padding: 10px; width: 600px; margin: 0 auto;  text-align: center; margin-top: 30px; box-shadow: 0px 0px 10px rgba(1,1,0,0.5);}
    #pointer1 {display: none; position: absolute; top: 30px;}
    div.txt_around {width: 280px; position: absolute; top: 200px; left: 50px; display: none;}
</style>    

<title>Table Test</title>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript">
$(document).ready(function(){
  $('#main_table').animate({
    top: "0px",
    opacity: 1
  }, 1000 ,function(){$('#pointer1').fadeIn('slow',function(){$('.txt_around').fadeIn('slow')
        });
    });
});
</script>
</head>
<body>
<div id="main_table">

<?php
  if (isset($tbl)){
    echo $tbl;
  } 
?>

</div>
<img src="img/pointer.png" id="pointer1" />
<div class="txt_around">
<p><strong>Таблица построена на классе HTML_Table</strong></p>
</div>

</body>
</html>