<?php
class Articulo_model extends Model
{
	function __construct()
	{
		parent::Model();
	}

	function validar_campo($id)
	{
    $qry = $this->db->select('ar_color_disponible')
                    ->from('wb_articulo')
                    ->where('ar_id',$id)
                    ->get();
    $res = '';
    if($qry->num_rows() > 0)
    {
      foreach($qry->result() as $row)
      {
      $res = $row->ar_color_disponible;
      }
    }
    return $res;
	}

	function update_color($color,$id)
	{
    if($this->db->update('wb_articulo',$color, "ar_id = {$id}"))
      return 'La Categoria con el ID: '.$id.' fue actualizado correctamente';
	}

  function update_imagen($imagen,$id)
	{
    if($this->db->update('wb_articulo',$imagen, "ar_id = {$id}"))
      return 'La Imagen con el ID: '.$id.' fue actualizado correctamente';
	}

  function insert_articulo($articulo)
  {
    if($this->db->insert('wb_articulo', $articulo))
      return $this->db->insert_id() ;
  }

  function update_articulo($articulo,$id)
  {
    if($this->db->update('wb_articulo',$articulo, "ar_id = {$id}"))
      return 'El Articulo con el ID: '.$id.' fue actualizado correctamente';
  }

	function get_articulo($id)
	{
    $qry = $this->db->from('wb_articulo')
                    ->join('wb_tipo_articulo', 'ta_id=ar_ta_id', 'inner')
                    ->where('ar_id',$id)
                    ->get();
		$res = '';
		if($qry->num_rows() > 0)
		{
      $res = $qry->result();
		}
		return $res;
	}

  function count_all_articulos()
  {
    $qry = $this->db->select('ar_id')
                    ->from('wb_articulo')
                    ->count_all_results();
    return $qry;
  }

  function count_all_filtro($filtro)
  {
    $qry = $this->db->from('wb_articulo')
                    ->join('wb_categoria','wb_categoria.cat_id = wb_articulo.ar_cat_id','inner')
                    ->join('wb_colores','co_id = ar_co_id','inner')
                    ->like('ar_orden', $filtro['ar_orden'])
                    ->like('ar_descripcion', $filtro['ar_descripcion'])
                    ->like('co_nombre', $filtro['co_nombre'])
                    ->like('ar_ta_id', $filtro['ta_nombre'])
                    ->like('cat_nombre', $filtro['cat_nombre'])
                    ->count_all_results();
    return $qry;
  }

  function get_all_articulos($items, $offset, $html=TRUE)
  {
    //->select('ar_id,ar_ta_id,ar_cat_id,ta_nombre,cat_nombre,ar_descripcion,ar_co_id,ar_imagen,ar_estado')
    $qry = $this->db->from('wb_articulo')
                    ->join('wb_tipo_articulo','wb_tipo_articulo.ta_id = wb_articulo.ar_ta_id','inner')
                    ->join('wb_categoria','wb_categoria.cat_id = wb_articulo.ar_cat_id','inner')
                    ->join('wb_colores','co_id = ar_co_id','inner')
                    ->order_by('ar_orden','DESC')
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
        $e = array(1=>'deshabilitar', 2=>'habilitar');
        foreach($qry->result() as $row)
        {
          $result .= '<tr>
							<td style="text-align:center;">'.$row->ar_orden.'</td>
							<td>'.$row->ar_descripcion.'</td>
							<td>'.$row->co_nombre.'</td>
							<td>'.$row->ta_nombre.'</td>
              <td>'.$row->cat_nombre.'</td>
              <td>'.anchor('administrador/articulo/editar/'.$row->ar_id.'/'.$row->ar_ta_id.'/'.$row->ar_cat_id.'/'.$row->ar_co_id, 'editar').'
               |  '.anchor('administrador/articulo/eliminar/'.$row->ar_id, 'eliminar', 'class="confirm" title="¿Desea elimminar este articulo?"').'
               |  '.anchor('administrador/articulo/'.$e[$row->ar_estado].'/'.$row->ar_id, $e[$row->ar_estado], 'class="confirm" title="¿Desea '.$e[$row->ar_estado].' este articulo?"').'</td>
            </tr>
          ';
        }
      }
    }
    return $result;
  }

  function get_all_filtro($filtro, $items, $offset, $html=TRUE)
  {
    $qry = $this->db->from('wb_articulo')
                    ->join('wb_tipo_articulo','wb_tipo_articulo.ta_id = wb_articulo.ar_ta_id','inner')
                    ->join('wb_categoria','wb_categoria.cat_id = wb_articulo.ar_cat_id','inner')
                    ->join('wb_colores','co_id = ar_co_id','inner')
                    ->like('ar_orden', $filtro['ar_orden'])
                    ->like('ar_descripcion', $filtro['ar_descripcion'])
                    ->like('co_nombre', $filtro['co_nombre'])
                    ->like('ar_ta_id', $filtro['ta_nombre'])
                    ->like('cat_nombre', $filtro['cat_nombre'])
                    ->order_by('ar_orden','DESC')
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
        $e = array(1=>'deshabilitar', 2=>'habilitar');
        foreach($qry->result() as $row)
        {
          $result .= '<tr>
							<td style="text-align:center;">'.$row->ar_orden.'</td>
							<td>'.$row->ar_descripcion.'</td>
							<td>'.$row->co_nombre.'</td>
							<td>'.$row->ta_nombre.'</td>
              <td>'.$row->cat_nombre.'</td>
              <td>'.anchor('administrador/articulo/editar/'.$row->ar_id.'/'.$row->ar_ta_id.'/'.$row->ar_cat_id.'/'.$row->ar_co_id, 'editar').'
               |  '.anchor('administrador/articulo/eliminar/'.$row->ar_id, 'eliminar', 'class="confirm" title="¿Desea elimminar este articulo?"').'
               |  '.anchor('administrador/articulo/'.$e[$row->ar_estado].'/'.$row->ar_id, $e[$row->ar_estado], 'class="confirm" title="¿Desea '.$e[$row->ar_estado].' este articulo?"').'</td>
            </tr>
          ';
        }
      }
    }
    return $result;
  }
  
  function update_file($cue, $data)
  {
    return $this->db->where('ar_id', $cue)
                    ->update('wb_articulo', $data);
  }
  
  function delete_file($cue)
  {
    return $this->db->where('ar_id', $cue)
                    ->delete('wb_articulo');
  }
  

/****PRUEBAS****/
  function get_all_lapiceros($html=TRUE)
  {
    $qry = $this->db->from('wb_articulo')
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
							<td><div class="imagen" id="'.$row->ar_id.'" ><img src="'.base_url().'img/articulos/'.$row->ar_imagen.'"/>
							</div>
							</td>
            </tr>';
        }
      }
    }
    return $result;
  }

	function devuelve_imagen2($id)
	{
    $qry = $this->db->select('ar_imagen2')
                    ->from('wb_articulo')
                    ->where('ar_id',$id)
                    ->get();
    if($qry->num_rows() > 0)
    {
			$res = '';
      foreach($qry->result() as $row)
      {
        $res = $row->ar_imagen2;
      }
			return $res;
    }
		return false;
	}
}

/* End of file categoria_model.php */
/* Location: ./system/application/model/categoria_model.php */