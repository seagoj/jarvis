<?php
mail("jseago@sfccpa.com", "SPF Test", "SPF Test", "From:<jseago@sfccpa.com>\r\nReply-To:<jseago@sfccpa.com>\r\nReturn-Path:<jseago@sfccpa.com>\r\nX-MDRemoteIP:<64.105.19.55>\r\nX-Envelope-From:<jseago@sfccpa.com>\r\nContent-Type: text/html; charset=iso-8859-1");
//mail("mcooper@sfccpa.com", "SPF Test", "SPF Test", "from:<mcooper@sfccpa.com>\nContent-Type: text/html; charset=iso-8859-1");
mail("jseago@sfccpa.com", "SPF Test", "SPF Test", "from:<jarvis@seagoj.com>\nContent-Type: text/html; charset=iso-8859-1");
print "Mail Sent";
?>