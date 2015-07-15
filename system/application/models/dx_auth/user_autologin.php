<?php

class User_Autologin extends Model
{
	function User_Autologin()
	{
		parent::Model();

		// Other stuff
		$this->_prefix = $this->config->item('DX_table_prefix');
		$this->_table = $this->_prefix.$this->config->item('DX_user_autologin');
		$this->_users_table = $this->_prefix.$this->config->item('DX_users_table');
	}

	function store_key($key, $user_id)
	{
		$user = array(
			'ua_key_id' 			=> md5($key),
			'ua_usu_id' 		=> $user_id,
			'ua_user_agent' 	=> substr($this->input->user_agent(), 0, 149),
			'ua_last_ip' 		=> $this->input->ip_address()
		);

		return $this->db->insert($this->_table, $user);
	}

	function get_key($key, $user_id)
	{
		$auto_table = $this->_table;
		$users_table = $this->_users_table;

		$this->db->select("$users_table.usu_id");
		$this->db->select("$users_table.usu_username");
		$this->db->select("$users_table.usu_nombre");
		$this->db->select("$users_table.usu_email");
		$this->db->select("$users_table.usu_rol_id");
		$this->db->from($users_table);
		$this->db->join($auto_table, "$auto_table.ua_usu_id = $users_table.usu_id");
		$this->db->where("$users_table.usu_id", $user_id);
		$this->db->where("$auto_table.ua_key_id", md5($key));

		return $this->db->get();
	}

	function delete_key($key, $user_id)
	{
		$data = array(
			'ua_key_id' 	=> md5($key),
			'ua_usu_id' => $user_id
		);

		$this->db->where($data);
		return $this->db->delete($this->_table);
	}

	function clear_keys($user_id)
	{
		$this->db->where('ua_usu_id', $user_id);
		return $this->db->delete($this->_table);
	}

	function prune_keys($user_id)
	{
		$data = array(
			'ua_usu_id'			=> $user_id,
			'ua_user_agent' 	=> substr($this->input->user_agent(), 0, 149),
			'ua_last_ip' 		=> $this->input->ip_address()
		);

		$this->db->where($data);
		return $this->db->delete($this->_table);
	}
}

?>