<?php

$GLOBALS['con'] = new PDO('mysql:host=127.0.0.1;dbname=trial', 'root', ''); 

class database {
	
	public $user;
	public $complaint;
	public $municipal;
	public $suggestion;
	public $user_complaint;
	public $municipal_complaint;
	public $user_suggestion;
	public $ngo;
	public $ngo_user;
	public $count;
	
	public function __construct() {
		$this->user = new userx();
		$this->complaint = new complaintx();
		$this->municipal = new municipalx();
		$this->suggestion = new suggestionx();
		$this->user_complaint = new user_complaintx();
		$this->municipal_complaint = new municipal_complaintx();
		$this->user_suggestion = new user_suggestionx();
		$this->ngo = new ngox();
		$this->ngo_user = new ngo_userx();
		$this->count = new countx();
	}
}

class complaint {

	private $complain_no, $complain, $feedback, $activity_report;
	
	public function getComplain_no() {
		return $this->complain_no;
	}
	public function setComplain_no($complain_no) {
		$this->complain_no = $complain_no;
	}
	public function getComplain() {
		return $this->complain;
	}
	public function setComplain($complain) {
		$this->complain = $complain;
	}
	public function getFeedback() {
		return $this->feedback;
	}
	public function setFeedback($feedback) {
		$this->feedback = $feedback;
	}
	public function getActivity_report() {
		return $this->activity_report;
	}
	public function setActivity_report($activity_report) {
		$this->activity_report = $activity_report;
	}
}
	
class userx {
		
	public function fetch_data() {

		try {
			$query = 'select * from user';
			$sql = $GLOBALS['con']->prepare($query);
			$sql->execute();

			while($row = $sql->fetch()) {
   				//echo $row['name']." ".$row['id']." ".$row['pass']."</br>";
			}
		}
			
		catch(Exception $exc) {
			//echo $exc;
		}
			
	}
		
	public function verify_login($id, $pass) {
		
		try {

			$query = 'select * from user where id = ? and pass = ?';
			$sql = $GLOBALS['con']->prepare($query);
			$sql->execute(array($id, $pass));
				
			if($row = $sql->fetch()) {
				//echo "User Verified</br>";
				return 1;
			}
			else {
				//echo "User not Verified</br>";
				return 0;
			}
		}
			
		catch(Exception $exc) {
			//echo $exc;
			return 0;
		}
			
	}

	public function insert_data($name, $id, $pass) {
			
		$c = $this->check_id($id);
			
		if($c==0) {
			//echo "ID pre-exist";
			return 0;
		}
			
		try {
			$query = 'insert into user value (?,?,?)';
			$sql = $GLOBALS['con']->prepare($query);
			$sql->execute(array($name, $id, $pass));
			//echo "Data Inserted";
			return 1;
		}
			
		catch(Exception $exc) {
			//echo $exc;
			return 0;
		}
	}
		
	private function check_id($id) {
			
		try {
			$query = 'select * from user where id = ?';
			$sql = $GLOBALS['con']->prepare($query);
			$result = $sql->execute(array($id));
				
			if($row = $sql->fetch()) {
				return 0;
			}
			else {
				return 1;
			}
		}

		catch(Exception $exc) {
			//echo $exc;
			return 0;
		}
			
	}

	public function get_user_name($id) {
		try {
			$query = 'select name from user where id = ?';
			$sql = $GLOBALS['con']->prepare($query);
			$sql->execute(array($id));
			
			while($row = $sql->fetch()) {
   				return $row['name'];
			}
		}
			
		catch(Exception $exc) {
			//echo $exc;
			return "null";
		}
	}
		
	public function delete_data($id) {
			
		try {
			$query = 'delete from user where id = ?';
			$sql = $GLOBALS['con']->prepare($query);
			$sql->execute(array($id));
			//echo "Data Deleted";
			return 1;
		}
			
		catch(Exception $exc) {
			//echo $exc;
			return 0;
		}
	}
		
}

class municipalx {
		
