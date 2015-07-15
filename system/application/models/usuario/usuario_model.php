<?php
class Usuario_model extends Model {

	function __construct()
	{
		parent::Model();
	}

			function get_usu_email($id)
  {
    $qry = $this->db->select('usu_email')
										->from('wb_users')
										->where('usu_id',$id)
                    ->get();
		$res = '';
		
		if($qry->num_rows() > 0)
		{
			
				foreach($qry->result() as $row)
				{
						$res = $row->usu_email;
				}
	
				return $res;
		}

		return $res;
	}
	
}

/* End of file categoria_model.php */
/* Location: ./system/application/model/categoria_model.php */