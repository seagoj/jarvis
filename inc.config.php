<?php
    require_once('lib.model/class.model.php');
    
    
    $services = getenv("VCAP_SERVICES");
    if($services) {
        $services_json = json_decode($services,true);
        $mysql_config = $services_json["mysql-5.1"][0]["credentials"];
    }
    
    dbg::vardump($mysql_config);
    $db = $mysql_config['name'];
    $musicTbl = '`'.$db.'`.`music`';
    
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

$sql = "INSERT INTO $musicTBL (`artist`,`album`,`format`) VALUES ('White Stripes, The', 'White Blood Cells', 'CD')";

print $sql;

    $conn = mysql_connect($mysql_config['host'], $mysql_config['username'], $mysql_config['password']);
    mysql_query($sql,$conn);
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