<html>
<head>
<title>--HELLO LINE BOT--</title>
<style>
  h1{
    text-align: center;
  }
</style>
</head>
<?php
   if($_GET['ctrl'] =='linebot')
   {
        include './class/curld.php';
        include './class/getpost.php';

        $ctrlObj = new getpostCtrl();
   }
?>
<h1>Welcome!</h1>
</html>