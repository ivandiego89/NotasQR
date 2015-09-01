<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Model_asignaturas extends CI_Model
{

    public $table = 'asignaturas';
    public $id = 'CODIGO_ASIGNATURA';
    public $order = 'DESC';
    public $related_tables = array('docentes'=>'docente_asignatura');

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
        $this->db->like('CODIGO_ASIGNATURA', $keyword);
	$this->db->or_like('NOMBRE_ASIGNATURA', $keyword);
	$this->db->or_like('CATEGORIA', $keyword);
	$this->db->or_like('HORAS', $keyword);
	$this->db->or_like('CREDITOS', $keyword);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get search data with limit
    function search_index_limit($limit, $start = 0, $keyword = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('CODIGO_ASIGNATURA', $keyword);
	$this->db->or_like('NOMBRE_ASIGNATURA', $keyword);
	$this->db->or_like('CATEGORIA', $keyword);
	$this->db->or_like('HORAS', $keyword);
	$this->db->or_like('CREDITOS', $keyword);
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

    function find_by_cycle($ciclo){
        $this->db->where('ciclo',$ciclo);
        return $this->db->get($this->table)->result();
    }

    function get_by_docente($docente,$carrera, $semestre){
        $this->db->select('docente_asignatura.CODIGO_ASIGNATURA, asignaturas.NOMBRE_ASIGNATURA');
        $this->db->join('asignaturas','asignaturas.CODIGO_ASIGNATURA = docente_asignatura.CODIGO_ASIGNATURA','inner');
        $this->db->where('docente_asignatura.CODIGO_DOCENTE',$docente);        
        $this->db->where('docente_asignatura.CODIGO_CARRERA',$carrera);
        $this->db->where('docente_asignatura.SEMESTRE',$semestre);

        return $this->db->get($this->related_tables['docentes'])->result();
    }

    function get_by_alumno_with_notas($alumno,$semestre){
        $this->db->select("asignaturas.CODIGO_ASIGNATURA, asignaturas.NOMBRE_ASIGNATURA, asignaturas.CREDITOS, NOTA_FINAL");
        $this->db->join("alumno_asignatura",'alumno_asignatura.CODIGO_ASIGNATURA = asignaturas.CODIGO_ASIGNATURA');
        $this->db->join("notas",'notas.CODIGO_ASIGNATURA = alumno_asignatura.CODIGO_ASIGNATURA and notas.SEMESTRE = alumno_asignatura.SEMESTRE and notas.CODIGO_ALUMNO = alumno_asignatura.CODIGO_ALUMNO','left');
        $this->db->where('alumno_asignatura.CODIGO_ALUMNO',$alumno);
        $this->db->where('alumno_asignatura.SEMESTRE',$semestre);

        return $this->db->get($this->table)->result();

    }
}

/* End of file Model_asignaturas.php */
/* Location: ./application/models/Model_asignaturas.php */