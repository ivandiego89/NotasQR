<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Model_notas extends CI_Model
{

    public $table = 'notas';
    public $id = '';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // get all
    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }
    
    // get total rows
    function total_rows() {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit
    function index_limit($limit, $start = 0) {
        $this->db->order_by($this->id, $this->order);
        $this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }
    
    // get search total rows
    function search_total_rows($keyword = NULL) {
        $this->db->like('', $keyword);
	$this->db->or_like('CODIGO_NOTA', $keyword);
	$this->db->or_like('CODIGO_ALUMNO', $keyword);
	$this->db->or_like('CODIGO_ASIGNATURA', $keyword);
	$this->db->or_like('PRIMER_PARCIAL', $keyword);
	$this->db->or_like('SEGUNDA_PARCIAL', $keyword);
	$this->db->or_like('NOTA_FINAL', $keyword);
	$this->db->or_like('FECHA_ING_NOTAS', $keyword);
	$this->db->or_like('SEMESTRE', $keyword);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get search data with limit
    function search_index_limit($limit, $start = 0, $keyword = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('', $keyword);
	$this->db->or_like('CODIGO_NOTA', $keyword);
	$this->db->or_like('CODIGO_ALUMNO', $keyword);
	$this->db->or_like('CODIGO_ASIGNATURA', $keyword);
	$this->db->or_like('PRIMER_PARCIAL', $keyword);
	$this->db->or_like('SEGUNDA_PARCIAL', $keyword);
	$this->db->or_like('NOTA_FINAL', $keyword);
	$this->db->or_like('FECHA_ING_NOTAS', $keyword);
	$this->db->or_like('SEMESTRE', $keyword);
	$this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    // update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }

    function get_by_semestre_asignatura_with_alumnos($asignatura,$semestre){
        $this->db->select("CONCAT(alumnos.APELLIDO_PATERNO,' ', alumnos.APELsLIDO_MATERNO, ' ', alumnos.NOMBRE_ALUMNO ) as NOMBRE_COMPLETO, notas.* ", false);
        $this->db->join('alumnos','alumnos.CODIGO_ALUMNO = notas.CODIGO_ALUMNO', 'lefts');
        $this->db->where('CODIGO_ASIGNATURA',$asignatura);
        $this->db->get($this->table)->result();
    }

    function update_by_asignatura($id, $asignatura, $semestre, $data)
    {
        $this->db->where('CODIGO_ALUMNO', $id);
        $this->db->where('CODIGO_ASIGNATURA', $asignatura);
        $this->db->where('SEMESTRE', $semestre);
        $this->db->update($this->table, $data);
    }
    

    function get_estadisticas($asignatura,$semestre){
        $this->db->select("COUNT(CASE WHEN NOTA_FINAL >= 15 THEN 1 END ) as 'Aprobados', COUNT(CASE WHEN NOTA_FINAL < 15 THEN 1 END ) as 'Desaprovados'",false);
        $this->db->where('CODIGO_ASIGNATURA',$asignatura);
        $this->db->where('SEMESTRE',$semestre);
        return $this->db->get($this->table)->row();

    }

}

/* End of file Model_notas.php */
/* Location: ./application/models/Model_notas.php */