	public function fetch_data() {
			
		try {
			$query = "select * from municipal";
			$sql = $GLOBALS['con']->prepare($query);
			$sql->execute();
				
			while($row = $sql->fetch()) {
				//echo $row["name"].",".$row["id"].",".$row["pass"];
			}
		}
			
		catch(Exception $exc) {
			//echo $exc->getMessage();
		}
			
	}
		
	public function verify_login ($id, $pass) {
			
		try {
			$query = "select * from municipal where id = ? and pass = ?";
			$sql = $GLOBALS['con']->prepare($query);
			$sql->execute(array($id, $pass));
				
			if($row = $sql->fetch()) {
				//echo "Municipal Verified</br>";
				return 1;
			}
			else {
				//echo "Municipal not Verified";
				return 0;
			}
		}
			
		catch(Exception $exc) {
			//echo $exc;
			return 0;
		}
			
	}
		
	public function check_id($id) {
			
		try {
			
			$query = "select * from municipal where id = ? ";
			$sql = $GLOBALS['con']->prepare($query);
			$result = $sql->execute(array($id));
				
			if($row = $sql->fetch()) {
				return 0;
			}
			else {
				return 1;
			}
		}
			
		catch(Exception $exc) {
			//echo $exc;
			return 0;
		}
			
	}
		
	public function insert_data($name, $id, $pass) {
			
		$c = $this->check_id($id);
			
		if($c==0) {
			//echo "ID pre-exist";
			return 0;
		}
			
		try {
			$query = "insert into municipal value (?,?,?)";
			$sql = $GLOBALS['con']->prepare($query);
			$sql->execute(array($name, $id, $pass));
			//echo "Data Inserted";
			return 1;
		}
			
		catch(Exception $exc) {
			//echo $exc;
			return 0;
		}
	}
		
	public function get_municipal_name($id) {
		try {
			$query = "select name from municipal where id = ?" ;
			$sql = $GLOBALS['con']->prepare($query);
			$sql->execute(array($id));
			
			while($row = $sql->fetch()) {
				//echo $row['name'];
   				return $row['name'];
			}
		}
			
		catch(Exception $exc) {
			//echo $exc;
			return "null";
		}
	}
		
	public function delete_data($id) {
			
		try {
			$query = "delete from municipal where id = ?" ;
			$sql = $GLOBALS['con']->prepare($query);
			$sql->execute(array($id));
			//echo "Data Deleted";
			return 1;
		}
			
		catch(Exception $exc) {
			//echo $exc;
			return 0;
		}
		
	}

}

class complaintx {

	public function fetch_complaint($complain_no) {
			
		try {
			$query = "select * from complaint where complain_no = ?";
			$sql = $GLOBALS['con']->prepare($query);
			$sql->execute(array($complain_no));
				
			$comp = new complaint();
			while($row = $sql->fetch()) {
				$comp->setComplain_no($row['complain_no']);
				$comp->setComplain($row['complain']);
				$comp->setActivity_report($row['activity_report']);
				$comp->setFeedback($row['feedback']);
			}
				
			return $comp;
		}
			
		catch(Exception $exc) {
			//echo $exc;
			return null;
		}
			
	}
		
	public function check_complain_no($complain_no) {
		try {
			$query = "select complain from complaint where complain_no = ?";
			$sql = $GLOBALS['con']->prepare($query);
			$sql->execute(array($complain_no));
			
			while($row = $sql->fetch()) {
				return 1;
			}	
			return 0;
		}
			
		catch(Exception $exc) {
			//echo $exc;
			return 0;
		}
	}
		
	public function fetch_all_complaints() {
			
		try {
			$query = "select complain_no from user_complaint";
			$sql = $GLOBALS['con']->prepare($query);
			$sql->execute();
			
			$comp_arr = array();;
			while($row = $sql->fetch()) {
				$comp_arr[] = $this->fetch_complaint($row['complain_no']);
			}
			
			return $comp_arr;
		}
			
		catch(Exception $exc) {
			//echo $exc;
			return "null";
		}
			
	}
		
