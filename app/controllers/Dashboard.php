<?php 
/**
 * Dashboard Controller 
 */
class Dashboard extends Controller  
{
	
	public function __construct()   
	{
		// auth check
		if (!isset($_SESSION['user_id'])) {
			header("Location: /admin/login");       
		}

		$this->dashboardModel = $this->model('DashboardModel');     
	}

	public function index() 
	{
		// number of employees 
		$numbersOfEmployees = $this->dashboardModel->employeeCount();   

		$totalPresent = $this->dashboardModel->present();
		$totalPresent = $totalPresent->total; 
		
		// number of attendance  
		$total = $this->dashboardModel->numberOfAttendances(); 
		$total = $total->numberOfAttendance;  

		// number of attendance in a time 
		$early = $this->dashboardModel->numberOfAttendancesInRightTime(); //return string     
		$early = $early->numberOfAttendance;

		// early / total * 100 = Attendance percentage
		$attendancesPercentage = ($early/$total) * 100;  

		
		// early present today 
		$todayPresentRightTime = $this->dashboardModel->todayPresentRightTime();  
		$earlyPresent = $todayPresentRightTime->earlyPresent; 

		// late present 
		$todayLatePresent = $this->dashboardModel->todayLatePresent(); 
		$latePresent = $todayLatePresent->latePresent; 
		// ---------- chart -------------------------    
		$data = [ 
			'title' => 'Dashboard', 
			'numbersOfEmployees' => $numbersOfEmployees,
			'totalPresent' => $totalPresent,  
			'attendancesPercentage' => $attendancesPercentage,
			'earlyPresent' => $earlyPresent,  
			'latePresent' => $latePresent   
		];
		
		$this->view('backend/dashboard', $data);         
	}  
}