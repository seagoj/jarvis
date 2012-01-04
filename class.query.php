<?php
	include_once('inc.config.php');
	include_once('class.custException.php');
	include_once('class.sqlconnection.php');
	
	class query {
		private $qryStr;
		private $connection;
		private $result;
		
		function __construct($qryStr) {
			print "<div>query::construct</div>";
			$this->connection= new sqlconnection();
			try {
				$this->validateQryStr($qryStr);
				$this->qryStr=$qryStr;
				$this->result = $this->runQry();
			} catch (Exception $e) {
				throw $e;
				exit();
			}
		}
		function __destruct() {
			print "<div>query::destruct</div>";
			unset($connection);
			unset($qryStr);
			unset($result);
		}
		
		private function validateQryStr($qryStr) {
			$value = strtoupper(substr($qryStr, 0, strpos($qryStr, " ")));
			
			// test for valid type
			if($value!="INSERT" && $value!="UPDATE" && $value!="SELECT" && $value!="DELETE") {
				throw new custException("Invalid Type($value)");
			}
			// set type
			else {
				return true;
			}
		}
		private function runQry() {
			if($qry = mysql_query($this->qryStr, $this->connection->retLink()))
				return $qry;
			else throw new custException(mysql_error());
		}
		
		public function result() {
			return $this->result;
		}


	}
?>