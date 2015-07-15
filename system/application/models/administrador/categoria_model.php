<?php

class Categoria_model extends Model {

    function __construct() {
        parent::Model();
        $this->_cat = 'wb_categoria';
    }

    function count_all_files() {
        $qry = $this->db->from($this->_cat)
                ->where('cat_padre >', 0)
                ->count_all_results();
        return $qry;
    }

    function get_all_files($lmt, $ind, $html = TRUE) {
        $qry = $this->db->order_by('cat_id', 'DESC')
                ->where('cat_padre >', 0)
                ->limit($lmt, $ind)
                ->get($this->_cat);
        $rs = ($html) ? $this->listar($qry) : $qry->result();
        return $rs;
    }

    function listar($qry) {
        $rs = '';
        if ($qry->num_rows() > 0) {
            $e = array(1 => 'deshabilitar', 2 => 'habilitar');
            foreach ($qry->result() as $r) {
                $p = $this->get_file($r->cat_padre);
                $rs .= '
        <tr>
          <td class="c">' . $r->cat_id . '</td>
          <td>' . $p['cat_nombre'] . '</td>
          <td>' . $r->cat_nombre . '</td>
          <td>
            ' . anchor('administrador/categoria/editar/' . $r->cat_id, 'editar') . ' | 
            ' . anchor('administrador/categoria/eliminar/' . $r->cat_id, 'eliminar', 'class="confirm" title="Desea eliminar este categoria ?"') . ' | 
            ' . anchor('administrador/categoria/' . $e[$r->cat_estado] . '/' . $r->cat_id, $e[$r->cat_estado], 'class="confirm" title="Desea ' . $e[$r->cat_estado] . ' este categoria"') . '
          </td>
        </tr>';
            }
        }
        return $rs;
    }

    function get_file($cue) {
        $qry = $this->db->where('cat_id', $cue)
                ->get($this->_cat);
        return $qry->row_array();
    }

    function insert_file($file) {
        return $this->db->insert($this->_cat, $file);
    }

    function update_file($cue, $data) {
        return $this->db->where('cat_id', $cue)
                        ->update($this->_cat, $data);
    }

    function delete_file($cue) {
        return $this->db->where('cat_id', $cue)
                        ->delete($this->_cat);
    }

    /* ---------------------------------------------------------------------------------------------- */
    /* JAVASCRIPT FUNCTIONS */
    /* ---------------------------------------------------------------------------------------------- */

    function get_all_array($p = 0) {
        $qry = $this->db->where('cat_padre', $p)
                ->get($this->_cat);
        $rs = array('all' => 'Todos');
        if ($qry->num_rows() > 0) {
            foreach ($qry->result() as $r)
                $rs[$r->cat_id] = $r->cat_nombre;
        }
        return $rs;
    }

    function get_child_node($id) {
        $qry = $this->db->from($this->_cat)
                ->where('cat_padre', $id)
                ->get();
        $rs = '<option value="all">Todos</option>';
        if ($id !== 'all')
            foreach ($qry->result() as $r) {
                $rs .= '<option value="' . $r->cat_id . '">' . utf8_encode($r->cat_nombre) . '</option>';
            }
        return $rs;
    }

    /* ---------------------------------------------------------------------------------------------- */
}

/* End of file categoria_model.php */
/* Location: ./system/application/model/categoria_model.php */