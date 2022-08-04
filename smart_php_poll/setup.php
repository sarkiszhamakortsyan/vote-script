<HTML><HEAD><TITLE>Smart PHP Poll Setup</TITLE>
<LINK href="style.css" type="text/css" rel="stylesheet">
</HEAD>
<BODY>
<?php
foreach($_GET AS $key => $value) {
${$key} = $value;
} 
foreach($_POST AS $key => $value) {
${$key} = $value;
} 
if($action==""){
echo "<form method=post action=\"?action=setup\"><table width=45% align=center cellspacing=0><TR bgcolor=\"#E6e6e6\" height=\"26\"><TD align=center width=100% colspan=2><b>Welcome to Smart PHP Poll Setup</b></TD></TR><TR bgcolor=\"#F6f6f6\"><TD align=center style=\"BORDER-LEFT:#E6e6e6 1px solid;BORDER-BOTTOM:#E6e6e6 1px solid;\" width=\"20%\"><img src=\"images/new_ad.png\"></TD><TD align=center width=80% style=\"BORDER-RIGHT:#E6e6e6 1px solid;BORDER-BOTTOM:#E6e6e6 1px solid;\"><BR>&nbsp;<input type=submit value=\" START INSTALLATION \"><BR><BR></TD></TR></table></form><BR>";
}
if($action=="setup"){
include ("conf.php");
$db=mysql_connect($db_host,$database_user,$database_pass) or die("<b>MySQL Error:</b> Unable to connect to database please check that you have provided the correct <li>Database Login username<li>Database Login Password");	//Connect to database or give error if failed
mysql_select_db($db_name,$db)or die("<b>MySQL Error:</b> Unable to select database please check that you have provided the correct <li>Database name");
$sql= mysql_query("CREATE TABLE smp_ad (op INT NOT NULL AUTO_INCREMENT PRIMARY KEY,admin_id VARCHAR(30) NOT NULL,admin_pass VARCHAR(35) NOT NULL)");
if($sql){
$isql=mysql_query("INSERT INTO smp_ad SET admin_id='admin',admin_pass='password'");
}
$sql= mysql_query("CREATE TABLE smp_quiz (op INT NOT NULL AUTO_INCREMENT PRIMARY KEY,title TEXT,tm VARCHAR(15))");
$sql= mysql_query("CREATE TABLE smp_cust (op INT NOT NULL AUTO_INCREMENT PRIMARY KEY,pw VARCHAR(10),boc VARCHAR(10), bbc VARCHAR(10),hlc VARCHAR(10),hls VARCHAR(10),ttc VARCHAR(10),bts VARCHAR(10),btc VARCHAR(10),buc VARCHAR(10))");
if($sql){
$ins=mysql_query("INSERT INTO smp_cust SET pw='300',boc='#009900',bbc='#FFFFCC',hlc='#339900',hls='10',ttc='#FFFFFF',bts='10',btc='#000000',buc='#000000'");
}
$sql= mysql_query("CREATE TABLE smp_answer (op INT NOT NULL AUTO_INCREMENT PRIMARY KEY,answer VARCHAR(250),point INT,qid INT,tm VARCHAR(15))");
$sql= mysql_query("CREATE TABLE smp_result (op INT NOT NULL AUTO_INCREMENT PRIMARY KEY,point INT,ip VARCHAR(30), tm VARCHAR(15))");
echo "<table width=95% align=center><TR><TD width=100% align=center style=\"color:#616161; border-color:#E6e6e6; border-width:1px; border-style:solid;\"><BR><BR><B>Setup successfully completed!</B><BR><font color=blue>Admin Login ID: admin<BR>Admin Login Password: password</font><BR><font color=red><b>Please delete setup.php from server.</b></font><BR><BR><BR></TD></TR></table>";
}
?>
</BODY>
</HTML>