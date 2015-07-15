<?php

class Categorias_model extends Model {

    function __construct() {
        parent::Model();
    }

    function get_cat($id) {
        $qry = $this->db->from('wb_categoria')
                ->where('cat_id', $id)
                ->get();

        $res = '';
        if ($qry->num_rows() > 0) {
            $res = $qry->result();
        }
        return $res;
    }

    function update_cat($cat, $id) {
        if ($this->db->update('wb_categoria', $cat, "cat_id = {$id}"))
            return 'La Categoria con el ID: ' . $id . ' fue actualizado correctamente';
    }

    function delete_cat($id) {
        if ($this->db->where('cat_id', $id)->delete('wb_categoria'))
            return 'La Categoria con el ID: ' . $id . ' fue eliminado correctamente';
    }

    function categoria_selected($id) {
        $qry = $this->db->from('wb_categoria')
                ->get();

        $res = '<select id="categoria" name="categoria">';
        if ($qry->num_rows() > 0) {
            foreach ($qry->result() as $row) {
                if ($row->cat_id == $id) {
                    $res .= '<option id="' . $row->cat_id . '" value="' . $row->cat_id . '" selected>' . $row->cat_nombre . '</option>' . '<br/>';
                } else {
                    $res .= '<option id="' . $row->cat_id . '" value="' . $row->cat_id . '">' . $row->cat_nombre . '</option>' . '<br/>';
                }
            }
            $res .= '</select>';
        }

        return $res;
    }

    function count_all_categorias() {
        $qry = $this->db->select('cat_id')
                ->from('wb_categoria')
                ->count_all_results();
        return $qry;
    }

    function get_all_categorias($items, $offset, $html = TRUE) {
        $qry = $this->db->select('cat_id,cat_nombre,ta_nombre,cat_ta_id')
                ->from('wb_categoria')
                ->join('wb_tipo_articulo', 'wb_tipo_articulo.ta_id = wb_categoria.cat_ta_id', 'inner')
                ->order_by('cat_id', 'DESC')
                ->limit($items, $offset)
                ->get();
        if (!$html) {
            $result = $qry->result();
        } else {
            $result = '';
            if ($qry->num_rows() > 0) {
                foreach ($qry->result() as $row) {
                    $result .= '<tr>
                                    <td>' . $row->cat_nombre . '</td>
                                    <td>' . $row->ta_nombre . '</td>
                                    <td>' . anchor('administrador/categorias/editar/' . $row->cat_id . '/' . $row->cat_ta_id, 'editar') . '</td>
                                    <td>' . anchor('administrador/categorias/eliminar/' . $row->cat_id, 'eliminar', 'class="confirm" title="¿Desea elimminar esta categoria?"') . '</td>
                                </tr>';
                }
            }
        }
        return $result;
    }

    function cat_by_tipoart($id, $html = TRUE) {

        $query = $this->db->from('wb_categoria')
                ->where('cat_ta_id', $id)
                ->get();
        $resultado = '';

        $resultado = '<select name="categoria" id="categoria" class="celda02_formulario">' . "\n";
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $resultado .= '<option value="' . $row->cat_id . '">' . utf8_encode($row->cat_nombre) . '</option>' . "\n";
            }
        }
        $resultado .= '</select>' . "\n";

        return $resultado;
    }

    function get_categorias($html = TRUE) {
        $qry = $this->db->select('cat_id, cat_titulo')
                ->from('wb_categoria')
                ->get();
        if (!$html) {
            $result = $qry->result();
        } else {
            $result = array();
            if ($qry->num_rows() > 0) {
                foreach ($qry->result() as $row) {
                    $result[$row->cat_id] = $row->cat_titulo;
                }
            }
        }
        return $result;
    }

    function insert_categoria($categoria) {
        if ($this->db->insert('wb_categoria', $categoria))
            return 'La categoria fue insertada correctamente';
    }

    // function get_voidcat()
    // {
    // $res = '<select id="categoria" name="categoria">
    // <option>Seleccione Tipo</option>
    // </select>';
    // return $res;
    // }
}

/* End of file categoria_model.php */
/* Location: ./system/application/model/categoria_model.php */