	public function insert_complain($complain_no, $complain) {
			
		try {
			$query = "insert into complaint value (?,?,?,?)";
			$sql = $GLOBALS['con']->prepare($query);
			$sql->execute(array($complain_no, $complain, 'null', 'null'));
			//echo "Data Inserted";
			return 1;
		}
			
		catch(Exception $exc) {
			//echo $exc;
			return 0;
		}
	}
		
	public function insert_activity_report($complain_no, $activity_report) {
			
		try {
			$query = "update complaint set activity_report = ? where complain_no = ?";
			$sql = $GLOBALS['con']->prepare($query);
			$sql->execute(array($activity_report, $complain_no));
			//echo "Data Inserted";
			return 1;
		}
			
		catch(Exception $exc) {
			//echo $exc;
			return 0;
		}
	}
		
	public function insert_feedback($complain_no, $feedback) {
			
		try {
			$query = "update complaint set feedback = ? where complain_no = ?";
			$sql = $GLOBALS['con']->prepare($query);
			$sql->execute(array($feedback, $complain_no));
			//echo "Data Inserted";
			return 1;
		}
			
		catch(Exception $exc) {
			//echo $exc;
			return 0;
		}
	}
		
	public function delete_data($complain_no) {
			
		try {
			$query = "delete from complaint where complain_no = ?" ;
			$sql = $GLOBALS['con']->prepare($query);
			$sql->execute(array($complain_no));
			//echo "Data Deleted";
			return 1;
		}
			
		catch(Exception $exc) {
			//echo $exc;
			return 0;
		}
	}
}
	
class suggestionx {
		
	public function fetch_suggestion($suggestion_no) {
			
		try {
			$query = "select * from suggestion where suggestion_no = ?";
			$sql = $GLOBALS['con']->prepare($query);
			$sql->execute(array($suggestion_no));
			while($row = $sql->fetch()) {
   				return $row['suggestion'];
			}
		}
			
		catch(Exception $exc) {
			//echo $exc;
			return 'null';
		}
			
	}
		
	public function fetch_all_suggestion_no() {
			
		try {
			$query = "select suggestion_no from suggestion";
			$sql = $GLOBALS['con']->prepare($query);
			$sql->execute();
			
			$suggestion_arr = array();;
			while($row = $sql->fetch()) {
				$suggestion_arr[] = $row['suggestion_no'];
			}
				
			return $suggestion_arr;
		}
			
		catch(Exception $exc) {
			//echo $exc;
			return "null";
		}
			
	}
		
	public function insert_data($suggestion_no, $suggestion) {
			
		try {
			$query = "insert into suggestion value (?,?)";
			$sql = $GLOBALS['con']->prepare($query);
			$sql->execute(array($suggestion_no, $suggestion));
			//echo "Data Inserted";
			return 1;
		}
			
		catch(Exception $exc) {
			//echo $exc;
			return 0;
		}
	}
		
	public function delete_data($suggestion_no) {
			
		try {
			$query = "delete from suggestion where suggestion_no = ?" ;
			$sql = $GLOBALS['con']->prepare($query);
			$sql->execute(array($suggestion_no));
			//echo "Data Deleted";
			return 1;
		}
			
		catch(Exception $exc) {
			//echo $exc;
			return 0;
		}
	}
		
}

class user_complaintx {
		
	public function fetch_complain_no($user_id) {
			
		try {
			$query = "select * from user_complaint where user_id = ?";
			$sql = $GLOBALS['con']->prepare($query);
			$sql->execute(array($user_id));

			$comp_arr = array();
			while($row = $sql->fetch()) {
				$comp_arr[] = $row['complain_no'];
			}
				
			return $comp_arr;
		}
			
		catch(Exception $exc) {
			//echo $exc;
			return "null";
		}
			
	}
		
	public function fetch_user_id($complain_no) {
			
		try {
			$query = "select * from user_complaint where complain_no = ?";
			$sql = $GLOBALS['con']->prepare($query);
			$sql->execute(array($complain_no));

			while($row = $sql->fetch()) {
				return $row['user_id'];
			}
		}
			
		catch(Exception $exc) {
			//echo $exc;
			return "null";
		}
			
	}
		
