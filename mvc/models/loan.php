<?php
class Loans extends Model{
	public function __construct() {
		parent::__construct();
		$this->tableName = "loan";
	}
}