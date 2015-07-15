<?php
class Perfil_model extends Model {

	function __construct()
	{
		parent::Model();
	}
	function update_perfil($perfil)
	{
	 $this->db->update('wb_users',$perfil, "usu_rol_id = 2");
	}
	
		  function get_perfil_admin()
  {
    $qry = $this->db->select('usu_email')
								->from('wb_users')
								->where('usu_username','admin')
                ->get();
								
		$result = $qry->result();
		return $result;
  }
	
  
}

/* End of file categoria_model.php */
/* Location: ./system/application/model/categoria_model.php */