	public function insert_data($user_id, $complain_no) {
			
		try {
			$query = "insert into user_complaint value (?,?)";
			$sql = $GLOBALS['con']->prepare($query);
			$sql->execute(array($user_id, $complain_no));
			//echo "Data Inserted";
			return 1;
		}
			
		catch(Exception $exc) {
			//echo $exc;
			return 0;
		}
	}
		
	public function delete_data_by_user_id($user_id) {
			
		try {
			$query = "delete from user_complaint where user_id = ?" ;
			$sql = $GLOBALS['con']->prepare($query);
			$sql->execute(array($user_id));
			//echo "Data Deleted";
			return 1;
		}
			
		catch(Exception $exc) {
			//echo $exc;
			return 0;
		}
	}
		
	public function delete_data_by_complain_no($complain_no) {
			
		try {
			$query = "delete from user_complaint where complain_no = ?" ;
			$sql = $GLOBALS['con']->prepare($query);
			$sql->execute(array($complain_no));
			//echo "Data Deleted";
			return 1;
		}
			
		catch(Exception $exc) {
			//echo $exc;
			return 0;
		}
	}

}

class municipal_complaintx {
		
	public function fetch_complain_no($municipal_id) {
			
		try {
			$query = "select * from municipal_complaint where municipal_id = ?";
			$sql = $GLOBALS['con']->prepare($query);
			$sql->execute(array($municipal_id));

			$comp_arr = array();;
			while($row = $sql->fetch()) {
				$comp_arr[] = $row['complain_no'];
			}
				
			return $comp_arr;
		}
			
		catch(Exception $exc) {
			//echo $exc;
			return "null";
		}
			
	}
		

	public function most_free_municipal() {
			
		try {
			$query = "select id from municipal";
			$sql = $GLOBALS['con']->prepare($query);
			$sql->execute();
			$return_id = 'null';
			$count = 10000;

			while($row = $sql->fetch()) {
				$municipal_id = $row['id'];
				
				$query1 = "select complain_no from  municipal_complaint where municipal_id = :municipal_id";
				$sql1 = $GLOBALS['con']->prepare($query1);
				$sql1->bindParam(':municipal_id', $municipal_id);
				$sql1->execute();
				//$sql1->execute(array($municipal_id));

				$c = 0;
				while($row1 = $sql1->fetch()) {
					$query2 = "select complain from  complaint where complain_no = :complain_no";
					$sql2 = $GLOBALS['con']->prepare($query2);
					$sql2->bindParam(':complain_no', $row1['complain_no']);
					$sql2->execute();

					if($row2 = $sql2->fetch()) {
						if($row['complain_no'] != 'Pending') {
							$c++;
						}
						//$c++;
					}
				}

				////echo $municipal_id." = ".$c."</br>";

				if($c < $count) {
					$count = $c;
					$return_id = $municipal_id;
				}

			}
				
			return $return_id;
		}
			
		catch(Exception $exc) {
			//echo $exc;
			return "null";
		}
	}
		
	public function fetch_municipal_id($complain_no) {
			
		try {
			$query = "select * from municipal_complaint where complain_no = ?";
			$sql = $GLOBALS['con']->prepare($query);
			$sql->execute(array($complain_no));

			while($row = $sql->fetch()) {
				return $row['municipal_id'];
			}
		}
			
		catch(Exception $exc) {
			//echo $exc;
			return "null";
		}
			
	}
		
	public function insert_data($municipal_id, $complain_no) {
			
		try {
			$query = "insert into municipal_complaint value (?,?)";
			$sql = $GLOBALS['con']->prepare($query);
			$sql->execute(array($municipal_id, $complain_no));
			//echo "Data Inserted";
			return 1;
		}
			
		catch(Exception $exc) {
			//echo $exc;
			return 0;
		}
	}
		
	public function delete_data_by_municipal_id($municipal_id) {
			
		try {
			$query = "delete from municipal_complaint where municipal_id = ?" ;
			$sql = $GLOBALS['con']->prepare($query);
			$sql->execute(array($municipal_id));
			//echo "Data Deleted";
			return 1;
		}
			
		catch(Exception $exc) {
			//echo $exc;
			return 0;
		}
	}
		
