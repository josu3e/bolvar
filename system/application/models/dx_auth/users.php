<?php

class Users extends Model 
{
	function Users()
	{
		parent::Model();

		// Other stuff
		$this->_prefix = $this->config->item('DX_table_prefix');
		$this->_table = $this->_prefix.$this->config->item('DX_users_table');	
		$this->_roles_table = $this->_prefix.$this->config->item('DX_roles_table');
	}
	
	// General function
	
	function get_all($offset = 0, $row_count = 0)
	{
		$users_table = $this->_table;
		$roles_table = $this->_roles_table;
		
		if ($offset >= 0 AND $row_count > 0)
		{
			$this->db->select("$users_table.*", FALSE);
			$this->db->select("$roles_table.rol_name AS role_name", FALSE);
			$this->db->join($roles_table, "$roles_table.rol_id = $users_table.usu_rol_id");
			$this->db->order_by("$users_table.usu_id", "ASC");
			
			$query = $this->db->get($this->_table, $row_count, $offset); 
		}
		else
		{
			$query = $this->db->get($this->_table);
		}
		
		return $query;
	}

	function get_user_by_id($user_id)
	{
		$this->db->where('usu_id', $user_id);
		return $this->db->get($this->_table);
	}

	function get_user_by_username($username)
	{
		$this->db->where('usu_username', $username);
		return $this->db->get($this->_table);
	}
	
	function get_user_by_email($email)
	{
		$this->db->where('usu_email', $email);
		return $this->db->get($this->_table);
	}
	
	function get_login($login)
	{
		$this->db->where('usu_username', $login);
		$this->db->or_where('usu_email', $login);
		return $this->db->get($this->_table);
	}
	
	function check_ban($user_id)
	{
		$this->db->select('1', FALSE);
		$this->db->where('usu_id', $user_id);
		$this->db->where('usu_banned', '1');
		return $this->db->get($this->_table);
	}
	
	function check_username($username)
	{
		$this->db->select('1', FALSE);
		$this->db->where('LOWER(usu_username)=', strtolower($username));
		return $this->db->get($this->_table);
	}

	function check_email($email)
	{
		$this->db->select('1', FALSE);
		$this->db->where('LOWER(usu_email)=', strtolower($email));
		return $this->db->get($this->_table);
	}
		
	function ban_user($user_id, $reason = NULL)
	{
		$data = array(
			'usu_banned' 			=> 1,
			'usu_ban_reason' 	=> $reason
		);
		return $this->set_user($user_id, $data);
	}
	
	function unban_user($user_id)
	{
		$data = array(
			'usu_banned' 			=> 0,
			'usu_ban_reason' 	=> NULL
		);
		return $this->set_user($user_id, $data);
	}
		
	function set_role($user_id, $role_id)
	{
		$data = array(
			'usu_rol_id' => $role_id
		);
		return $this->set_user($user_id, $data);
	}

	// User table function
	
	function create_user($data)
	{
		$data['usu_created'] = date('Y-m-d H:i:s', time());
		return $this->db->insert($this->_table, $data);
	}

	function get_user_field($user_id, $fields)
	{
		$this->db->select($fields);
		$this->db->where('usu_id', $user_id);
		return $this->db->get($this->_table);
	}

	function set_user($user_id, $data)
	{
		$this->db->where('usu_id', $user_id);
		return $this->db->update($this->_table, $data);
	}
	
	function delete_user($user_id)
	{
		$this->db->where('usu_id', $user_id);
		$this->db->delete($this->_table);
		return $this->db->affected_rows() > 0;
	}
	
	// Forgot password function

	function newpass($user_id, $pass, $key)
	{
		$data = array(
			'usu_newpass' 			=> $pass,
			'usu_newpass_key' 	=> $key,
			'usu_newpass_time' 	=> date('Y-m-d h:i:s', time() + $this->config->item('DX_forgot_password_expire'))
		);
		return $this->set_user($user_id, $data);
	}

	function activate_newpass($user_id, $key)
	{
		$this->db->set('usu_password', 'usu_newpass', FALSE);
		$this->db->set('usu_newpass', NULL);
		$this->db->set('usu_newpass_key', NULL);
		$this->db->set('usu_newpass_time', NULL);
		$this->db->where('usu_id', $user_id);
		$this->db->where('usu_newpass_key', $key);
		
		return $this->db->update($this->_table);
	}

	function clear_newpass($user_id)
	{
		$data = array(
			'usu_newpass' 			=> NULL,
			'usu_newpass_key' 	=> NULL,
			'usu_newpass_time' 	=> NULL
		);
		return $this->set_user($user_id, $data);
	}
	
	// Change password function

	function change_password($user_id, $new_pass)
	{
		$this->db->set('usu_password', $new_pass);
		$this->db->where('usu_id', $user_id);
		return $this->db->update($this->_table);
	}
}

?>