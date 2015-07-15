<?php
class articulos_model extends Model {

	function __construct()
	{
		parent::Model();
    $this->_art = 'wb_articulo';
    $this->_col = 'wb_color';
    $this->_cat = 'wb_categoria';
    $this->_log = 'wb_logotipo';
	}
  
  function count_all_articulos($tipo, $cat, $col)
  {
    // $col = ($col=='todos')?'':$col;
    $qry = $this->db->from($this->_art)
                    ->join($this->_cat, 'cat_id = art_cat_id', 'inner')
                    // ->join('wb_tipo_articulo', 'ta_id = cat_ta_id', 'inner')
                    ->join($this->_col, 'col_id = art_col_id', 'left')
                    ->where('art_tar_id', $tipo)
                    ->where('cat_key', $cat)
                    ->where('col_key', $col)
                    ->where('art_estado', 1)
                    ->count_all_results();
    return $qry;
  }
  
  function get_all_articulos($tipo, $cat, $col, $log, $cart, $lmt, $ind, $html=TRUE)
  {
    // $col = ($col=='todos')?'':$col;
    $val = $tipo==2?'like':'where';
    $cart = is_array($cart)?$cart:array();
    $qry = $this->db->from($this->_art)
                    ->join($this->_cat, 'cat_id = art_cat_id', 'inner')
                    // ->join('wb_tipo_articulo', 'ta_id = cat_ta_id', 'inner')
                    ->join($this->_col, 'col_id = art_col_id', 'left')
                    ->where('art_tar_id', $tipo)
                    ->where('cat_key', $cat)
                    ->$val('col_key', $col)
                    ->where('art_estado', 1)
                    ->order_by('art_orden','ASC')
                    ->limit($lmt, $ind)
                    ->get();
    if(!$html)
    {
      $rs = $qry->result_array();
    }
    else
    {
      $rs = '';
      if($qry->num_rows() > 0 && $tipo == 1)
      {
        $lo = $this->get_logo_key($log);
        foreach($qry->result() as $r)
        {
          $t = $this->_get_cat($r->art_tar_id);
          // $img = ($r->art_negativo==1)?array('src'=>'img/logotipos/'.$lo->lo_nombre2,'width'=>'150','height'=>'40','alt'=>''):array('src'=>'img/logotipos/'.$lo->lo_nombre,'width'=>'150','height'=>'40','alt'=>'');
          $img = ($r->art_negativo==1)?array('src'=>'img/logotipos/'.$lo->lo_nombre2,'alt'=>''):array('src'=>'img/logotipos/'.$lo->lo_nombre,'alt'=>'');
          $logo = ($tipo == 1)?'<div class="top">'.img($img).'</div>':'';
          $acc = array_key_exists($r->art_id.'_'.$log, $cart)?'del_cart':'add_cart';
          $pic = array('src'=>'img/articulos/'.$t->cat_key.'/'.$r->art_imagen, 'alt'=>$r->art_codigo);
          $rs .= '
          <div class="renglon_lapcero">
            <div class="img">'.$logo.img($pic).'</div>
            <div class="codec"><span>ID: '.$r->art_codigo.'</span></div>
            <div class="ico_poner_quitar">'.anchor('#'.$acc, ' ','id="id_'.$r->art_id.'_'.$log.'_'.$r->art_negativo.'_'.$r->art_codigo.'" class="'.$acc.' '.$acc.'_img"').'</div>
          </div>';
          // <div class="img">'.$logo.anchor(base_url().'img/articulos/'.$t->cat_key.'/'.$r->art_imagen2, img($pic), 'rel="sexylightbox"').'</div>
        }
      }
      else
      {
        foreach($qry->result() as $r)
        {
          $t = $this->_get_cat($r->art_tar_id);
          $acc = array_key_exists($r->art_id.'_'.$log, $cart)?'del_cart':'add_cart';
          $pic = array('src'=>'img/articulos/'.$t->cat_key.'/'.$r->art_imagen, 'alt'=>$r->art_codigo);
          $rs .= '
          <div class="renglon_lapcero">
            <div class="img">'.img($pic).'</div>
            <div class="codec"><span>ID: '.$r->art_codigo.'</span></div>
            <div class="ico_poner_quitar">'.anchor('#'.$acc, ' ','id="id_'.$r->art_id.'_'.$log.'_'.$r->art_negativo.'_'.$r->art_codigo.'" class="'.$acc.' '.$acc.'_img"').'</div>
          </div>';
        }
      }
    }
    return $rs;
  }
	
