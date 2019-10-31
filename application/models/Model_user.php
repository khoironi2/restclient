<?php 

class Model_user extends CI_Model {

	public function insertUser($data) {
		$this->db->insert('tbl_user', $data);

		if($this->db->affected_rows() > 0) 
			return true;
		else
			return false;
	}

	public function getData() {
		$this->db->select('*');
		$this->db->from('tbl_user');
		
		$result = $this->db->get();

		return $result->result();
	}

	function getDataById($id) {
		$this->db->select('*');
		$this->db->from('tbl_user');
		$this->db->where('id', $id);

		$result = $this->db->get();

		return $result->row();
	}

	function getLogin($email, $password) {
		$this->db->select('*');
		$this->db->from('tbl_user');
		$this->db->where(array('email' => $email, 'password' => $password));

		$result = $this->db->get();

		return $result->row();
	}

	 public function logout($data, $email)  {
        $this->db->where('email', $email);
        $this->db->update('tbl_user', $data);
    }
    
    function updateData($id, $data) {
		$this->db->where('id', $id);
		$this->db->update('tbl_user', $data);
	}

	

	public function deleteData($id) {
		$this->db->where('id', $id);
		$this->db->delete('tbl_user');

		if($this->db->affected_rows() > 0)
			return true;
		else
			return false;
	}


	

	


}