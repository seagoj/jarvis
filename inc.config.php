<?php
    require_once('lib.model/class.model.php');
    
    $services = getenv("VCAP_SERVICES");
    if($services) {
        $services_json = json_decode($services,true);
        $mysql_config = $services_json["mysql-5.1"][0]["credentials"];
    }
    
    dbg::vardump($mysql_config);
    $db = $mysql_config['name'];
//    $musicTbl = '`'.$db.'`.`music`';
    $configTbl = '`'.$db.'`.`config`';
    
    /*
    $sql = "CREATE TABLE  $musicTbl (
    `index` INT NOT NULL AUTO_INCREMENT ,
    `artist` VARCHAR( 30 ) NOT NULL ,
    `album` VARCHAR( 50 ) NOT NULL ,
    `format` VARCHAR( 10 ) NOT NULL ,
    PRIMARY KEY (  `index` ) ,
    INDEX (  `index` )
    ) ENGINE = INNODB";
    */

$conn = mysql_connect($mysql_config['host'], $mysql_config['username'], $mysql_config['password']);
/*
$sql = "CREATE TABLE $configTbl(
`index` INT NOT NULL AUTO_INCREMENT ,
`name` VARCHAR( 30 ) NOT NULL ,
`value` VARCHAR( 50 ) ,
PRIMARY KEY (  `index` ) ,
INDEX (  `index` )
) ENGINE = INNODB";

mysql_query($sql,$conn);
print mysql_error();
*/

$sql = "INSERT INTO $configTbl (`name`,`value`) VALUES ('musicTbl','music')";
mysql_query($sql,$conn);
print mysql_error();
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

$sql = "SELECT * FROM $configTbl WHERE 1";
$result = mysql_query($sql,$conn);

print mysql_error();


//$sql = "SELECT * FROM $musicTbl WHERE 1";

//print $sql;


    $query = mysql_query($sql,$conn);
    $result = mysql_fetch_assoc($query);
    var_dump($result);
    
    print mysql_error();
    
    //$conn = new model('jarvis');
    //$conn->from('config');
    //$conn->columns('*');
    //$conn->where(1);
    //print $conn->assemble();
    
    
    /*
	define(DBHOST,"localhost");
	define(DBUSER,"icfjstor_library");
	define(DBPASS,"NUEoilfsamdmaie23814");
	define(DBNAME,"icfjstor_library");
    */
    
	define(MUSICTBL,"music");
	define(VIDEOTBL, "video");
	define(GAMESTBL, "games");
	define(ROOTDIR, "jarvis/");
	
    define(MAILHOST, "mail.seagoj.com");
	define(EMAIL, "jarvis@seagoj.com");
	define(PASS, "gyte526yiojomp98h6rvy");
	define(AUTHEMAIL, "seagoj@gmail.com");
	define(SIGLEN, -127);
	define(TESTEMAIL, "kat.dankel@gmail.com");
	
	//mysql_connect(DBHOST,DBUSER,DBPASS) or die("connection");
	//mysql_select_db(DBNAME) or die("selection");
?>