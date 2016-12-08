<?php
require_once 'models/loan.php';

class Loan extends Controller {

	public function __construct() {
		parent::__construct();
		$this->tpl_dir = "views/loan/";
		$this->Model = new Loans();
	}
	
	function main(){
		
		$this->tpl = $this->tpl_dir.'main.php';
	}
	
	function register_loan(){
		
		//validate property value
		if(!is_numeric($_REQUEST['property_value']) || $_REQUEST['property_value']==0){
			$output['status'] = 'Error';
			$output['message'] = 'Property value is not valid';
			$this->exportAjax($output);
		}
		
		//validate loan amount
		if(!is_numeric($_REQUEST['loan_amount']) || $_REQUEST['loan_amount']==0){
			$output['status'] = 'Error';
			$output['message'] = 'Loan amount is not valid';
			$this->exportAjax($output);
		}
		
		//validate SSN
		if(!preg_match("/^[0-9]{3}-[0-9]{2}-[0-9]{4}$/", $_REQUEST['ssn'])){
			$output['status'] = 'Error';
			$output['message'] = 'SSN is not valid';
			$this->exportAjax($output);
		}
		
		//if Data valid then evaluate and assgin a loan number
		$data['property_value'] = $_REQUEST['property_value'];
		$data['loan_amount'] = $_REQUEST['loan_amount'];
		$data['ssn'] = $_REQUEST['ssn'];
		$data['status'] = ($_REQUEST['loan_amount']/$_REQUEST['property_value'])>0.4? 'Rejected':'Accepted';
		$this->Model->save($data);
		$output['loan_id'] = $this->Model->dbCon->insert_id;
		$output['status'] = $data['status'];
		$this->exportAjax($output);
	}
	
	private function exportAjax($output){
		echo json_encode($output);
		exit;
	}
	
	function check_loan(){
		$data = $this->Model->findbyID($_REQUEST['loan_id']);
		if(empty($data)){
			$output['status'] = 'Fail';
		}else{
			$output['status'] = 'Success';
			$output['data'] = $data;
		}
		$this->exportAjax($output);
	}

}
