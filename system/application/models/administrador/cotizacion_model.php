<?php
class Cotizacion_model extends Model {

	function __construct()
	{
		parent::Model();
	}
	function get_detalle($id)
	{
	    $qry = $this->db->select('wb_cotizacion.cot_id,wb_articulo.ar_descripcion,wb_detalle_cotizacion.dc_cantidad')
						->from('wb_articulo')
						->where('wb_cotizacion.cot_id',$id)
								->join('wb_detalle_cotizacion','wb_detalle_cotizacion.dc_ar_id = wb_articulo.ar_id','inner')
								->join('wb_cotizacion','wb_cotizacion.cot_id = wb_detalle_cotizacion.dc_cot_id','inner')
                ->get();
			
      $result = '';
      if($qry->num_rows() > 0)
      {
        foreach($qry->result() as $row)
        { 
          $result .= '<tr>
              <td>'.$row->cot_id.'</td>
							<td>'.$row->ar_descripcion.'</td>
							<td>'.$row->dc_cantidad.'</td>
            </tr>
          ';
        }
      }

    return $result;			
								
	}
	
	function delete_cotizacion($id)
	{
	    if($this->db->where('cot_id', $id)->delete('wb_cotizacion'))
			if($this->db->where('dc_cot_id', $id)->delete('wb_detalle_cotizacion'))
      return 'La cotizacion con el ID: '.$id.' fue eliminado correctamente';
	}
	
		function delete_sin_confirmar()
	{
			$qry = $this->db->select('cot_id,cot_fecha,cot_estado')
								->from('wb_cotizacion')
								->where('DATEDIFF(CURRENT_DATE, cot_fecha) >',0)
								->where('cot_estado',0)
                ->get();
								
      if($qry->num_rows() > 0)
      {
				//$row = $query->row();
				
        foreach($qry->result() as $row)
        { 
					$this->db->where('dc_cot_id',$row->cot_id)->delete('wb_detalle_cotizacion');
        }
				
				foreach($qry->result() as $row)
        { 
					$this->db->where('cot_id',$row->cot_id)->delete('wb_cotizacion');
        }
				//$this->db->where('cot_id',0)->delete('wb_cotizacion');
				
      }
			

	}
	
	
	  function count_all_cotizaciones()
  {
    $qry = $this->db->select('cot_id')
                    ->from('wb_cotizacion')
                    ->count_all_results();
    return $qry;
  }
	
	  function get_all_cotizaciones($items, $offset, $html=TRUE)
  {
    $qry = $this->db->select('cot_id,usu_email,cot_fecha')
						->from('wb_cotizacion')
								->join('wb_users','wb_users.usu_id = wb_cotizacion.cot_usu_id','inner')
								->where('cot_estado',1)
                ->order_by('cot_id','DESC')
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
							<td>'.$row->cot_id.'</td>
              <td>'.$row->usu_email.'</td>
							<td>'.$row->cot_fecha.'</td>
							 <td>'.anchor('administrador/cotizacion/detalle/'.$row->cot_id, 'Ver Detalle', '').'</td>
              <td>'.anchor('administrador/cotizacion/eliminar/'.$row->cot_id, 'eliminar', 'class="confirm" title="¿Desea eliminar esta cotizacion?"').'</td>
            </tr>
          ';
        }
      }
    }
    return $result;
  }
  
}

/* End of file categoria_model.php */
/* Location: ./system/application/model/categoria_model.php */