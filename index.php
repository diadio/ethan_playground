<?php
   if($_GET['ctlr'] =='linebot')
   {
        include './class/getpost.php';
        $ctrlObj = new getpostCtrl();
   }
?>