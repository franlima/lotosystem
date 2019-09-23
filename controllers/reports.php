<?php
class Reports extends Controller{
	protected function index(){
		$viewmodel = new ReportModel();
		$this->returnView($viewmodel->index(), true);
	}
	protected function day(){
		$viewmodel = new ReportModel();
		$this->returnView($viewmodel->day($this->request['id']), true);
	}
	protected function new(){
		$viewmodel = new ReportModel();
		$this->returnView($viewmodel->new(), true);
	}
}