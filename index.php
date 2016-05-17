<html>
<head>
<title> HELLO LINE BOT  </title>
</head>
<?php
   if($_GET['ctlr'] =='linebot')
   {
        include './class/getpost.php';
        $ctrlObj = new getpostCtrl();
   }
?>
</html>