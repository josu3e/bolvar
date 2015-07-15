<?php
class Logotipos_model extends Model {

	function __construct()
	{
		parent::Model();
	}
	


	function logos_by_user($idusu,$html=TRUE)
  {
    $qry = $this->db->from('wb_logotipo')
										->where('lo_usu_id',$idusu)	
                    ->get();
		$res = '';
		if($qry->num_rows() > 0)
		{

				foreach($qry->result() as $row)
				{
		
						$res .= '<div class="logos">
						<a href="'.base_url().'index.php/usuario/logo/set_logo/'.$row->lo_nombre.'">
						<img src="'.base_url().'img/logotipos/'.$row->lo_nombre.'" width="118" height="45">
						</a>
						</div>';
		
				}
	
				return $res;
		}

		return $res;
	}


	
}

/* End of file categoria_model.php */
/* Location: ./system/application/model/categoria_model.php */