  function default_categoria($tipo)
  {
    $qry = $this->db->from($this->_cat)
                    // ->join($this->_art, 'art_cat_id = cat_id', 'left')
                    // ->join($this->_col, 'art_col_id = col_id', 'left')
                    ->where('cat_padre', $tipo)
                    ->where('cat_estado', 1)
                    // ->order_by('cat_id', 'ASC')
                    ->limit(1)
                    ->get();    
    return $qry->row_array();
  }
  
  function default_color($tipo, $cat)
  {
    $qry = $this->db->select('col_id, col_nombre, col_imagen, col_key')
                    ->from($this->_col)
                    ->join($this->_art, 'art_col_id = col_id', 'inner')
                    ->join($this->_cat, 'art_cat_id = cat_id', 'inner')
                    // ->where('art_ta_id', $tipo)
                    ->where('cat_key', $cat)
                    ->where('art_estado', 1)
                    ->where('col_estado', 1)
                    ->group_by('col_id')
                    ->limit(1)
                    ->get();
    return $qry->row_array();
  }
  
  function default_logo($usu)
  {
    $qry = $this->db->from($this->_log)
                    ->where('lo_usu_id', $usu)
                    ->where('lo_estado', 1)
                    ->limit(1)
                    ->get();
    return $qry->row_array();
  }
  
  function get_categorias($tipo, $cat, $html=TRUE)
  {
    $qry = $this->db->from($this->_cat)
                    // ->join('wb_tipo_articulo', 'ta_id = cat_ta_id', 'inner')
                    ->where('cat_padre', $tipo)
                    ->where('cat_estado', 1)
                    // ->group_by('cat_nombre', 'ASC')
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
          $t = $this->_get_cat($r->cat_padre);
          $cls = ($r->cat_key==$cat)?'activo':'';
          $rs .= '<li class="'.$cls.'"><span>&nbsp;</span>'. anchor('articulos/'.$t->cat_key.'/'.$r->cat_key, $r->cat_nombre).'</li>';
        }
      }
    }
    return $rs;
  }
  
  function get_colores($tipo, $cat, $html=TRUE)
  {
    $qry = $this->db->from($this->_art)
                    // ->join('wb_tipo_articulo', 'ta_id = art_ta_id', 'inner')
                    ->join($this->_cat, 'cat_id = art_cat_id', 'inner')
                    ->join($this->_col, 'art_col_id = col_id', 'inner')
                    ->where('art_tar_id', $tipo)
                    ->where('cat_key', $cat)
                    ->group_by('col_id')
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
          $t = $this->_get_cat($r->cat_padre);
          $col = array('src'=>'img/colores/'.$r->col_imagen, 'width'=>'26', 'height'=>'26', 'alt'=>'Color: '.$r->col_nombre);
          $rs .= '
          <div class="iconos">'.anchor('articulos/'.$t->cat_key.'/'.$cat.'/'.$r->col_key, img($col)).'</div>
          ';
        }
      }
    }
    return $rs;
  }
  
  function get_logos($cat, $col, $id, $html=TRUE)
  {
    $qry = $this->db->from($this->_log)
                    ->where('lo_usu_id', $id)
                    ->where('lo_estado', 1)
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
          $lo = array('src'=>'img/logotipos/'.$r->lo_nombre, 'width'=>'120', 'height'=>'40', 'alt'=>'');
          $logo = ($cat!='metalicos')?anchor('articulos/lapiceros/'.$cat.'/'.$col.'/'.$r->lo_key, img($lo)):img($lo);
          $rs .= '<div class="logos">'.$logo.'</div>';
        }
      }
    }
    return $rs;
  }
  
  function get_logo_key($key)
  {
    $qry = $this->db->where('lo_key', $key)
                    ->get($this->_log);
    return $qry->row();
  }
  
  function get_articulo($id)
  {
    $qry = $this->db->where('art_id', $id)
                    ->get($this->_art);
    return $qry->row_array();
  }
  
  function _get_cat($id)
  {
    $qry = $this->db->where('cat_id', $id)
                    ->get($this->_cat);
    return $qry->row();
  }
}

/* End of file articulos_model.php */
/* Location: ./system/application/model/articulos_model.php */