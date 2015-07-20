<?php

class Articulo_model extends Model {

    function __construct() {
        parent::Model();
        $this->_art = 'wb_articulo';
        $this->_cat = 'wb_categoria';
        $this->_col = 'wb_color';
    }

    function count_all_files() {
        $qry = $this->db->from($this->_art)
                ->count_all_results();
        return $qry;
    }

    function count_all_filtro($filtro) {
        $qry = $this->db->from($this->_art)
                ->like('art_id', $filtro['id'])
                ->like('art_orden', $filtro['orden'])
                ->like('art_codigo', $filtro['codigo'])
                ->like('art_tar_id', $filtro['tipo'])
                ->like('art_cat_id', $filtro['categoria'])
                ->like('art_col_id', $filtro['color'])
                ->count_all_results();
        return $qry;
    }

    function get_all_files($lmt, $ind, $html = TRUE) {
        $qry = $this->db->order_by('art_id', 'DESC')
                ->limit($lmt, $ind)
                ->get($this->_art);
        $rs = ($html) ? $this->listar($qry) : $qry->result();
        return $rs;
    }

    function get_all_filtro($filtro, $lmt, $ind, $html = TRUE) {
        $sel = $this->db->like('art_id', $filtro['id'])
                ->like('art_orden', $filtro['orden'])
                ->like('art_codigo', $filtro['codigo'])
                ->order_by('art_id', 'DESC')
                ->limit($lmt, $ind);
        if (!empty($filtro['tipo'])) {
            $sel->where('art_tar_id', $filtro['tipo']);
        }

        if (!empty($filtro['categoria'])) {
            $sel->where('art_cat_id', $filtro['categoria']);
        }
        if (!empty($filtro['color'])) {
            $sel->where('art_col_id', $filtro['color']);
        }
        $qry = $sel->get($this->_art);
        $rs = ($html) ? $this->listar($qry) : $qry->result();
        return $rs;
    }

    function listar($qry) {
        $rs = '';
        if ($qry->num_rows() > 0) {
            $e = array(1 => 'deshabilitar', 2 => 'habilitar');
            foreach ($qry->result() as $r) {
                $t = $this->_get_cat($r->art_tar_id);
                $c = $this->_get_cat($r->art_cat_id);
                $s = $this->_get_col($r->art_col_id);
                // $es = isset($s->col_nombre)?$s->col_nombre:'<i>No definido</i>';
                $rs .= '
        <tr>
          <td class="c">' . $r->art_id . '</td>
          <td class="c">' . $r->art_orden . '</td>
          <td>' . $r->art_codigo . '</td>
          <td>' . $t->cat_nombre . '</td>
          <td>' . $c->cat_nombre . '</td>
          <td>' . $s->col_nombre . '</td>
          <td>
            ' . anchor('administrador/articulo/editar/' . $r->art_id, 'editar') . ' | 
            ' . anchor('administrador/articulo/eliminar/' . $r->art_id, 'eliminar', 'class="confirm" title="Desea eliminar este articulo ?"') . ' | 
            ' . anchor('administrador/articulo/' . $e[$r->art_estado] . '/' . $r->art_id, $e[$r->art_estado], 'class="confirm" title="Desea ' . $e[$r->art_estado] . ' este articulo"') . '
          </td>
        </tr>';
            }
        }
        return $rs;
    }

    function get_file($cue) {
        $qry = $this->db->where('art_id', $cue)
                ->get($this->_art);
        return $qry->row_array();
    }

    function insert_file($file) {
        return $this->db->insert($this->_art, $file);
    }

    function update_file($cue, $data) {
        return $this->db->where('art_id', $cue)
                        ->update($this->_art, $data);
    }

    function delete_file($cue) {
        return $this->db->where('art_id', $cue)
                        ->delete($this->_art);
    }

    /* ---------------------------------------------------------------------------------------------- */
    /* OTRAS FUNCIONES */
    /* ---------------------------------------------------------------------------------------------- */

    function _get_cat($id) {
        $qry = $this->db->where('cat_id', $id)
                ->get($this->_cat);
        return $qry->row();
    }

    function _get_col($id) {
        $qry = $this->db->where('col_id', $id)
                ->get($this->_col);
        return $qry->row();
    }

}

/* End of file codigo_model.php */
/* Location: ./system/application/model/codigo_model.php */