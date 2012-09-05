<?php
include_once('inc.config.php');

class sqlconnection {
	private $link;
	
	function __construct() {
		print "<div>sqlconnection::construct</div>";
		$this->link = mysql_connect(DBHOST,DBUSER,DBPASS) or die("connection");
		$this->open();
		return $this->link;
	}
	function __destruct() {
		print "<div>sqlconnection::destruct</div>";
		mysql_close($this->link);
		unset($this->link);
	}
	
	public function open() {
		mysql_select_db(DBNAME) or die("selection");
	}
	public function retLink() {
		return $this->link;
	}
}
?>