<html>
<head>
<title>--HELLO LINE BOT--</title>
</head>
<?php
   if($_GET['ctrl'] =='linebot')
   {
        include './class/getpost.php';
        $ctrlObj = new getpostCtrl();

        if($_GET['act'] == 'rm')
        {
        	$ctrlObj->rmContent();
        }else{
        	
        	$ctrlObj->saveContent();
        }
   }
?>
</html>