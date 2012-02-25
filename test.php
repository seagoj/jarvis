<?php
require_once('lib.dbg/class.dbg.php');

dbg::test(false);
dbg::test('false');

/*
include_once('class.query.php');

try {
	$insQry = new query("INSERT INTO `".MUSICTBL."` (album,artist) VALUES ('Noble Beast', 'Andrew Bird')");
	$selQry = new query("SELECT * FROM `music` WHERE artist='Andrew Bird'");
	$updQry = new query("UPDATE `".MUSICTBL."` SET album='Useless Creatures' WHERE album='Noble Beast'");
	$delQry = new query("DELETE FROM `".MUSICTBL."` WHERE album='Useless Creatures'");
	$selQry2 = new query("SELECT * FROM `music` WHERE artist='Andrew Bird'");
	
	if($insQry->result())
		print "<div>Insert Successful</div>";
		
	print "<div>";
	while($row=mysql_fetch_assoc($selQry->result())){
		print_r($row);
	}
	print "</div>";
	
	if($updQry->result())
		print "<div>Update Successful</div>";
		
	if($delQry->result())
		print "<div>Delete Successful</div>";
		
	print "<div>";
	while($row=mysql_fetch_assoc($selQry2->result())){
		print_r($row);
	}
	print "</div>";
	
} catch(Exception $e) {
	echo $e->errorMessage();
	exit();
}
*/
?>