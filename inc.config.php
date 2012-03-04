<?php
    require_once('lib.model/class.model.php');
    
    $services = getenv("VCAP_SERVICES");
    if($services) {
        $services_json = json_decode($services,true);
        $mysql_config = $services_json["mysql-5.1"][0]["credentials"];
    }
    
    $db = $mysql_config['name'];
    //$musicTbl = '`'.$db.'`.`music`';
    //$configTbl = '`'.$db.'`.`config`';
    $configTbl = `config`;
    $musicTbl = `music`;
    
    function runQuery($sql) {
        $query = mysql_query($sql,$conn) or die('Query failed:'.mysql_error());
        //print "<div class='err'>".mysql_error($conn)."</div>";
        $result = mysql_fetch_assoc($query) or die('Fetch failed:'.mysql_error());
        if(mysql_num_rows($result)>0) {    
            print mysql_num_rows($result)." rows returned.";
            var_dump($result);
        } else
            print "No rows returned.";
    }

    $server = $mysql_config['host'].':'.$mysql_config['port'];
    $conn = mysql_connect($server, $mysql_config['username'], $mysql_config['password']) or die('Connection failed:'.mysql_error());
    mysql_select_db($db,$conn) or die('Database not selected:'.mysql_error());
//    runQuery("fghjkl");
//    runQuery("INSERT INTO $configTbl (name, value) VALUES ('musicTbl', 'music')");
//    runQuery("SHOW TABLES FROM $db");
//    runQuery("SELECT `value` FROM $configTbl WHERE name='musicTbl'");

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