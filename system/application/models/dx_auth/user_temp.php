<?php

class User_Temp extends Model 
{
	function User_Temp()
	{
		parent::Model();

		// Other stuff
		$this->_prefix = $this->config->item('DX_table_prefix');
		$this->_table = $this->_prefix.$this->config->item('DX_user_temp_table');
	}
	
	function get_all($offset = 0, $row_count = 0)
	{
		if ($offset >= 0 AND $row_count > 0)
		{
			$query = $this->db->get($this->_table, $row_count, $offset); 
		}
		else
		{
			$query = $this->db->get($this->_table);
		}
		
		return $query;
	}		
	
	function get_user_by_username($username)
	{
		$this->db->where('ut_username', $username);
		return $this->db->get($this->_table);
	}
	
	function get_user_by_email($email)
	{
		$this->db->where('ut_email', $email);
		return $this->db->get($this->_table);
	}

	function get_login($login)
	{
		$this->db->where('ut_username', $login);
		$this->db->or_where('ut_email', $login);
		return $this->db->get($this->_table);
	}

	function check_username($username)
	{
		$this->db->select('1', FALSE);
		$this->db->where('ut_username', $username);
		return $this->db->get($this->_table);
	}

	function check_email($email)
	{
		$this->db->select('1', FALSE);
		$this->db->where('ut_email', $email);
		return $this->db->get($this->_table);
	}

	function activate_user($username, $key)
	{
		$this->db->where(array('ut_username' => $username, 'ut_activation_key' => $key));
		return $this->db->get($this->_table);
	}

	function delete_user($id)
	{
		$this->db->where('ut_id', $id);
		return $this->db->delete($this->_table);
	}

	function prune_temp()
	{
		$this->db->where('UNIX_TIMESTAMP(ut_created) <', time() - $this->config->item('DX_email_activation_expire'));
		return $this->db->delete($this->_table);
	}

	function create_temp($data)
	{
		$data['ut_created'] = date('Y-m-d H:i:s', time());
		return $this->db->insert($this->_table, $data);
	}
}

?>