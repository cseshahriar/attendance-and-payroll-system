<?php 
/**
 * Payroll Controller
 */
class Payroll extends Controller 
{
	
	public function __construct()  
	{
		$this->payrollModel = $this->model('PayrollModel');    
	}

	public function index() 
	{
  		// auth check   
  		$this->isLoggedInUser();    

      $deductions = $this->payrollModel->deductions(); 
      $deductionsTotal = $this->payrollModel->deductionsTotal();    

      if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $data = [
          'title' => 'Payroll',
          'from' => $_POST['from'], 
          'to'   => $_POST['to'],   
          'from_error' => '', 
          'to_error' => '',
          'payroll' => '' 
        ]; 

        // payroll
        if (isset($_POST['payrollBtn'])) {      

            if (empty($data['from'])) { 
                $data['from_error'] = 'From date is require';
            } else {
                $data['from'] = date('Y-m-d', strtotime($_POST['from'])); 
            }

            if (empty($data['to'])) {
                $data['to_error'] = 'To date is require';
            }  else {
                $data['to'] = date('Y-m-d', strtotime($_POST['to']));  
            }


           // make sure has no erors 
           if ( empty($data['from_error']) && empty($data['to_error']) ) {     
              // process 
            
              $from = $data['from'];             
              $to = $data['to'];   

              $employeeTotalAttendances = $this->payrollModel->employeeTotalAttendances($from, $to);  
              $overtimes = $this->payrollModel->overtimes($from, $to);   
              $cashes = $this->payrollModel->cash($from, $to);    
              $deductions = $this->payrollModel->advanceDeductions($from, $to);  
              $empDeduction = $this->payrollModel->employeeDeduction($from, $to);  
              $empCashes = $this->payrollModel->employeeCashAdvance($from, $to);     
              
              // net pay  
              $data = [
                'title' => 'Payroll',   
                'payroll' =>  $employeeTotalAttendances,
                'overtimes' => $overtimes,
                'cashes' => $cashes,
                'deductions' => $deductions, 
                'empDeduction' => $empDeduction,   
                'empCashes' => $empCashes
              ]; 

              $this->view('backend/payroll/index', $data);    

           } else { // load view with errors   
              $this->view('backend/payroll/index', $data);    
           }
         

        } 
        
      } else { // get request 
    		  // payroll 
          $to = date('Y-m-d'); 
          $from = date('Y-m-d', strtotime('-30 day', strtotime($to)));
          $employeeTotalAttendances = $this->payrollModel->employeeTotalAttendances($from, $to);  
          $overtimes = $this->payrollModel->overtimes($from, $to);   
          $cashes = $this->payrollModel->cash($from, $to);    
          $deductions = $this->payrollModel->advanceDeductions($from, $to);  
          $empDeduction = $this->payrollModel->employeeDeduction($from, $to);  
          $empCashes = $this->payrollModel->employeeCashAdvance($from, $to);   
          
          // net pay  
    			$data = [
    				'title' => 'Payroll',  
            'payroll' =>  $employeeTotalAttendances, 
            'overtimes' => $overtimes,
            'cashes' => $cashes,
            'deductions' => $deductions, 
            'empDeduction' => $empDeduction,    
            'empCashes' => $empCashes, 
            'from_error' => '', 
            'to_error' => ''    
    			]; 

    			$this->view('backend/payroll/index', $data);            
      }
        
	}



} // end of the class 