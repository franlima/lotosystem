<?php
class ReportModel extends Model{
	public function index(){
		$this->query('SELECT * FROM users ORDER BY username ASC');
		$rows = $this->resultSet();
		return $rows;
	}
	public function day(){
		// Sanitize POST
		$post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

		if($post['submit']){

			$selectedUsername = isset($post['selectusername']) ? $post['selectusername'] : '';
			$selectedDate = isset($post['date']) ? $post['date'] : '';

			list($userid, $usertype, $username) = explode(",", $selectedUsername);

			if($selectedUsername == '' || $selectedDate == '' ){
				Messages::setMsg('Please Fill In All Fields', 'error');
				return;
			}
			$this->query("SELECT reports.id, reports.idop, operations.name, reports.value, reports.created, reports.status
						  FROM reports
						  JOIN operations ON reports.idop = operations.id
						  JOIN users ON reports.iduser = users.id
						  WHERE username = :username");
			$this->bind(':username', $username);
			$rows = $this->resultSet();

			$_SESSION['current_user'] = array(
				"userid" => $userid,
				"idtype" => $usertype,
				"username"	=> $username,
				"date"	=> $selectedDate
			);

			return $rows;
		}
		if ($_SESSION['current_user']['username'] != '' || $_SESSION['current_user']['date'] != '' ) {
			$this->query("SELECT reports.id, reports.idop, operations.name, reports.value, reports.created, reports.status
						  FROM reports
						  JOIN operations ON reports.idop = operations.id
						  JOIN users ON reports.iduser = users.id
						  WHERE username = :username");
			$this->bind(':username', $_SESSION['current_user']['username']);
			$rows = $this->resultSet();
			return $rows;
		} else  {
			header('Location: '.ROOT_URL.'reports');
		}
	}	
}