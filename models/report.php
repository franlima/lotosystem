<?php
class ReportModel extends Model{
	public function index(){
		$username = $_SESSION['user_data']['username'];

		$this->query('CALL sp_reports_index(:username);');
		$this->bind(':username', $username);
		$rows = $this->resultSet();
		return $rows;
	}

	public function new(){

		$today = date('Y-m-d');
		echo("1");
		
		if (isset($_SESSION['user_data']['username'])){
			
			$username = $_SESSION['user_data']['username'];
			$userid = $_SESSION['user_data']['userid'];
			
			$this->query("CALL sp_reports_new(:userid, :today);");
			$this->bind(':userid', $userid);
			$this->bind(':today', $today);
			$idrep = $this->resultSet();
			
			if (isset($idrep[0]["id"])) {
				$_SESSION['user_data']['reportid'] = $idrep[0]["id"];
				header('Location: '.ROOT_URL.'reports/day/' .$idrep[0]["id"]);
			} else {

				$userid = $_SESSION['user_data']['userid'];

				//insert new report
				$this->query("CALL sp_reports_new_report(:userid, :today, @p3);");
				$this->bind(':userid', $userid);
				$this->bind(':today', $today);
				$this->execute();
				$this->query("SELECT @p3 as id;");
				$reportid = $this->single();

				// Verify
				if($reportid["id"]){
					// Redirect
					$_SESSION['user_data']['reportid'] = $reportid["id"];
					header('Location: '.ROOT_URL.'reports/day/' .$reportid["id"]);
				}
			}
		} else {
			Messages::setMsg('You need to sign in', 'Login');
			return;
		}
	}

	public function day($id){
		// Sanitize POST

		$reportid = $id;

		//querying all itens
		$this->query("CALL sp_reports_day_operations(:reportid)");
		$this->bind(':reportid', $reportid);
		$rows["operations"] = $this->resultSet();

		$this->query("CALL sp_reports_update_totalcaixa(:reportid)");
		$this->bind(':reportid', $reportid);
		$this->execute();

		// querying totals
		$this->query("CALL sp_reports_day_totals(:reportid)");
		$this->bind(':reportid', $reportid);
		$temp = $this->resultSet();

		$_SESSION['user_data']['date'] = $temp[0]["created"];

		$rows["totals"] = [
			"Total Caixa" => $temp[0]["totalcaixa"],
			"Total Relatório" => $temp[0]["totalreport"],
			"Quebra de Caixa" => $temp[0]["quebradecaixa"]
		];

		return $rows;
	}
}