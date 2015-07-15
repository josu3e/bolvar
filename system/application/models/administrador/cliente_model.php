<?php
class Cliente_model extends Model {

	function __construct()
	{
		parent::Model();
	}
	
  function update_cliente($cliente,$id)
	{
	    if($this->db->update('wb_users',$cliente, "usu_id = {$id}"))
      return 'El Cliente con el ID: '.$id.' fue actualizado correctamente';
	}
	
  function delete_cliente($id)
	{
	    if($this->db->where('usu_id', $id)->delete('wb_users'))
      return 'El cliente con el ID: '.$id.' fue eliminado correctamente';
	}
	
  function delete_logos_cliente($id)
	{
	    if($this->db->where('lo_usu_id', $id)->delete('wb_logotipo'))
      return 'El logo con el ID: '.$id.' fue eliminado correctamente';
	}
	
  function count_all_clientes()
  {
    $qry = $this->db->select('usu_id')
                    ->from('wb_users')
										->where('usu_rol_id',1)
                    ->count_all_results();
    return $qry;
  }
	
  function get_cliente($id)
  {
    $qry = $this->db->select('usu_id,usu_rol_id,usu_email,usu_nombre,usu_fono,usu_empresa,usu_fec_nac')
								->from('wb_users')
								->where('usu_id',$id)
								->where('usu_rol_id',1)
                ->get();
								
		$result = $qry->result();
		return $result;
  }
	
  function get_all_clientes($items, $offset, $html=TRUE)
  {
    $qry = $this->db->select('usu_id,usu_rol_id,usu_email,usu_empresa,usu_fono,usu_fec_nac')
								->from('wb_users')
								->where('usu_rol_id',1)
                ->order_by('usu_id','DESC')
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
							<td>'.(isset($row->usu_fec_nac)?$row->usu_fec_nac:'No Disponible').'</td>
              <td>'.$row->usu_email.'</td>
							<td>'.$row->usu_empresa.'</td>
							<td>'.$row->usu_fono.'</td>
							 <td>'.anchor('administrador/cliente/load_update/'.$row->usu_id, 'editar', '').'</td>
              <td>'.anchor('administrador/cliente/eliminar/'.$row->usu_id, 'eliminar', 'class="confirm" title="¿Desea eliminar este cliente?.<br/>
							<br/>Se eliminaran tambien sus logotipos."').'</td>
            </tr>
          ';
        }
      }
    }
    return $result;
  }
  
  function count_cumples()
  {
    $qry = $this->db->from('wb_users')
                    ->where('MONTH(usu_fec_nac)', date('m'))
                    ->where('DAYOFMONTH(usu_fec_nac)', date('d')+2)
                    ->count_all_results();
    return $qry;
  }
  
  function get_cumples($html=TRUE)
  {
    $qry = $this->db->from('wb_users')
                    ->where('MONTH(usu_fec_nac)', date('m'))
                    ->where('DAYOFMONTH(usu_fec_nac)', date('d')+2)
                    ->get();
    if(!$html)
    {
      $rs = $qry->result();
    }
    else
    {
      $rs = '';
      if($qry->num_rows() > 0)
      {
        foreach($qry->result() as $r)
        {
          $rs .= strtoupper($r->usu_nombre).'
          Fecha de Nacimiento: '.$r->usu_fec_nac.' 
          E-mail: '.$r->usu_email.'
          Telefono: '.$r->usu_fono.'
          Empresa: '.$r->usu_empresa."\n\n";
        }
      }
    }
    return $rs;
  }
}

/* End of file categoria_model.php */
/* Location: ./system/application/model/categoria_model.php */