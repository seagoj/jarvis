<?php
print "<html>\n<head>\n";
if(_DEBUG_) {
    require_once('lib.dbg/class.dbg.php');
    dbg::setNoCache();
}
include_once('inc.controller.php');
print "</head>\n<body>\n";

$mailserver = "{".MAILHOST.":143/notls}INBOX";
dbg::test($mailserver=="{mail.seagoj.com:143/notls}INBOX",__METHOD__);
$imap = imap_open($mailserver, EMAIL, PASS);
$emailCount = imap_num_msg($imap);
dbg::test(imap_errors()==NULL, __METHOD__);
if($emailCount != 0) {
	for($i=1;$i<=$emailCount;$i++) {
		
		$headers = imap_header($imap,$i);
        dbg::test(isset($headers),__METHOD__);
		$emailFrom = $headers->sender[0]->mailbox.'@'.$headers->sender[0]->host;
	    dbg::test(strpos($emailFrom, '@') && strpos($emailFrom),'.'),__METHOD__);
		if (!isset($headers->sender[0])) {
	    	print "Failed to retrieve headers\n";
	   	} else {
               //dbg::test(isset($headers->sender[0]),__METHOD__);
	   		if($emailFrom==AUTHEMAIL || $emailFrom==TESTEMAIL) {
                
	   			$structure = imap_fetchstructure($imap,$i);
                //dbg::test(isset($structure), __METHOD__);
	   			if (!$structure->parts)  {// not multipart
	   		    	$body = imap_body($imap, $i);
                //    dbg::test(is_string($body), __METHOD__);
	   		    }
	    		else {  // multipart: iterate through each part
	        		$body = imap_fetchbody($imap, $i, 2);
                //    dbg::test(is_string($body, __METHOD__));
	        		if($emailFrom==AUTHEMAIL) {
	        			$body = remSignature($body);
                //        dbg::test(dbg::test(is_string($body), __METHOD__);
	        		}
	    		}
	    		$data = parse($body);
	        	performTask(strtolower($headers->subject), $data, $emailFrom);
	   		}
	   		//destroy variables
	   		unset($data);
	   }
       if(!_DEBUG_) imap_delete($imap, $i);
	}
	imap_expunge($imap);
	imap_close($imap);
}

dbg::msg(rand());
print "</body>\n</html>";
?>