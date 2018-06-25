<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
	function __construct() {
        parent::__construct();
        $this->load->model('mymodel');
		$this->load->library('form_validation');
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->library('session');
    }
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->view('welcome_message');
	}
	public function myindex()
	{
		echo'my index';
	}
	public function fetch(){
		//if($this->userdata('uname')!=''){
		//$this->load->model('mymodel');
		$data['userArray']=$this->mymodel->returnusers();
		$this->load->view('adminview',$data);
	/*}
	else{
		redirect(base_url(). "welcome/login");
	}*/
	}
	public function fetchuser($uname){
		//if(isset($_SESSION['uname'])){
		//$this->load->model('mymodel');
		$data['userArray']=$this->mymodel->returnoneuser($uname);
		$this->load->view('userpage',$data);
	//}
	}
	public function register(){
		$data=array('uname'=>$this->input->post('uname'),'uemail'=>$this->input->post('uemail'),'upass'=>$this->input->post('upass'));
		$this->db->insert('users',$data);
		redirect("index.php/welcome/index");
		
	}
	public function changeflag(){
		$uid= $this->uri->segment(3);
		
			$data=1;
		$this->db->set('flag', $data); 
$this->db->where('uid', $uid); 
$this->db->update('users'); 	
		//$this->mymodel->updateflag($uid);
	// 	$this->load->view('adminview');
	}
	public function form_validation1(){
		if($this->input->post()){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('uname','Username','trim|required|min_length[4]|max_length[15]');
		$this->form_validation->set_rules('uemail','uemail','required|valid_email|min_length[5]|max_length[30]');
		$this->form_validation->set_rules('upass','Password','trim|required|min_length[4]');
		$this->form_validation->set_rules('uadd','uadd','required|min_length[5]|max_length[30]');
		$this->form_validation->set_rules('uphone','uphone','required|min_length[5]|max_length[10]');


		if($this->form_validation->run()){
			//true
			$upass=$this->input->post('upass');
			$hashpass=password_hash($upass, PASSWORD_BCRYPT);
		
		
		$data1=array('uname'=>$this->input->post('uname'),'uemail'=>$this->input->post('uemail'),'upass'=>$hashpass);
		$this->db->insert('users',$data1);
		$latest_id=$this->db->insert_id();
		echo $latest_id; 
		/////////****************************************************************///////////////////////////////
		$data2=array('uadd'=>$this->input->post('uadd'),'uphone'=>$this->input->post('uphone'),'uidfk'=>$latest_id);
		$this->db->insert('userdetails',$data2);
		
		
		redirect(base_url(). "welcome/login");
		}
		else{
			$this->index();
		}
	}
	}
	public function login(){
		$this->load->view('loginpage');
		
	}
	public function logout(){
		$this->session->unset_userdata(array("uname"=>"","upass"=>""));
$this->session->sess_destroy();
echo'you have been logged out';
		
	}
	public function form_validation2(){
		if($this->input->post()){
		$this->form_validation->set_rules('uname','Username','trim|required|alpha|min_length[3]|max_length[15]');
		//$this->form_validation->set_rules('uemail','uemail','required|valid_email|min_length[5]|max_length[30]');
		$this->form_validation->set_rules('upass','Password','trim|required|min_length[4]');
		
		
		
		
		if($this->form_validation->run()==true){
			//true
				$uname=$this->input->post('uname');
				$upass=$this->input->post('upass');
				/*echo '123';
				echo $uname;
				echo $upass;*/
				/*$data['userArray']=$this->mymodel->checkusers($uname,$upass);
		$this->load->view('adminview',$data);*/
				
				$pass=$this->mymodel->checkusers($uname);
				$isPasswordCorrect = password_verify($upass, $pass);
				//echo $pass;
				/*if($flag==0){
					redirect(base_url()."welcome/fetch");
				}
				else if($flag==1){
					redirect(base_url()."welcome/userpage");
				}
				else if($flag==2){
					redirect(base_url()."welcome/fetch");
				}*/
				if($isPasswordCorrect==true){
					
					$uflag=$this->mymodel->checkflag($uname);
					
					//$this->session->set_userdata('$uname');
					
					if($uflag==2){
								$data= array(
						   'uname'  => $uname,
						   'upass'     => $upass,
						   
					   );
					   $this->session->set_userdata($data);
					redirect(base_url(). "welcome/fetch");
				}
				else if($uflag==1){
						$data= array(
						   'uname'  =>$uname,
						   'upass'     => $upass,
						   
					   );
					   $this->session->set_userdata($data);
					redirect(base_url(). "welcome/fetchuser/$uname");
				}
				else if($uflag==0){
					redirect(base_url(). "welcome/notregistered");
				}
				}
				else{
			//$this->session->set_flashdata('error','invalid password and username');
$this->index;
			redirect(base_url(). "welcome/login");
		}
		}
		else{
			$this->index();
		}
	}
	}
	public function notregistered(){
		echo'you are not yet approoved';
		
	}
	/*public function logout(){
		$this->session->unset_userdata('uname');
		redirect(base_url(). "welcome/login");
	}*/
	
}	
	