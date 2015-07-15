<?php
class Colores_model extends Model {

	function __construct()
	{
		parent::Model();
	}

  function get_colores($id,$primercat,$primercol)
  {
    $qry = $this->db->select('co_id,co_imagen')
		->from('wb_articulo')
		->join('wb_colores','wb_colores.co_id = wb_articulo.ar_co_id','inner')
		->where('ar_cat_id',$id)
		->distinct()
    ->get();
 
			$res = '';
      if($qry->num_rows() > 0)
      {
        foreach($qry->result() as $row)
        {

          $res .= '<div class="iconos" id="'.$row->co_id.'"><a href="'.base_url().'index.php/articulo/'.$primercat.'/'.$primercol.'"><img src="'.base_url().'img/colores/'.$row->co_imagen.'" width="26" height="26"/></a></div>'; 
        }
				return $res;
      }

    return $res;
  }
	
	  function load_colores($id)
  {
    $qry = $this->db->select('co_id,co_imagen')
		->from('wb_articulo')
		->join('wb_colores','wb_colores.co_id = wb_articulo.ar_co_id','inner')
		->where('ar_cat_id',$id)
		->distinct()
    ->get();
 
			$res = '';
      if($qry->num_rows() > 0)
      {
        foreach($qry->result() as $row)
        {

          $res .= '<div class="iconos" id="'.$row->co_id.'"><a href="'.base_url().'index.php/usuario/articulo/articulos_by_color/'.$id.'/'.$row->co_id.'"><img src="'.base_url().'img/colores/'.$row->co_imagen.'" width="26" height="26"/></a></div>'; 
        }
				return $res;
      }

    return $res;
  }
	
	  function get_primer_col($id)
  {
    $qry = $this->db->select('co_id')
		->from('wb_articulo')
		->join('wb_colores','wb_colores.co_id = wb_articulo.ar_co_id','inner')
		->where('ar_cat_id',$id)
		->order_by('co_id','ASC')
		->limit(1,0)
    ->get();
 
			$res = '';
      if($qry->num_rows() > 0)
      {
        foreach($qry->result() as $row)
        {

          $res = $row->co_id;
        }
				return $res;
      }

    return $res;
  }
	
		  function get_id_color($id)
  {
    $qry = $this->db->select('ar_co_id')
		->from('wb_articulo')
		->where('ar_id',$id)
    ->get();
 
			$res = '';
      if($qry->num_rows() > 0)
      {
        foreach($qry->result() as $row)
        {

          $res = $row->ar_co_id;
        }
				return $res;
      }

    return $res;
  }

}

/* End of file categoria_model.php */
/* Location: ./system/application/model/categoria_model.php */