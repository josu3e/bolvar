<?php
class Color_model extends Model {

	function __construct()
	{
		parent::Model();
    $this->_col = 'wb_color';
	}
  
  function count_all_files()
  {
    $qry = $this->db->from($this->_col)
                    ->count_all_results();
    return $qry;
  }
  
  function get_all_files($lmt, $ind, $html=TRUE)
  {
    $qry = $this->db->order_by('col_id', 'DESC')
                    ->limit($lmt, $ind)
                    ->get($this->_col);
    $rs = ($html)?$this->listar($qry):$qry->result();
    return $rs;
  }
  
  function listar($qry)
  {
    $rs = '';
    if($qry->num_rows() > 0)
    {
      $e = array(1=>'deshabilitar', 2=>'habilitar');
      foreach($qry->result() as $r)
      {
        $c = array('src'=>'img/colores/'.$r->col_imagen, 'alt'=>'');
        $rs .= '<tr>
            <td>'.$r->col_id.'</td>
            <td>'.$r->col_nombre.'</td>
            <td>'.img($c).'</td>
            <td>'.anchor('administrador/color/editar/'.$r->col_id, 'editar').'</td>
            <td>'.anchor('administrador/color/eliminar/'.$r->col_id, 'eliminar', 'class="confirm" title="¿Desea elimminar este color?"').'</td>
          </tr>';
      }
    }
    return $rs;
  }
  
  function get_file($cue)
  {
    $qry = $this->db->where('col_id', $cue)
                    ->get($this->_col);
    return $qry->row_array();
  }
  
  function insert_file($file)
  {
    return $this->db->insert($this->_col, $file);
  }
  
  function update_file($cue, $data)
  {
    return $this->db->where('col_id', $cue)
                    ->update($this->_col, $data);
  }
  
  function delete_file($cue)
  {
    return $this->db->where('col_id', $cue)
                    ->delete($this->_col);
  }
	
/* ---------------------------------------------------------------------------------------------- */
/* JAVASCRIPT FUNCTIONS */
/* ---------------------------------------------------------------------------------------------- */
  function get_all_array()
  {
    $qry = $this->db->order_by('col_id', 'ASC')
                    ->get($this->_col);
    $rs = array('all'=>'Todos');
    if($qry->num_rows() > 0)
    {
      foreach($qry->result() as $r)
        $rs[$r->col_id] = $r->col_nombre;
    }
    return $rs;
  }
/* ---------------------------------------------------------------------------------------------- */
}

/* End of file categoria_model.php */
/* Location: ./system/application/model/categoria_model.php */