<?php
class Articulo_model extends Model {

	function __construct()
	{
		parent::Model();
	}
		  function count_all_articulos()
  {
    $qry = $this->db->select('ar_id')
                    ->from('wb_articulo')
                    ->count_all_results();
    return $qry;
  }

			  function count_articulos_color($id)
  {
    $qry = $this->db->select('ar_id')
                    ->from('wb_articulo')
										->where('ar_co_id',$id)
                    ->count_all_results();
    return $qry;
  }
				  function count_articulos_cat($id)
  {
    $qry = $this->db->select('ar_id')
                    ->from('wb_articulo')
										->where('ar_cat_id',$id)
                    ->count_all_results();
    return $qry;
  }
					  function count_articulos_by_color($idcat,$idcolor)
  {
    $qry = $this->db->select('ar_id')
                    ->from('wb_articulo')
										->where('ar_cat_id',$idcat)
										->where('ar_co_id',$idcolor)
                    ->count_all_results();
    return $qry;
  }

			// function get_articulos($id,$items,$offset,$html=TRUE)
  // {
    // $qry = $this->db->from('wb_articulo')
										// ->where('ar_cat_id',$id)
										// ->limit($items, $offset)
                    // ->get();
    // if(!$html)
    // {
      // $result = $qry->result();
    // }
    // else
    // {
      // $result = '';
      // if($qry->num_rows() > 0)
      // {
        // foreach($qry->result() as $row)
        // {
          // $result .= '<div class="renglon_lapcero">
					// <div class="imagen" id="'.$row->ar_id.'" ><img class="zonaimg" src="'.base_url().'img/articulos/'.$row->ar_imagen.'"></div>
						// <div class="codec"><span>Cod: '.$row->ar_id.'</span></div>
						// <div id="'.$row->ar_id.'" class="ico_poner_quitar">
						// <a href="'.base_url().'index.php/usuario/cotizacion/add_articulo/'.$row->ar_id.'/'.$row->ar_ta_id.'/'.$row->ar_cat_id.'"><img src="'.base_url().'img/ico_anadir.gif"></a>
						// </div>
            // </div>
          // ';
        // }
      // }
    // }
    // return $result;
  // }
				function get_articulos($id,$html=TRUE)
  {
    $qry = $this->db->from('wb_articulo')
										->where('ar_cat_id',$id)
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
					<div class="renglon_lapcero">
					<p><img id="forlogo" src="'.base_url().'img/logotipos/'.$this->session->userdata('lo_nombre').'"/></p>
					<div class="imagen" id="'.$row->ar_id.'">
					<a href="'.base_url().'img/articulos/'.$row->ar_imagen2.'"><img class="zonaimg" src="'.base_url().'img/articulos/'.$row->ar_imagen.'"/></a>
					</div>

						<div class="codec"><span>Cod: '.$row->ar_id.'</span></div>
						<div class="ico_poner_quitar">
						<img class="ico_poner" id="'.$row->ar_id.'" src="'.base_url().'img/ico_anadir.gif"/>
						</div>
            </div>
          ';
        }
      }
    }
    return $result;
  }
		function get_articulos_gimmix($id,$html=TRUE)
  {
    $qry = $this->db->from('wb_articulo')
										->where('ar_cat_id',$id)
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
          $result .= '<div class="renglon_gimmix">

					<div class="imggimmix" id="'.$row->ar_id.'" ><img class="zonaimg" src="'.base_url().'img/articulos/'.$row->ar_imagen.'"></div>
						<div class="forgimmix">
								<div class="codec_gimmix">
								<span>Cod: '.$row->ar_id.'</span></div>
						<div class="ico_poner_quitar_gimmix">
						<img class="ico_poner" id="'.$row->ar_id.'" src="'.base_url().'img/ico_anadir.gif"/>
						</div>

						</div>
						</div>
          ';
        }
      }
    }
    return $result;
  }

	// function get_articulos_gimmix($id,$html=TRUE)
  // {
    // $qry = $this->db->from('wb_articulo')
										// ->where('ar_cat_id',$id)
                    // ->get();
    // if(!$html)
    // {
      // $result = $qry->result();
    // }
    // else
    // {
      // $result = '';
      // if($qry->num_rows() > 0)
      // {
        // foreach($qry->result() as $row)
        // {
          // $result .= '<div class="renglon_lapcero">

					// <div class="imggimmix" id="'.$row->ar_id.'" ><img class="zonaimg" src="'.base_url().'img/articulos/'.$row->ar_imagen.'"></div>
						// <div class="forgimmix">
								// <div class="codec">
								// <span>Cod: '.$row->ar_id.'</span></div>
						// <div class="ico_poner_quitar">
						// <img class="ico_poner" id="'.$row->ar_id.'" src="'.base_url().'img/ico_anadir.gif"/>
						// </div>

						// </div>
						// </div>
          // ';
        // }
      // }
    // }
    // return $result;
  // }

		function articulo_by_cat($idcat)
	{
	    $qry = $this->db->select('ar_ta_id')
			->from('wb_articulo')
			->where('ar_cat_id',$idcat)
			->limit(1,0)
      ->get();
			if($qry->num_rows() > 0)
			{
			$res = '';
				foreach($qry->result() as $row)
				{
				$res = $row->ar_ta_id;
				}
			return $res;
			}
		return false;
	}

	// function devuelve_imagen2($id)
	// {
	    // $qry = $this->db->select('ar_imagen2')
			// ->from('wb_articulo')
			// ->where('ar_id',$id)
        // ->get();
			// if($qry->num_rows() > 0)
			// {
			// $res = '';
				// foreach($qry->result() as $row)
				// {
				// $res = $row->ar_imagen2;
				// }
			// return $res;
			// }
		// return false;
	// }
		function articulos_by_color($id,$html=TRUE)
  {
    $qry = $this->db->from('wb_articulo')
										->where('ar_co_id',$id)
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
          <div class="renglon_lapcero">
            <img src="'.base_url().'img/img_lapicero.jpg" alt=""/>
            <div class="codec"><span>'.$row->ar_id.'</span></div>
            <div class="ico_poner_quitar"><img class="ico_poner" id="'.$row->ar_id.'" src="'.base_url().'img/ico_anadir.gif" alt=""/></div>
          </div>
          ';
					// <div class="renglon_lapcero">
            // <p><img id="forlogo" src="'.base_url().'img/logotipos/'.$this->session->userdata('lo_nombre').'"/></p>
            // <div class="imagen" id="'.$row->ar_id.'">
              // <a href="'.base_url().'img/articulos/'.$row->ar_imagen2.'"><img class="zonaimg" src="'.base_url().'img/articulos/'.$row->ar_imagen.'"/></a>
            // </div>
						// <div class="codec"><span>Cod: '.$row->ar_id.'</span></div>
						// <div class="ico_poner_quitar">
              // <img class="ico_poner" id="'.$row->ar_id.'" src="'.base_url().'img/ico_anadir.gif"/>
						// </div>
          // </div>
        }
      }
    }
    return $result;
  }

		// function articulos_by_color($id,$items, $offset,$html=TRUE)
  // {
    // $qry = $this->db->from('wb_articulo')
										// ->where('ar_co_id',$id)
										// ->limit($items, $offset)
                    // ->get();
    // if(!$html)
    // {
      // $result = $qry->result();
    // }
    // else
    // {
      // $result = '';
      // if($qry->num_rows() > 0)
      // {
        // foreach($qry->result() as $row)
        // {
          // $result .= '<div class="renglon_lapcero">
					// <div class="imagen" id="'.$row->ar_id.'" ><img class="zonaimg" src="'.base_url().'img/articulos/'.$row->ar_imagen.'"/></div>
						// <div class="codec"><span>Cod: '.$row->ar_id.'</span></div>
						// <div id="'.$row->ar_id.'" class="ico_poner_quitar">
						// <a href="'.base_url().'index.php/usuario/cotizacion/add_articulo/'.$row->ar_id.'/'.$row->ar_ta_id.'/'.$row->ar_cat_id.'"><img src="'.base_url().'img/ico_anadir.gif"/></a>
						// </div>
            // </div>
          // ';
        // }
      // }
    // }
    // return $result;
  // }

	function get_filtro_articulos($idcat,$idcolor,$html=TRUE)
	{
	    $qry = $this->db->from('wb_articulo')
										->where('ar_cat_id',$idcat)
										->where('ar_co_id',$idcolor)
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
					<div class="renglon_lapcero">
					<p><img id="forlogo" src="'.base_url().'img/logotipos/'.$this->session->userdata('lo_nombre').'"/></p>
					<div class="imagen" id="'.$row->ar_id.'">
					<a href="'.base_url().'img/articulos/'.$row->ar_imagen2.'"><img class="zonaimg" src="'.base_url().'img/articulos/'.$row->ar_imagen.'"/></a>
					</div>

						<div class="codec"><span>Cod: '.$row->ar_id.'</span></div>
						<div class="ico_poner_quitar">
						<img class="ico_poner" id="'.$row->ar_id.'" src="'.base_url().'img/ico_anadir.gif"/>
						</div>
            </div>
          ';
        }
      }
    }
    return $result;
	}



}

/* End of file categoria_model.php */
/* Location: ./system/application/model/categoria_model.php */