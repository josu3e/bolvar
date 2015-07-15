<?php
class Cotizacion_model extends Model {

	function __construct()
	{
		parent::Model();
	}
	
		  function delete_articulo($id)
  {
    if($this->db->where('dc_id', $id)->delete('wb_detalle_cotizacion'))
      return 'El articulo con el ID: '.$id.' fue eliminado correctamente';
  }
	
		function valida_articulo($idar,$idcot)
		{
			    $qry = $this->db->from('wb_detalle_cotizacion')
								->where('dc_ar_id',$idar)
								->where('dc_cot_id',$idcot)
								->get();
					$res = 0;
					
						if($qry->num_rows() > 0)
						{
							$res = 1;
						}
					return $res;
					
		}
	

	function get_det_cotizacion($id)
	{
		    $qry = $this->db->select('dc_id')
								->from('wb_detalle_cotizacion')
								->where('dc_cot_id',$id)
								->get();
				return $qry->result();		
				// return $qry;				
	}				
	
			function update_det_cotizacion($articulo,$id)
	{
	    if($this->db->update('wb_detalle_cotizacion',$articulo, "dc_id = {$id}"))
      return 'El Color con el ID: '.$id.' fue actualizado correctamente';
	}
				function confirma_cotizacion($cotizacion,$id)
	{
	    if($this->db->update('wb_cotizacion',$cotizacion, "cot_id = {$id}"))
      return 'El Color con el ID: '.$id.' fue actualizado correctamente';
	}
	
	
	function insert_det_cotizacion($articulo)
  {
    if($this->db->insert('wb_detalle_cotizacion', $articulo))
      // return 'El articulo  fue insertado correctamente';
			return $this->db->insert_id();
  }
		function insert_cotizacion($articulo)
  {
    if($this->db->insert('wb_cotizacion', $articulo))
      // return 'La Cotizacion  fue insertado correctamente';
			return $this->db->insert_id();
  }
	function get_last_cotizacion()
	{
	    $qry = $this->db->select('cot_id')
								->from('wb_cotizacion')
								->order_by('cot_id','DESC')
								->limit(1,0)
								->get();
			$res = 0;					
	      if($qry->num_rows() > 0)
      {
        foreach($qry->result() as $row)
        {
          $res = $row->cot_id; 
        }
			
      }
			return $res;
			
	}
	
	function get_cotizacion($idcot,$html=TRUE)
  {
    $qry = $this->db->select('ar_id,dc_id,dc_ar_id,ar_imagen,dc_cantidad')
								->from('wb_detalle_cotizacion')
								->where('dc_cot_id',$idcot)
								->join('wb_articulo','wb_articulo.ar_id = wb_detalle_cotizacion.dc_ar_id','inner')
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
				$result .='<table class="tbl_lista"><th>Codigo</th><th>Articulo</th><th>Cantidad</th><th>Accion</th>';	
        foreach($qry->result() as $row)
        { 
          $result .= '<tr>
											<td>'.$row->ar_id.'</td>
											<td><img height="41" width="163" src="'.base_url().'img/articulos/'.$row->ar_imagen.'"/></td>
											<td><input size="10" value="'.$row->dc_cantidad.'" type="text" class="javier" name="'.$row->dc_id.'" id="'.$row->dc_id.'"/></td>
											<td>'.anchor('usuario/cotizacion/eliminar/'.$row->dc_id, 'eliminar', 'class="confirm" title="¿Desea eliminar este articulo?"').'</td>
											</tr>
          ';
        }
		
				$result .= '<tr><td colspan="4"><input type="submit" name="enviar" id="enviar" value="Enviar" class="boton"></td></tr>
				
				</table>';
				
      }
    }
    return $result;
  }
	
}

/* End of file categoria_model.php */
/* Location: ./system/application/model/categoria_model.php */