<?php
class Logotipo_model extends Model {

	function __construct()
	{
		parent::Model();
    $this->_log = 'wb_logotipo';
	}

	
	
	function logo($id_negativo,$id_usu,$lo_key)
  {
    $qry = $this->db->where('lo_usu_id',$id_usu)
                    ->where('lo_key',$lo_key)
                    ->get($this->_log);
    $rs = FALSE;
    if($qry->num_rows() > 0 AND $log = $qry->row())
    {
      $rs = $log->lo_nombre;
      if($id_negativo == 1)
        $rs = $log->lo_nombre2;
    }
    return $rs;
	}
  

}

/* End of file categoria_model.php */
/* Location: ./system/application/model/categoria_model.php */