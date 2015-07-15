<?php
class Usuarios_model extends Model {

	function __construct()
	{
		parent::Model();
	}

	
  
	
	function get_email_admin()
  {
    $qry = $this->db->select('usu_email')
										->from('wb_users')
										->where('usu_rol_id',2)
										->where('usu_username','admin')
                    ->get();
		$res = '';
		if($qry->num_rows() > 0)
		{
      // $row = $qry->row();
      return $qry->row()->usu_email;
		}

		return $res;
	}


}

/* End of file categoria_model.php */
/* Location: ./system/application/model/categoria_model.php */