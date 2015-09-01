<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Model_docentes extends CI_Model
{

    public $table = 'docentes';
    public $id = 'CODIGO_DOCENTE';
    public $order = 'DESC';
    public $relational_tables = array('asignar_cursos'=>'docente_asignatura');

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
        $this->db->like('CODIGO_DOCENTE', $keyword);
	$this->db->or_like('NOMBRE_DOCENTE', $keyword);
	$this->db->or_like('AP_DOCENTE', $keyword);
	$this->db->or_like('AM_DOCENTE', $keyword);
	$this->db->or_like('DIRECCION', $keyword);
	$this->db->or_like('TELEFONO', $keyword);
	$this->db->or_like('SEXO', $keyword);
	$this->db->or_like('DNI', $keyword);
	$this->db->or_like('EMAIL', $keyword);
	$this->db->or_like('FECHA_INGRESO', $keyword);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get search data with limit
    function search_index_limit($limit, $start = 0, $keyword = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('CODIGO_DOCENTE', $keyword);
	$this->db->or_like('NOMBRE_DOCENTE', $keyword);
	$this->db->or_like('AP_DOCENTE', $keyword);
	$this->db->or_like('AM_DOCENTE', $keyword);
	$this->db->or_like('DIRECCION', $keyword);
	$this->db->or_like('TELEFONO', $keyword);
	$this->db->or_like('SEXO', $keyword);
	$this->db->or_like('DNI', $keyword);
	$this->db->or_like('EMAIL', $keyword);
	$this->db->or_like('FECHA_INGRESO', $keyword);
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

    function fullname($row){
        return $row->NOMBRE_DOCENTE . " " . $row->AP_DOCENTE . " " . $row->AM_DOCENTE;
    }

    function asignar_curso($data){
        $this->db->insert($this->relational_tables['asignar_cursos'],$data);
    }

    function get_cursos_asignados_por_carrera($docente,$carrera,$semestre)
    {
        $this->load->model('model_asignaturas');
        return $this->model_asignaturas->get_by_docente($docente,$carrera,$semestre);
    }
}

/* End of file Model_docentes.php */
/* Location: ./application/models/Model_docentes.php */