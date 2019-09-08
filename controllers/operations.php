<?php
class Operations extends Controller{
	protected function index(){
		$viewmodel = new OperationModel();
		$this->returnView($viewmodel->index(), true);
    }
    
	protected function add(){
		$viewmodel = new OperationModel();
		$this->returnView($viewmodel->add(), true);
	}

	protected function total(){
		$viewmodel = new OperationModel();
		$this->returnView($viewmodel->total(), true);
	}

	protected function delete(){
		$viewmodel = new OperationModel();
		$this->returnView($viewmodel->delete($this->request['id']), true);
		//var_dump($this->request['id']);
	}
}