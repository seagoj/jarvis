<?php
print "<html>\n<head>\n";
if(_DEBUG_) {
    require_once('lib.dbg/class.dbg.php');
    dbg::setNoCache();
}
include_once('inc.controller.php');
print "</head>\n<body>\n";

$mailserver = "{".MAILHOST.":143/notls}INBOX";
dbg::assert($mailserver=="{mail.seagoj.com:143/notls}INBOX");
$imap = imap_open($mailserver, EMAIL, PASS);
dbg::assert(imap_errors()==NULL);
$emailCount = imap_num_msg($imap);

if($emailCount != 0) {
	for($i=1;$i<=$emailCount;$i++) {
		
		$headers = imap_header($imap,$i);
		$emailFrom = $headers->sender[0]->mailbox.'@'.$headers->sender[0]->host;
	
		if (!isset($headers->sender[0])) {
	    	print "Failed to retrieve headers\n";
	   	} else {
	   		if($emailFrom == AUTHEMAIL || $emailFrom == TESTEMAIL) {
	   			$structure = imap_fetchstructure($imap,$i);
	   			if (!$structure->parts)  {// not multipart
	   		    	$body = imap_body($imap, $i);
	   		    }
	    		else {  // multipart: iterate through each part
	        		$body = imap_fetchbody($imap, $i, 2);
	        		if($emailFrom == AUTHEMAIL)
	        			$body = remSignature($body);
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

print "<div>".rand()."</div>";
print "</body>\n</html>";
?>