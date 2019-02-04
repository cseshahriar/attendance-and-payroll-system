// image upload 
	public function upload() 
	{
		if ($_SERVER['REQUEST_METHOD'] == 'POST') { 

			$data = [
				'title' => 'Image upload', 
				'photo' => $_FILES['photo']  
			];
		
			// file submit check
			if ($data['photo']['name'] != '' && $data['photo']['size'] != null) {
				
				// Allow certain file formats
				$imageFileType = strtolower(pathinfo($data['photo']['name'],PATHINFO_EXTENSION)); 
				if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
				&& $imageFileType != "gif" ) { 
				    $data = [
						'title' => 'Image upload',  
						'photo_error' => 'File is not a image, please upload a image file'   
					]; 
					$this->view('backend/employee/upload', $data); 
				}    
				// Check file size 
				elseif ($data["photo"]["size"] >= 500000) { // 500KB
				    $data = [
						'title' => 'Image upload',  
						'photo_error' => 'Sorry, your file is too large.'    
					];
					$this->view('backend/employee/upload', $data);   
				} else {	
					// image rename and upload process 
					$name = $data['photo']['name'];
					$tmp_name = $data['photo']['tmp_name'];
					$type = $data['photo']['type'];
					$size = $data['photo']['size'];  

					// rename 
					$newName = 'Employee_'.date('Y-m-d_H:i:s')."_".uniqid();    
					$ext = pathinfo($name, PATHINFO_EXTENSION); 
					$newName = $newName.".".$ext; // name with extension
					$fileNameWithUploadDir = '../public/uploads/employee/'.$newName;    

					// for database  
					// $data['photo'] = $newName; // for database
					if ( empty($data['photo_error'])) {
						move_uploaded_file($tmp_name, $fileNameWithUploadDir);   
					}  
				}

			} else {
				$data = [
					'title' => 'Image upload',  
					'photo' => '',
					'photo_error' => 'Something weng wrong!'  
				];
				$this->view('backend/employee/upload', $data);  
			}

			
		} else { 
			$data = [
				'title' => 'Image upload',  
				'photo' => '',
				'photo_error' => ''
			];
			$this->view('backend/employee/upload', $data);   
		}
	}