	public function delete_data_by_complain_no($complain_no) {
			
		try {
			$query = "delete from municipal_complaint where complain_no = ?" ;
			$sql = $GLOBALS['con']->prepare($query);
			$sql->execute(array($complain_no));
			//echo "Data Deleted";
			return 1;
		}
			
		catch(Exception $exc) {
			//echo $exc;
			return 0;
		}
	}

}

class user_suggestionx {
		
	public function fetch_suggestion_no($user_id) {
			
		try {
			$query = "select * from user_suggestion where user_id = ?";
			$sql = $GLOBALS['con']->prepare($query);
			$sql->execute(array($user_id));

			$suggestion_arr = array();
			while($row = $sql->fetch()) {
				$suggestion_arr[] = $row['suggestion_no'];
			}

			return $suggestion_arr;
		}
			
		catch(Exception $exc) {
			//echo $exc;
			return 0;
		}
			
	}
		
	public function fetch_user_id($suggestion_no) {
			
		try {
			$query = "select * from user_suggestion where suggestion_no = ?";
			$sql = $GLOBALS['con']->prepare($query);
			$sql->execute(array($suggestion_no));

			while($row = $sql->fetch()) {
				return $row['user_id'];
			}
		}
			
		catch(Exception $exc) {
			//echo $exc;
			return "null";
		}
			
	}
		
	public function insert_data($user_id, $suggestion_no) {
			
		try {
			$query = "insert into user_suggestion value (?,?)";
			$sql = $GLOBALS['con']->prepare($query);
			$sql->execute(array($user_id, $suggestion_no));
			//echo "Data Inserted";
			return 1;
		}
			
		catch(Exception $exc) {
			//echo $exc;
			return 0;
		}
	}
		
	public function delete_data($user_id) {
			
		try {
			$query = "delete from user_suggestion where user_id = ?" ;
			$sql = $GLOBALS['con']->prepare($query);
			$sql->execute(array($user_id));
			//echo "Data Deleted";
			return 1;
		}
			
		catch(Exception $exc) {
			//echo $exc;
			return 0;
		}
	}

}

class ngox {
		
	public function fetch_data() {
			
		try {
			$query = "select * from ngo";
			$sql = $GLOBALS['con']->prepare($query);
			$sql->execute();

			while($row = $sql->fetch()) {
   				//echo $row['name']." ".$row['mission']."</br>";
			}
		}
			
		catch(Exception $exc) {
			//echo $exc;
		}
			
	}
		
	public function fetch_all_ngo() {
			
		try {
			$query = "select name from ngo";
			$sql = $GLOBALS['con']->prepare($query);
			$sql->execute();

			$ngo_arr = array();;
			while($row = $sql->fetch()) {
				$ngo_arr[] = $row['name'];
			}
			
			return $ngo_arr;
		}
			
		catch(Exception $exc) {
			//echo $exc;
			return "null";
		}
			
	}
		

	public function fetch_ngo_mission($ngo_name) {
			
		try {
			$query = "select mission from ngo where name = ?";
			$sql = $GLOBALS['con']->prepare($query);
			$sql->execute(array($ngo_name));

			while($row = $sql->fetch()) {
				return $row['mission'];
			}
		}
			
		catch(Exception $exc) {
			//echo $exc;
			return "null";
		}
			
	}
		
	public function check_name($name) {
			
		try {
			$query = "select * from ngo where name = ? ";
			$sql = $GLOBALS['con']->prepare($query);
			$sql->execute(array($name));

			if($row = $sql->fetch()) {
				return 0;
			}

			return 1;
		}
			
		catch(Exception $exc) {
			//echo $exc;
			return 0;
		}
			
	}
		
