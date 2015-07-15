<?php
class Colores_model extends Model {

	function __construct()
	{
		parent::Model();
	}
	
	function get_color($id)
	{
	    $qry = $this->db->from('wb_colores')
			->where('co_id',$id)
                    ->get();
								return $qry->result();						
	}
		  function insert_color($color)
  {
    if($this->db->insert('wb_colores', $color))
      return 'El Color  fue insertado correctamente';
  }
		function update_color($color,$id)
	{
	    if($this->db->update('wb_colores',$color, "co_id = {$id}"))
      return 'El Color con el ID: '.$id.' fue actualizado correctamente';
	}
	
  	  function delete_color($id)
  {
    if($this->db->where('co_id', $id)->delete('wb_colores'))
      return 'El color con el ID: '.$id.' fue eliminado correctamente';
  }
	  function count_all_colores()
  {
    $qry = $this->db->select('co_id')
                    ->from('wb_colores')
                    ->count_all_results();
    return $qry;
  }
  	  function get_all_colores($items, $offset, $html=TRUE)
  {
    $qry = $this->db->from('wb_colores')
                    ->order_by('co_id','DESC')
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
							<td>'.$row->co_id.'</td>
              <td>'.$row->co_nombre.'</td>
							<td><img src="'.base_url().'img/colores/'.$row->co_imagen.'"/></td>
              <td>'.anchor('administrador/color/editar/'.$row->co_id, 'editar').'</td>
              <td>'.anchor('administrador/color/eliminar/'.$row->co_id, 'eliminar', 'class="confirm" title="¿Desea elimminar este color?"').'</td>
            </tr>
          ';
        }
      }
    }
    return $result;
  }
	
	
  function get_colores($html=true)
  {
    $qry = $this->db->from('wb_colores')
      ->order_by('co_nombre', 'ASC')
                    ->get();
 
			$res = '<select id="colores" name="colores">';
      if($qry->num_rows() > 0)
      {
        foreach($qry->result() as $row)
        {
					if($row->co_imagen != "")
					{
          $res .= '<option id="'.$row->co_id.'" value="'.$row->co_id.'">'.$row->co_nombre.'</option>'.'<br/>'; 
					}
        }
				$res .= '</select>';
      }

    return $res;
  }
  
	  function color_selected($id)
  {
    $qry = $this->db->from('wb_colores')
                    ->get();
 
			$res = '<select id="colores" name="colores">';
      if($qry->num_rows() > 0)
      {
        foreach($qry->result() as $row)
        {
					if($row->co_id == $id)
					{
					$res .= '<option id="'.$row->co_id.'" value="'.$row->co_id.'" selected>'.$row->co_nombre.'</option>'.'<br/>'; 
					}
					else
					{
          $res .= '<option id="'.$row->co_id.'" value="'.$row->co_id.'">'.$row->co_nombre.'</option>'.'<br/>'; 
					}
        }
				$res .= '</select>';
      }

    return $res;
  }
}

/* End of file categoria_model.php */
/* Location: ./system/application/model/categoria_model.php */