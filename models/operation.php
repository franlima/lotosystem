<?php
class OperationModel extends Model{
	public function index(){
		return;
    }

	public function add(){
		// Sanitize POST
		$post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

		if($post['submit']){

			if($post['operationid'] == '' || $post['value'] == ''){
				Messages::setMsg('Please Fill In All Fields', 'error');
				return;
			}

			$reportid = $_SESSION['user_data']['reportid'];
			$operationid = $post['operationid'];
			$value = $post['value'];
			$date = $_SESSION['user_data']['date'];

			// Insert into MySQL
			$this->query('INSERT INTO operations (idrep, idop, value, due)
						VALUES (:idrep, :idop, :value, :due)');
			$this->bind(':idrep', $reportid);
			$this->bind(':idop', $operationid);
			$this->bind(':value', $value);
			$this->bind(':due', $date);
			$this->execute();
			// Verify
			if($this->lastInsertId()){
				// Redirect
				header('Location: '.ROOT_URL.'reports/day/' .$reportid);
			}
		}
		else {
			$this->query('SELECT * FROM operationstypes
			WHERE operationstypes.category = "money"
			ORDER BY operationstypes.id ASC');
			$rows = $this->resultSet();
			return $rows;
		}
	}

	public function total(){
		// Sanitize POST
		$post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

		if($post['submit']){

			if($post['operationid'] == '' || $post['value'] == ''){
				Messages::setMsg('Please Fill In All Fields', 'error');
				return;
			}
			// variable to control Totals exists 
			$opExist = false;

			//in case operationid = 8 'Total'
			if ($post['operationid'] == '8'){


				$this->query('SELECT reports.idop, operations.name, SUM(reports.value) AS soma
											FROM reports
											JOIN operations ON reports.idop = operations.id
											JOIN users ON reports.iduser = users.id
											WHERE reports.idop <= 6
											AND reports.iduser = :iduser
											GROUP BY reports.idop ASC');
				$this->bind(':iduser', $_SESSION['current_user']['userid']);
				$rows = $this->resultSet();

				$total = 0.0;
				foreach ($rows as $item) {
					//check if operations are either 'Comissao bolao' or 'other'
					if ($item['idop'] == '3' || $item['idop'] == '6')
						$total -= floatval($item['soma']);
					else
						$total += floatval($item['soma']);	 
				}

				$post['value'] = strval($total);

				$this->query('SELECT reports.id from reports
											JOIN operations ON operations.id = reports.idop
											WHERE operations.idop = 8
											AND reports.iduser = :iduser');
				$this->bind(':iduser', $_SESSION['current_user']['userid']);
				$rows = $this->single();

				if(isset($rows['id'])) {
					// Insert into MySQL
					$this->query('UPDATE reports SET reports.value = :value WHERE report.id = :id');
					$this->bind(':id', $rows['id']);
					$this->bind(':value', $post['value']);
					$this->execute();

					// Verify
					if($this->lastInsertId()){
						// Redirect
						$opExist = true;
					}
				}
			}

			//in case operationid = 9 'Quebra de Caixa'
			if ($post['operationid'] == '9'){

				$this->query('SELECT reports.idop, SUM(reports.value) AS soma
											FROM reports
											WHERE reports.idop = :idop
											AND reports.iduser = :iduser');
				$this->bind(':idop', 7);
				$this->bind(':iduser', $_SESSION['current_user']['userid']);
				$relatorio = $this->single();
				$this->bind(':idop', 8);
				$this->bind(':iduser', $_SESSION['current_user']['userid']);
				$totalday = $this->single();

				$total = isset($totalday['soma']) ? floatval($totalday['soma']) : 0.0;
				$total -= (isset($relatorio['soma']) ? floatval($relatorio['soma']) : 0.0);
				$post['value'] = strval($total);

				//check whether exist a field = 9 'Quebra de Caixa'
				$this->query('SELECT reports.id from reports
											WHERE reports.idop = 9
											AND reports.iduser = :iduser');
				$this->bind(':iduser', $_SESSION['current_user']['userid']);
				$rows = $this->single();

				if(isset($rows['id'])) {
					// Update the field
					$this->query('UPDATE reports SET reports.value = :value WHERE report.id = :id');
					$this->bind(':id', $rows['id']);
					$this->bind(':value', $post['value']);
					$this->execute();

					// Verify
					if($this->lastInsertId()){
						// field updated, dont need to INSERT
						$opExist = true;
					}
				}
			}

			if (!$opExist){

				// Insert into MySQL
				$this->query('INSERT INTO reports (idop, iduser, value, due) VALUES(:idop, :iduser, :value, :due)');
				$this->bind(':idop', $post['operationid']);
				$this->bind(':iduser', $_SESSION['current_user']['userid']);
				$this->bind(':value', $post['value']);
				$this->bind(':due', $_SESSION['current_user']['date']);
				$this->execute();
				// Verify
				if($this->lastInsertId()){
					// Redirect
					header('Location: '.ROOT_URL.'reports/day');
				}
			}
		}
		else {
			$this->query('SELECT * FROM operations
			WHERE operations.category = "totals"
			ORDER BY operations.id ASC');
			$rows = $this->resultSet();
			return $rows;
		}
	}

	public function delete($id){
		// Sanitize POST
		$post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

		if($id == ''){
				Messages::setMsg('Operations id was not recognized!', 'error');
				return;
		}
		if($post['delete']){
			if($post['id'] == ''){
				Messages::setMsg('Operations id was not recognized!', 'error');
				return;
			}
			// Insert into MySQL
			$this->query('DELETE FROM operations WHERE id = :id');
			$this->bind(':name', $post['id']);
			$this->execute();
			// Verify
			if($this->lastInsertId()){
				// Redirect
				header('Location: '.ROOT_URL.'operations');
			}
		} else {
			$this->query('SELECT * FROM operations WHERE id = :id');
			$this->bind(':id', $id);
			$rows = $this->single();
			return $rows;			
		}
		return;
	}
}