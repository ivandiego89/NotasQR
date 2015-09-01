<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Model_alumno_asignatura extends CI_Model
{

    public $table = 'alumno_asignatura';
    public $id = 'CODIGO_MATRICULA';
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
        $this->db->like('CODIGO_MATRICULA', $keyword);
	$this->db->or_like('SEMESTRE', $keyword);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get search data with limit
    function search_index_limit($limit, $start = 0, $keyword = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('CODIGO_MATRICULA', $keyword);
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

    function set_semestre($semestre){
        $this->db->where('SEMESTRE',$semestre);
        return $this;
    }

    function get_alumnos_by_asignatura($asignatura){
        $this->db->select('alumnos.*');
        $this->db->join('alumnos','alumnos.CODIGO_ALUMNO = alumno_asignatura.CODIGO_ALUMNO');
        $this->db->where('CODIGO_ASIGNATURA',$asignatura);
        return $this->db->get($this->table)->result();
    }

    function get_alumnos_by_asignatura_with_notas($asignatura,$semestre){
        $this->db->select("alumno_asignatura.CODIGO_ALUMNO, CONCAT(alumnos.APELLIDO_PATERNO,' ', alumnos.APELLIDO_MATERNO, ' ', alumnos.NOMBRE_ALUMNO) as NOMBRE_COMPLETO, notas.PRIMER_PARCIAL, notas.SEGUNDA_PARCIAL, notas.NOTA_FINAL",false);
        $this->db->join('alumnos','alumnos.CODIGO_ALUMNO = alumno_asignatura.CODIGO_ALUMNO','inner');
        $this->db->join('notas',"notas.CODIGO_ASIGNATURA=alumno_asignatura.CODIGO_ASIGNATURA AND notas.SEMESTRE = alumno_asignatura.SEMESTRE AND notas.CODIGO_ALUMNO=alumno_asignatura.CODIGO_ALUMNO",'left');
        $this->db->order_by('alumnos.APELLIDO_PATERNO', 'ASC');
        $this->db->where('alumno_asignatura.CODIGO_ASIGNATURA',$asignatura);
        $this->db->where('alumno_asignatura.SEMESTRE',$semestre);

        return $this->db->get($this->table)->result();
    }
}

/* End of file Model_curso_alumno.php */
/* Location: ./application/models/Model_curso_alumno.php */