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

        // payroll
        if (isset($_POST['payroll'])) {

            if (!empty($_POST['from'])) {
              $from = date('Y-m-d', strtotime($_POST['from']));
            } else {
                $from = date('Y-m-d', strtotime('-30 day', strtotime($to)));
            }

            if (!empty($_POST['to'])) {
              $to = date('Y-m-d', strtotime($_POST['to']));   
            }  else {
                 $to = date('Y-m-d');   
            }

            $employeeTotalAttendances = $this->payrollModel->employeeTotalAttendances($from, $to);  

            $data = [
              'title' => 'Payroll',
              'payroll' =>  $employeeTotalAttendances // employee_id, create_at, in_time, out_time, num_hr, total_hr   
            ];
            $this->view('backend/payroll/index', $data);
         

        } elseif (isset($_POST['payslip'])) { // payslip   

        }
        
      } else { // get request 
    		  // payroll 
          $to = date('Y-m-d'); 
          $from = date('Y-m-d', strtotime('-30 day', strtotime($to)));
          $employeeTotalAttendances = $this->payrollModel->employeeTotalAttendances($from, $to);  
          $overtimes = $this->payrollModel->overtimes($from, $to);      

    			$data = [
    				'title' => 'Payroll',  
            'payroll' =>  $employeeTotalAttendances,
            'overtimes' => $overtimes    
    			]; 
      
    			$this->view('backend/payroll/index', $data);          
      }
        
	}



} // end of the class 