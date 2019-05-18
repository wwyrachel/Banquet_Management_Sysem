<?php

class csv extends mysqli{
	private $status = false;
	public function __construct(){
		parent::__construct("localhost", "root", "Y6299618a", "banquetsystem");
		if ($this->connect_error){
			echo "Connection Fails". $this->connect_error;
		}
	}
	public function import($file)
	{
		$file = fopen($file, 'r');
		while ($row= fgetcsv($file)){
			
			print "<pre>";
			print_r($row);
			print "</pre>";
			//$row=fgetcsv($file);
			
			$value= "'".implode("','", $row)."'";
			$sql= "INSERT INTO attendees(fname,lname, type, address, phone, company, organization,
			attendB, dchoice, mchoice, remark, email,payment, 
			seatN, suggestion) VALUES (".$value.")";
			echo $sql;
			if ($this->query($sql)){
				$this->status = true;
				print("Successfully imported to the database");
				
			}else{
				$this->status= false;
				echo $this->error;
			}
		}
	}
}

?>