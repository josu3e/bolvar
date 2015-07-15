<?php
class Categorias_model extends Model {

	function __construct()
	{
		parent::Model();
	}

	function get_categorias($idta)
	{
	    $qry = $this->db->from('wb_categoria')
										->where('cat_ta_id',$idta)
										->order_by('cat_id','ASC')
                    ->get();
			$rs = '';
			if($qry->num_rows() > 0)
      {
			$rs = '<ul>';
        foreach($qry->result() as $r)
        {
          $rs .= '<li>'.anchor('articulos/lapiceros/'.$r->cat_key,$r->cat_nombre).'</li>';
        }
				$rs = '</ul>';
      }
			return $rs;
	}
	
	// function cat_selected($idcat,$idta,$html=TRUE)
  // {
    // $qry = $this->db->from('wb_categoria')
										// ->where('cat_ta_id',$idta)//1 xq es lapicero
										// ->order_by('cat_id','ASC')
                    // ->get();
		// if($qry->num_rows() > 0)
		// {
      // $res = '';
      // foreach($qry->result() as $row)
      // {
        // if($row->cat_id == $idcat)
        // {
        // $res .= '<li><input type="radio" class="filtroco" onClick="form_articulo.submit()" name="categorias" value="'.$row->cat_id.'" CHECKED >'.$row->cat_nombre.'</li>';
        // }
        // else
        // {
        // $res .= '<li><input type="radio" class="filtroco" onClick="form_articulo.submit()" name="categorias" value="'.$row->cat_id.'" >'.$row->cat_nombre.'</li>';
        // }
      // }
      // return $res;
		// }
		// return $res;
	// }
  
	// function get_categorias($idta, $html=TRUE)
  // {
    // $qry = $this->db->from('wb_categoria')
										// ->where('cat_ta_id',$idta)//1 xq es lapicero
										// ->order_by('cat_id','ASC')
                    // ->get();
		// if($qry->num_rows() > 0)
		// {
      // $res = '';
      // $x = 0;
      // foreach($qry->result() as $row)
      // {
        // $x++;
        // if($x == 1)
        // {
          // $res .= '<li><input type="radio" class="filtroco" onClick="form_articulo.submit()" name="categorias" value="'.$row->cat_id.'" CHECKED >'.$row->cat_nombre.'</li>';
        // }
        // else
        // {
          // $res .= '<li><input type="radio" class="filtroco" onClick="form_articulo.submit()" name="categorias" value="'.$row->cat_id.'" >'.$row->cat_nombre.'</li>';
        // }
      // }
			// return $res;
		// }
		// return $res;
	// }

	// function get_primer_cat($idta, $html=TRUE)
  // {
    // $qry = $this->db->select('cat_id')
										// ->from('wb_categoria')
										// ->where('cat_ta_id',$idta)
										// ->order_by('cat_id','ASC')
										// ->limit(1,0)
                    // ->get();
		// $res = '';
		// if($qry->num_rows() > 0)
		// {
      // $row = $qry->row();
      // return $row->cat_id;
		// }

		// return $res;
	// }

  // function cat_tipo_articulo($idta,$html=TRUE)
  // {
    // $qry = $this->db->select('cat_id')
										// ->from('wb_categoria')
										// ->where('cat_ta_id',$idta) //1 xq es lapicero
										// ->order_by('cat_id','ASC')
                    // ->get();
		// $res = '';

		// if($qry->num_rows() > 0)
		// {
				// foreach($qry->result() as $row)
				// {
						// $res = $row->cat_id;
				// }

				// return $res;
		// }

		// return $res;
	// }

}

/* End of file categoria_model.php */
/* Location: ./system/application/model/categoria_model.php */