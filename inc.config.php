<?php
    require_once('lib.model/class.model.php');
    
    $services = getenv("VCAP_SERVICES");
    if($services) {
        $services_json = json_decode($services,true);
        $mysql_config = $services_json["mysql-5.1"][0]["credentials"];
    }
    
    $db = $mysql_config['name'];
    $musicTbl = '`'.$db.'`.`music`';
    $configTbl = '`'.$db.'`.`config`';
    
    function runQuery($sql) {
        print "<div>$sql</div>";
        $query = mysql_query($sql,$conn);
        print mysql_error();
        $result = mysql_fetch_assoc($query);
        if(mysql_num_rows($result)>0) {    
            print mysql_num_rows($result)." rows returned.";
            var_dump($result);
        } else {
            print "No rows returned.";
        }
    }

    $server = $mysql_config['host'].':'.$mysql_config['port'];
    $conn = mysql_connect($server, $mysql_config['username'], $mysql_config['password']);
    print mysql_error();
    if(!$conn) print "Connection failed";
    else print "Successful connection";

    runQuery("fghjkl");
    runQuery("INSERT INTO $configTbl (name, value) VALUES ('musicTbl', 'music')");
    runQuery("SHOW TABLES FROM $db");
    runQuery("SELECT `value` FROM $configTbl WHERE name='musicTbl'");

    /*
	define(DBHOST,"localhost");
	define(DBUSER,"icfjstor_library");
	define(DBPASS,"NUEoilfsamdmaie23814");
	define(DBNAME,"icfjstor_library");
    
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
	
	mysql_connect(DBHOST,DBUSER,DBPASS) or die("connection");
	mysql_select_db(DBNAME) or die("selection");
    */
?>