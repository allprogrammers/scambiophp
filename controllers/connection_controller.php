<?php

	class datahandler{
		public $core;
		function __construct(){
			$this->core=new mysqli("localhost", "scambio", "scambio", "scambio", 3306);
			if ($this->core->connect_errno) {
				//echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
				$_SESSION['error']="Connection Problemdb";
				return 0;
			}
		}
		function proque($query){
			$res1 = $this->core;
			$res = $res1->query($query);
			if(substr($query,0,6)=="INSERT"){
				$_SESSION['insertid']=$res1->insert_id;
			}
			if (!$res) {
				echo "Let's see" . $res1->errno . ") " . $this->core->error;
				$_SESSION['error']="Connection problemqr";
				return 0;
			}
			return $res;
		}
		function getcon(){
			return $this->core;
		}
		function conclose(){
			$this->core->close();
		}
	}

?>