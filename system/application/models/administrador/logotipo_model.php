<?php
class Logotipo_model extends Model {

	function __construct()
	{
		parent::Model();
	}

	  function update_logo($logotipo,$id)
  {
    if($this->db->update('wb_logotipo',$logotipo, "lo_id = {$id}"))
      return 'El Logotipo con el ID: '.$id.' fue actualizado correctamente';
  }
	function get_logo_usuario($idlo,$idus)
	{
	    $qry = $this->db->from('wb_logotipo')
                    ->where('lo_id',$idlo)
										->where('lo_usu_id',$idus)
                    ->get();
		$res = '';
		if($qry->num_rows() > 0)
		{
		$res = $qry->result();
		}
		return $res;

	}

  function delete_logo($id)
  {
    if($this->db->where('lo_id', $id)->delete('wb_logotipo'))
      return 'El archivo con el ID: '.$id.' fue eliminado correctamente';
  }
  function save_logotipo($logo)
	{
    $this->db->insert('wb_logotipo',$logo);
    return $this->db->insert_id();
	}
  
  function count_all_logos()
  {
    $qry = $this->db->from('wb_logotipo')
										->join('wb_users','wb_users.usu_id = wb_logotipo.lo_usu_id','inner')
                    ->count_all_results();
    return $qry;
  }
  
  function get_all_logos($items, $offset, $html=TRUE)
  {
    $qry = $this->db->select('lo_id,lo_nombre,lo_nombre2,usu_username,usu_id')
										->from('wb_logotipo')
										->join('wb_users','wb_users.usu_id = wb_logotipo.lo_usu_id','inner')
                    ->order_by('lo_id','DESC')
                    ->limit($items, $offset)
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
          $result .= '<tr>
							<td>'.'<img src='.base_url().'img/logotipos/'.$row->lo_nombre.' /></td>
							<td>'.'<img src='.base_url().'img/logotipos/'.$row->lo_nombre2.' /></td>
              <td>'.$row->usu_username.'</td>
              <td>'.anchor('administrador/logotipo/editar/'.$row->lo_id.'/'.$row->usu_id, 'editar').'</td>
              <td>'.anchor('administrador/logotipo/eliminar/'.$row->lo_id, 'eliminar', 'class="confirm" title="¿Desea elimminar este logotipo?"').'</td>
            </tr>
          ';
        }
      }
    }
    return $result;
  }
	
}

/* End of file categoria_model.php */
/* Location: ./system/application/model/categoria_model.php */