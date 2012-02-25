<?php
	print "<div>before inc.config</div>";
    print "<div>before class.query</div>";
	
	function remSignature($email) {
		return substr($email, 0, strpos($email, "<br clear=\"all\">"));
	}
	
	function parse($body) {
			$data = array();
			while (strlen($body)!= 0) {
				
				$var = substr($body, strpos($body, "@")+1, strpos($body, " ")-1);
				$token = "@".$var." ";
				
        		if(!(strpos($body, "<br>")===false)) {
        			$nextRet = strpos($body, "<br>");
        			$error .= "End Line Found at $nextRet<br>";
        		}
        		else {
        			$nextRet = strlen($body);
        			$error .= "No End Line<br>$nextRet<br>$body<br>";
        		}
        		$$var = ucwords(substr($body, strpos($body, $token)+strlen($token), $nextRet-strpos($body, $token)-strlen($token)));
        		if(substr($$var, 0, 3)=="The") {	
        			$$var = substr($$var, 4).", The";
        		}
        		$data = array_merge($data, array($var=>$$var));
        		if(!(strpos($body, "<br>")===false)) {
        			$body = substr($body, strpos($body, "<br>")+4);
        		} else { 
        			$body = '';
        		}
				
				
				/* DEVELOPMENT
				$body = "@artist The White Stripes<br>@title White Blood Cells<br>";
				//print $body;
				//print strpos($body, "@")+1;
				//print strpos($body, " ")-1;
				$var = substr($body, strpos($body, "@")+1, strpos($body, " ")-1);
				$token = "@".$var." ";
				//print $var.$token;
				
				$$var = substr($body, strpos($body, $token, (strpos($body, "<br>"))));
				
				$data = array_merge($data, array($var=>$$var));
				*/
			}
			//print_r($data);
			//mail("seagoj@gmail.com", "debug", $data['upc'], "from:<jarvis@seagoj.com>\nContent-Type: text/html; charset=iso-8859-1");
		return $data;
	}
	
	function getTable($command) {
		if(!(strpos($command, "music")===false))
			$table = MUSICTBL;
			
		if(!(strpos($command, "video")===false) ||!(strpos($command, "movie")===false)||!(strpos($command, "movies")===false))
			$table = VIDEOTBL;
			
		if(!(strpos($command, "game")===false) ||!(strpos($command, "games")===false))
			$table = GAMESTBL;
			
		return $table;
	}
	
	function getAction($command) {
		if(!(strpos($command, "add")===false))
			$action = "INSERT";
			
		if(!(strpos($command, "update")===false))
			$action = "UPDATE";

		if(!(strpos($command, "search")===false))
			$action = "SELECT";
			
		if(!(strpos($command, "delete")===false))
			$action = "DELETE";
			
		if(!(strpos($command, "lookup")===false))
			$action = "LOOKUP";
			
		return $action;
	}
	
	function getMsgValues($flag, $data) {
		switch ($flag) {
			case MUSICTBL:
				$title = "Album"; 
	   			$value = $data['artist']." '".$data['album']."'<br>";
	   			break;
	   		case VIDEOTBL:
	   			$title = "Video";
	   			$value = $data['title']."<br>";
	   			break;
	   		case GAMESTBL:
	   			$title = "Game";
	   			$value = $data['title']." ".$data['system']."<br>";
	   			break;
		}
		return array('title'=>$title, 'value'=>$value);
	}
	
	function notFoundMsg($flag, $data) {
		$msg = getMsgValues($flag, $data);
		return $msg['title']." Not Found: ".$msg['value'];
	}
	
	function dupFoundMsg($flag, $data) {
		$msg = getMsgValues($flag, $data);
		
		return "Duplicate ".$msg['title']." Found: ".$msg['value'];
	}
	
	function insertedMsg($flag, $data) {
		$msg = getMsgValues($flag, $data);
		return $msg['title']." Added Successfully: ".$msg['value'];
	}

	function updatedMsg($flag, $data) {
		$msg = getMsgValues($flag, $data);
		return $msg['title']." Updated Successfully: ".$msg['value'];
	}
	
	function deletedMsg($flag, $data) {
		$msg = getMsgValues($flag, $data);
		return $msg['title']." Deleted Successfully: ".$msg['value'];
	}
	
	function genDupQry($flag, $data) {
		switch($flag) {
	   		case MUSICTBL: 
	   			$output = " AND `artist`='".$data['artist']."' AND `album`='".$data['album']."'";
	   			break;
	   		case VIDEOTBL:
	   			$output = " AND `title`='".$data['title']."'";
	   			break;
	   		case GAMESTBL:
	   			$output = " AND `title`='".$data['title']."' AND `system`='".$data['system']."'";
	   			break;
	   		default:
	   			$output = "";
	   			break;
   		}
   		return $output;
	}
	
	function performTask($command, $data, $email) {
		$table = getTable($command);
		switch (getAction($command)) {
			case "SELECT":
				$output = '';
   				$srchQry = "SELECT * FROM `".$table."` WHERE 1";
   					foreach ($data as $key=>$value){
						$srchQry.=" AND `".$key."`='".$value."'";
   					}
   				//print $srchQry;
   				$srchRes = mysql_query($srchQry);
   				$cols = mysql_query("select column_name from information_schema.columns where table_name='".$table."'; ");

   				while($row=mysql_fetch_assoc($srchRes)){
   					$cols = mysql_query("select column_name from information_schema.columns where table_name='".$table."'; ");
   				    while($col=mysql_fetch_assoc($cols)) {
    					if($col['column_name'] != 'index') {
   							$output .= "<b>".ucwords($col['column_name'])."</b>: ".$row[$col['column_name']] ."<br>";
    					}
   				    }
    				$output .= "<br />";
   				}
   				if(!$output) {
   					$output = notFoundMsg($table, $data);
   				}
   				mail($email, "RE: $command", $output, "from:<jarvis@seagoj.com>\nContent-Type: text/html; charset=iso-8859-1");
				break;
		
			case "INSERT":
		   		$dupQry = "SELECT * FROM `".$table."` WHERE 1";
		   		$dupQry .= genDupQry($table, $data);
   				$dupRes = mysql_query($dupQry);
   				
   				if(mysql_num_rows($dupRes)!=0) {
   					mail($email, "Duplicate Entry", dupFoundMsg($table, $data), "from:<jarvis@seagoj.com>");
   				} else {
   					$keyList = '';
   					$valueList = '';
   					foreach($data as $key=>$value) {
   						if($keyList != '') {
   							$keyList .= ", $key";
   							$valueList .= ", '".$value."'";
   						} else {
   							$keyList .= "$key";
   							$valueList .= "'".$value."'";
   						}
   					}
   					$qry = "INSERT INTO `".$table."` ($keyList) VALUES ($valueList)";
   					if(mysql_query($qry)) {
   						mail($email, "RE: $command", insertedMsg($table, $data), "from:<jarvis@seagoj.com>\nContent-Type: text/html; charset=iso-8859-1");
   					}
   					print_r(mysql_error());
   				}
				break;
				
			case "UPDATE":
		   		foreach ($data as $key=>$value){
		   			if($updQryApp!='') {
						$updQryApp.=" AND `".$key."`='".$value."'";
		   			} else
		   				$updQryApp.=" `".$key."`='".$value."'";
   				}
   				$updQry = "UPDATE `".$table."` SET".$updQryApp;
   				mysql_query($updQry);
   				print_r(mysql_error());
   				mail($email, "Re: $command", updatedMsg($table, $data), "from:<jarvis@seagoj.com>\nContent-Type: text/html; charset=iso-8859-1");
	   			break;
			case "DELETE":
				$delQry = "DELETE FROM `".$table."` WHERE";
					$delQryApp = '';
   					foreach ($data as $key=>$value){
   						if($delQryApp == '')
   							$delQryApp=" `".$key."`='".$value."'";
   						else
							$delQryApp.=" AND `".$key."`='".$value."'";
   					}
   				//print $delQry.$delQryApp;
   				$delRes = mysql_query($delQry.$delQryApp);
   				print_r(mysql_error());
   				mail($email, "Re: $command", deletedMsg($table, $data), "from:<jarvis@seagoj.com>\nContent-Type: text/html; charset=iso-8859-1");
				break;
			case "LOOKUP":
				require_once('IXR_Library.inc.php');

				//$client = new IXR_Client('www.upcdatabase.com', '/rpc', 80);
				$client = new IXR_Client('webservices.amazon.com', '/onca/xml?Service=AWSECommerceService', 80);
				//http://webservices.amazon.com/onca/xml?Service=AWSECommerceService

				
				//if (!$client->query('lookupEAN', $data['upc'])) {
				if (!$client->query('itemLookup', $data['upc'])) {
    				die('Something went wrong - '.$client->getErrorCode().' : '.$client->getErrorMessage());
				}
				
				$array = $client->getResponse();
				print $data['upc']."<br/>";
				print_r( $array );
//				mail($email, "debug", $array, "from:<jarvis@seagoj.com>\nContent-Type: text/html; charset=iso-8859-1");
				mail($email, "Re: $command", $array, "from:<jarvis@seagoj.com>\nContent-Type: text/html; charset=iso-8859-1");
				break;
		}
	}
?>