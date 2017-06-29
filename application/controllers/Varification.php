<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Varification extends CI_Controller {
        public function __construct(){
            parent::__construct();
            $this->load->model("login"); 
//            $this->load->database();
            $this->load->library('form_validation');
            $this->load->library("session");           
        }
	public function index()
	{
		$this->load->view('site/login');
	}
	
}
