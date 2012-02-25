<?php
    require_once('lib.model/class.model.php');
    print "test";
    
    $conn = new model('jarvis');
    $conn->from('config');
    print $conn->assemble();
    
    
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