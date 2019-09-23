<?php
class UserModel extends Model{
	public function register(){
		// Sanitize POST
		$post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

		$password = md5($post['password']);
		$username = $post['username'];

		if($post['submit']){
			if($post['username'] == '' || $post['password'] == ''){
				Messages::setMsg('Please Fill In All Fields', 'error');
				return;
			}

			// Insert into MySQL
			$this->query('INSERT INTO users (username, password) VALUES(:username, :password)');
			$this->bind(':username', $username);
			$this->bind(':password', $password);
			$this->execute();
			// Verify
			if($this->lastInsertId()){
				// Redirect
				header('Location: '.ROOT_URL.'users/login');
			}
		}
		echo "Eu estou no Register!!";
		return;
	}

	public function change(){
		$this->query('SELECT * FROM users ORDER BY username ASC');
		$rows = $this->resultSet();
		return $rows;
	}

	public function login(){
		// Sanitize POST
		$post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

		$password = md5($post['password']);
		$username = $post['username'];

		if($post['submit']){
			// Compare Login
			$this->query('SELECT * FROM users WHERE username = :username AND password = :password');
			$this->bind(':username', $username);
			$this->bind(':password', $password);
			$row = $this->single();

			if($row){

				$_SESSION['is_logged_in'] = true;
				$_SESSION['user_data'] = array(
					"userid"	=> $row['id'],
					"username"	=> $row['username'],
					"idtype"	=> $row['idtype'],
					"date"	=> date('Y-m-d')
				);

				header('Location: '.ROOT_URL.'reports/');
			} else {
				Messages::setMsg('Incorrect Login', 'error');
			}
		}
		return;
	}
}