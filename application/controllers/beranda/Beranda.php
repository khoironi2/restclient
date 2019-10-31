<?php
	/**
	 * 
	 */
	class Beranda extends CI_Controller	{
		
		public function __construct() {
		parent::__construct();
		
		
		 if($this->session->userdata('logged_in') !== TRUE){
     	 redirect();
    	}    
	}

	
   	public function index(){
   		if($this->session->userdata('level')==='1'){
          $this->load->view('beranda/Beranda');
      }else{
          redirect('auth/logout');
      }
  	}




	}
?>