	public function insert_data($name, $mission) {
		
		$c = $this->check_name($name);		
		if($c==0) {
			//echo "Name pre-exist";
			return 0;
		}
			
		try {
			$query = "insert into ngo value (?,?)";
			$sql = $GLOBALS['con']->prepare($query);
			$sql->execute(array($name, $mission));
			//echo "Data Inserted";
			return 1;
		}
		
		catch(Exception $exc) {
			//echo $exc;
			return 0;
		}
	}
		
	public function delete_data($name) {
			
		try {
			$query = "delete from ngo where name = ?" ;
			$sql = $GLOBALS['con']->prepare($query);
			$sql->execute(array($name));
			//echo "Data Deleted";
			return 1;	
		}
			
		catch(Exception $exc) {
			//echo $exc;
			return 0;
		}
	}
		
}

class ngo_userx {
		
	public function fetch_data() {
			
		try {
			$query = "select * from ngo_user";
			$sql = $GLOBALS['con']->prepare($query);
			$sql->execute();

			while($row = $sql->fetch()) {
				//echo $row['ngo_name']." ".$row['user_id']."</br>";
			}
		}
			
		catch(Exception $exc) {
			//echo $exc;
			return 0;
		}
			
	}
		
	public function fetch_user_list($ngo_name) {
			
		try {
			$query = "select user_id from ngo_user where ngo_name = ?";
			$sql = $GLOBALS['con']->prepare($query);
			$sql->execute(array($ngo_name));

			$user_arr = array();
			while($row = $sql->fetch()) {
				$user_arr[] = $row['user_id'];
			}

			return $user_arr;
		}
			
		catch(Exception $exc) {
			//echo $exc;
			return 0;
		}
			
	}
		
	public function fetch_ngo_list($user_id) {
			
		try {
			$query = "select ngo_name from ngo_user where user_id = ?";
			$sql = $GLOBALS['con']->prepare($query);
			$sql->execute(array($user_id));

			$ngo_arr = array();
			while($row = $sql->fetch()) {
				$ngo_arr[] = $row['ngo_name'];
			}

			return $ngo_arr;
		}
			
		catch(Exception $exc) {
			//echo $exc;
			return "null";
		}
			
	}
		
	public function insert_data($ngo_name, $user_id) {
			
		try {
			$query = "insert into ngo_user value (?,?)";
			$sql = $GLOBALS['con']->prepare($query);
			$sql->execute(array($ngo_name, $user_id));
			//echo "Data Inserted";
			return 1;
		}
			
		catch(Exception $exc) {
			//echo $exc;
			return 0;
		}
	}
		
	public function delete_data($ngo_name) {
			
		try {
			$query = "delete from ngo_user where ngo_name = ?" ;
			$sql = $GLOBALS['con']->prepare($query);
			$sql->execute(array($ngo_name));
			//echo "Data Deleted";
			return 1;
		}
			
		catch(Exception $exc) {
			//echo $exc;
			return 0;
		}
	}
		
}

class countx {
		
	public function complain_count() {
			
		try {
			$query = "select count(complain_no) from complaint ";
			$sql = $GLOBALS['con']->prepare($query);
			$sql->setFetchMode(PDO::FETCH_NUM);
			$sql->execute();
			
			while($row = $sql->fetch()) {
				return $row[0];
			}
		}
			
		catch(Exception $exc) {
			//echo $exc;
			return -1;
		}
			
	}
		
	public function suggestion_count() {
			
		try {
			$query = "select count(suggestion_no) from suggestion ";
			$sql = $GLOBALS['con']->prepare($query);
			$sql->setFetchMode(PDO::FETCH_NUM);
			$sql->execute();
			
			while($row = $sql->fetch()) {
				return $row[0];
			}
		}
			
		catch(Exception $exc) {
			//echo $exc;
			return -1;
		}
			
	}
		
	public function municipal_count() {
			
		try {
			$query = "select count(id) from municipal ";
			$sql = $GLOBALS['con']->prepare($query);
			$sql->setFetchMode(PDO::FETCH_NUM);
			$sql->execute();
			
			while($row = $sql->fetch()) {
				return $row[0];
			}
		}
			
		catch(Exception $exc) {
			//echo $exc;
			return -1;
		}
			
	}
			
}


?>