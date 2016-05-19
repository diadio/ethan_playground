<html>
<head>
<title>--HELLO LINE BOT--</title>
</head>
<?php
   if($_GET['ctrl'] =='linebot')
   {
        include './class/curld.php';
        include './class/getpost.php';

        $ctrlObj = new getpostCtrl();

   }
?>
</html>