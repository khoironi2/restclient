<?php
   /**
    * 
    */
   class Auth extends CI_Controller {
   	
   	function __construct()	{
   		parent::__construct();
   	}

   	public function index(){

   		$this->template->load('template_auth/Header','template_auth/data/Auth');
   	}

   

	 public function Login()
    {
        $data['title'] = 'Login';

        $data['user'] = $this->db->get_where('tbl_user', ['email' => $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');

        if ($this->form_validation->run() == false) {
           
        } else {
            
            $email = $this->input->post('email', true);
            $password = $this->input->post('password', true);

            $user = $this->db->get_where('tbl_user', ['email' => $email])->row_array();

            if ($user) {
                if( $user['status'] == 1 ) {
                    if( password_verify($password, $user['password']) ) {

                        $data = [
                            'email' => $user['email'],
                            'status' => $user['status'],
                            'level' => $user['level'],
                             'logged_in' => TRUE
                        ];

                        $this->session->set_userdata($data);
                        if( $user['level'] == 2 ) {
                        	date_default_timezone_set("ASIA/JAKARTA");
                            $email = $this->session->userdata('email');
                            $data = array('olof' => '1',
                                'last_login' => date('Y-m-d H:i:s'));
                                                     
                            $this->Model_user->logout($data, $email);
                            
                            redirect('beranda/Beranda');
                        } elseif( $user['level'] == 1 ) {
                        	date_default_timezone_set("ASIA/JAKARTA");
                            $email = $this->session->userdata('email');
                            $data = array('olof' => '1',
                                'last_login' => date('Y-m-d H:i:s'));
                                                     
                            $this->Model_user->logout($data, $email);
                            
                            redirect('beranda/Beranda');
                        }                     
                        
                    } else {
                        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Password Salah!</div>');
                        redirect();
                    }
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Email Belum Diaktifasi!</div>');
                    redirect();
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Email Berlum Terrigestrasi!</div>');
                redirect();
            }
        }
    }

    

	public function Reg() {
		$this->form_validation->set_rules('email', 'email', 'required', 
									array('required' 	=> 'Tulis Pesan dahulu !'));

		if($this->form_validation->run() === FALSE) {
			$this->index();
		} else {
			$data = array('nama_lengkap'	=> $this->input->post('nama_lengkap'),
						  'email'	=> $this->input->post('email'),
						  'termcondition'	=> $this->input->post('term'),
						  'level'	=> 2,
						  'status'	=> '1',
						  'password' => password_hash( $this->input->post('pass', true), PASSWORD_DEFAULT)
						);

			$this->Model_user->insertUser($data);

			$this->session->set_flashdata('sukses', 'sukses');

			redirect(site_url());


		}
	}

	public function logout()    {
         date_default_timezone_set("ASIA/JAKARTA");
        $email = $this->session->userdata('email');
        $data = array('olof' => '0','last_logof' => date('Y-m-d H:i:s'));
      
        $this->Model_user->logout($data, $email);
        $this->session->unset_userdata('email');
         $this->session->unset_userdata('level');
        redirect();
    }







   }
?>