<?php
/**
 * @author goi
 * @copyright 2015
 */

function mess($mesText = '', $mesType = 'mInformation')
{
    switch ($mesType) {
        case "mInformation":
            $img_ = "img/information.png";
            break;
        case "mWarning":
            $img_ = "img/warning.png";
            break;

    }
    echo('
    <HTML>
     <HEAD>
       <style type="text/css">
         #modal_form {width: 600px;height: 80px;border-radius: 5px;border: 0;background: #fff;position: fixed;top: 25%;left: 50%;	margin-top: -250px; margin-left: -300px; display: none;	opacity: 0;	z-index: 5;	padding: 20px 10px; box-shadow: 0 0 10px rgba(0,0,0,0.3)}
         #modal_form #modal_close {position: absolute; top: 5px; right: 5px; cursor: pointer;	display: block;}
         #overlay {z-index: 3; position: fixed; background-color: #000; opacity: 0.1; width: 100%;height: 100%; top: 0; left: 0;	cursor: pointer; display: none;}
         #p_modal {font-family: Geneva, Arial, Helvetica, Sans-serif; font-size:14px; margin-left:45px}
         .div_img {width:40px; height: 60px;  position: absolute;  display: table-cell;}
         .div_img img {height: 32px; position: absolute; top: 50%; margin-top: -16px;} 
         .div_txt {width:600px; height: 60px;  margin-left: 40px; display: table-cell; vertical-align: middle;}
       </style>
        <script type="text/javascript" src="js/jquery.js"></script>
        <script>
          function showModal(){$("#overlay").fadeIn(200, function(){$("#modal_form").css("display", "block").animate({opacity: 1, top: "50%"}, 200);});};
          function closeModal(){$("#modal_form").animate({opacity: 0, top: "45%"}, 200,	function(){$("#modal_form").css("display", "none");	$("#overlay").fadeOut(200);});};
          $(document).ready(function() {
            showModal();
            $("#modal_close, #overlay").click( function(){closeModal();});
            });
        </script>
     </HEAD>
     <BODY>
       <div id="modal_form"> 
       <img src="img/close_modal.png" id="modal_close" width="16" height="16"/>
       <hr noshade size=1px color="#F3F3F3">
       <div class="div_img">
         <img src="' . $img_ . '" width="32" height="32">
       </div>
       <div class="div_txt">
         <p id="p_modal">&nbsp;&nbsp;' . $mesText . '</p>
       </div>
       </div>
       <div id="overlay"></div>
     </BODY>
  </HTML>
  
  
  ');
}

?>





  