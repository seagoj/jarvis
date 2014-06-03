<?php
require_once('lib.dbg/class.dbg.php');
require_once('lib.model/class.model.php');
    
$services = getenv("VCAP_SERVICES");
if($services) {
    $services_json = json_decode($services,true);
    $mysql_config = $services_json["mysql-5.1"][0]["credentials"];
}
    
dbg::vardump($mysql_config);
$db = $mysql_config['name'];
$musicTbl = '`'.$db.'`.`music`';
$configTbl = '`'.$db.'`.`config`';
    
$server = $mysql_config['host'].':'.$mysql_port['port'];
print $server;
$conn = mysql_connect($server, $mysql_config['username'], $mysql_config['password']);
if(!$conn) print "Connection failed";
else print "Successful connection";
print mysql_error();
    
/*** Connection Made ***/
$musicSQL = "CREATE TABLE  $musicTbl (
`index` INT NOT NULL AUTO_INCREMENT ,
`artist` VARCHAR( 30 ) NOT NULL ,
`album` VARCHAR( 50 ) NOT NULL ,
`format` VARCHAR( 10 ) NOT NULL ,
PRIMARY KEY (  `index` ) ,
INDEX (  `index` )
) ENGINE = INNODB";
    
print "<div>$musicSQL</div>";
$query = mysql_query($musicSQL,$conn);
print mysql_error();
$result = mysql_fetch_assoc($query);
var_dump($result);

$sql = "SHOW TABLES;";
print "<div>$sql</div>";
$query = mysql_query($sql,$conn);
print mysql_error();
$result = mysql_fetch_assoc($query);
var_dump($result);

/*
$sql = "INSERT INTO $configTbl (`name`,`value`) VALUES ('test','test')";
print "<div>$sql</div>";
$query = mysql_query($sql,$conn);
print mysql_error();
$result = mysql_fetch_assoc($query);
var_dump($result);

/*
$sql = "INSERT INTO $configTbl (`name`,`value`) VALUES ('movieTbl','movies')";
mysql_query($sql,$conn);
print mysql_error();
$sql = "INSERT INTO $configTbl (`name`,`value`) VALUES ('bookTbl','books')";
mysql_query($sql,$conn);
print mysql_error();
$sql = "INSERT INTO $configTbl (`name`,`value`) VALUES ('gameTbl','games')";
mysql_query($sql,$conn);
print mysql_error();
$sql = "INSERT INTO $configTbl (`name`,`value`) VALUES ('mailHost','mail.seagoj.com')";
mysql_query($sql,$conn);
print mysql_error();
$sql = "INSERT INTO $configTbl (`name`,`value`) VALUES ('email','jarvis@seagoj.com')";
mysql_query($sql,$conn);
print mysql_error();
$sql = "INSERT INTO $configTbl (`name`,`value`) VALUES ('emailPass','gyte526yiojomp98h6rvy')";
mysql_query($sql,$conn);
print mysql_error();
$sql = "INSERT INTO $configTbl (`name`,`value`) VALUES ('userTbl','users')";
mysql_query($sql,$conn);
print mysql_error();
*/

$sql = "SELECT * FROM $configTbl";
print "<div>$sql</div>";
$query = mysql_query($sql);
$result = mysql_fetch_assoc($result);
var_dump($result);
print mysql_error();
?>