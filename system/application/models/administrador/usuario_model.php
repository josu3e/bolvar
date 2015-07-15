<?php
class Usuario_model extends Model {

	function __construct()
	{
		parent::Model();
	}

  
  function get_usuarios($html=TRUE)
  {
    $qry = $this->db->select('usu_id,usu_username')
                    ->from('wb_users')
										->where('usu_rol_id',1)
                    ->get();
    if(!$html)
    {
      $result = $qry->result();
    }
    else
    {
      $result = '';
      if($qry->num_rows() > 0)
      {
        foreach($qry->result() as $row)
        {
          $result .= '
            <tr>
              <td>'.$row->usu_id.'</td>
              <td>'.$row->usu_username.'</td>
              <td>'.anchor('administrador/logotipo/load_crear/'.$row->usu_id, 'Añadir Logotipo').'</td>
            </tr>';
        }
      }
    }
    return $result;
  }


}

/* End of file categoria_model.php */
/* Location: ./system/application/model/categoria_model.php */