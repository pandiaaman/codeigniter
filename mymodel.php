<?php
class Mymodel extends CI_Model{
	public function returnusers(){
		if(isset($_SESSION['uname'])){
		///////////////*************************************************//////////////////////
		$this->load->database();
		$this->db->select('*');
			$this->db->from('users');
			$this->db->join('userdetails', 'users.uid = userdetails.uidfk');

			$query = $this->db->get();
					
	///////////////////////////***********************************//////////////////////////////	
		
		//$query=$this->db->get('users');
		return $query;
		//->result_array();
	}
	}
	

	public function returnoneuser($uname){
			if(isset($_SESSION['uname'])){
		$this->load->database();
		$this->db->select('*')->from('users')->where('uname',$uname);

     $query = $this->db->get();

     if ($query->num_rows() > 0) {
         
		 return $query;//->result_array();
     }
			}
     return false;

	}
	public function checkusers($uname){
		$this->load->database();
		/*$passcheck=$this->db->query("SELECT upass FROM users WHERE uname='$uname'");	
		return $passcheck;*/
		
		
		$this->db->select('upass')->from('users')->where('uname',$uname);

     $query = $this->db->get();

     if ($query->num_rows() > 0) {
         return $query->row()->upass;
     }
     return false;
		
		/*if($passcheck==$upass){
			/*$a=$this->db->query("SELECT * FROM users WHERE uname='$uname'");
			return $flag;*/
			
			/*$query=$this->db->query("SELECT * FROM users WHERE uname='$uname'");
		return $query->result_array();
		
			//$a=$this->db->query("SELECT * FROM users WHERE uname='$uname'");
			//return $a->result_array();
		
		/*}
		else{
			
		}*/
		
	}
	public function checkflag($uname){
		/*$this->load->database();
		$flagcheck=$this->db->query("SELECT flag FROM users WHERE uname='$uname'");
		return $flagcheck;
		*/
	 $this->db->select('flag')->from('users')->where('uname',$uname);

     $query = $this->db->get();

     if ($query->num_rows() > 0) {
         return $query->row()->flag;
     }
     return false;
	}
	public function updateflag($uid){
		$data=1;
		$this->db->set('flag', $data); 
$this->db->where('uid', $uid); 
$this->db->update('users'); 
	//$this->load->view('adminview');
/*
		$this->db->update('users');
		$this->db->set('flag',$data);
		$this->db->where('uid',$uid);*/
	}
}
?>