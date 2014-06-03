<?php
include_once('inc.config.php');
class custException extends Exception
{
	public function errorMessage()
	{
		$label = '<span style="color:red;">Caught Exception</span>';
		$msg = '<span style="color:green;">'.$this->getMessage().'</span>';
		$file = '<span style="color:blue">'.substr($this->getFile(), strripos($this->getFile(), ROOTDIR, 0)+strlen(ROOTDIR)).'</span>';
		$line = '<span style="color:blue;">'.$this->getLine().'</span>';
		
		return $label.': '.$msg.' on line '.$file.':'.$line;
	}
}
?>