<?php
class Tipoarticulo_model extends Model {

	function __construct()
	{
		parent::Model();
	}
  
  function get_tipoarticulo($html=true)
  {
    $qry = $this->db->from('wb_tipo_articulo')
                    ->get();
 
			$res = '<select id="tipoarticulo" name="tipoarticulo">';
      if($qry->num_rows() > 0)
      {
        foreach($qry->result() as $row)
        {
          $res .= '<option id="'.$row->ta_id.'" value="'.$row->ta_id.'">'.$row->ta_nombre.'</option>'.'<br/>'; 
        }
				$res .= '</select>';
      }

    return $res;
  }
  
	  function tpoarticulo_selected($id)
  {
    $qry = $this->db->from('wb_tipo_articulo')
                    ->get();
 
			$res = '<select id="tipoarticulo" name="tipoarticulo">';
      if($qry->num_rows() > 0)
      {
        foreach($qry->result() as $row)
        {
					if($row->ta_id == $id)
					{
					$res .= '<option id="'.$row->ta_id.'" value="'.$row->ta_id.'" selected>'.$row->ta_nombre.'</option>'.'<br/>'; 
					}
					else
					{
          $res .= '<option id="'.$row->ta_id.'" value="'.$row->ta_id.'">'.$row->ta_nombre.'</option>'.'<br/>'; 
					}
        }
				$res .= '</select>';
      }

    return $res;
  }
  
/* ---------------------------------------------------------------------------------------------- */
/* JAVASCRIPT FUNCTIONS */
/* ---------------------------------------------------------------------------------------------- */
  function get_all_array($p=0)
  {
    $qry = $this->db->where('cat_padre', $p)
                    ->get($this->_cat);
    $rs = array('all'=>'Todos');
    if($qry->num_rows() > 0)
    {
      foreach($qry->result() as $r)
        $rs[$r->cat_id] = $r->cat_nombre;
    }
    return $rs;
  }
  
  function get_child_node($id)
  {
    $qry = $this->db->from($this->_cat)
                    ->where('cat_padre', $id)
                    ->get();
    $rs = '<option value="all">Todos</option>';
    if($id!=='all')
      foreach($qry->result() as $r)
      {
        $rs .= '<option value="'.$r->cat_id.'">'.$r->cat_nombre.'</option>';
      }
    return $rs;
  }
/* ---------------------------------------------------------------------------------------------- */
}

/* End of file categoria_model.php */
/* Location: ./system/application/model/categoria_model.php */