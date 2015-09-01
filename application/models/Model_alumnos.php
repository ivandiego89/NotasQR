<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Model_alumnos extends CI_Model
{

    public $table = 'alumnos';
    public $id = 'CODIGO_ALUMNO';
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
        $this->db->like('CODIGO_ALUMNO', $keyword);
	$this->db->or_like('NOMBRE_ALUMNO', $keyword);
	$this->db->or_like('APELLIDO_PATERNO', $keyword);
	$this->db->or_like('APELLIDO_MATERNO', $keyword);
	$this->db->or_like('EMAIL', $keyword);
	$this->db->or_like('TELEFONO', $keyword);
	$this->db->or_like('DIRECCION', $keyword);
	$this->db->or_like('SEXO', $keyword);
	$this->db->or_like('FECHA_NACIMIENTO', $keyword);
	$this->db->or_like('DNI', $keyword);
	$this->db->or_like('AÑO_INGRESO', $keyword);
	$this->db->or_like('SEMESTRE_INGRESO', $keyword);
	$this->db->or_like('CARRERA_PROFESIONAL', $keyword);
	$this->db->or_like('TURNO', $keyword);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get search data with limit
    function search_index_limit($limit, $start = 0, $keyword = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('CODIGO_ALUMNO', $keyword);
	$this->db->or_like('NOMBRE_ALUMNO', $keyword);
	$this->db->or_like('APELLIDO_PATERNO', $keyword);
	$this->db->or_like('APELLIDO_MATERNO', $keyword);
	$this->db->or_like('EMAIL', $keyword);
	$this->db->or_like('TELEFONO', $keyword);
	$this->db->or_like('DIRECCION', $keyword);
	$this->db->or_like('SEXO', $keyword);
	$this->db->or_like('FECHA_NACIMIENTO', $keyword);
	$this->db->or_like('DNI', $keyword);
	$this->db->or_like('AÑO_INGRESO', $keyword);
	$this->db->or_like('SEMESTRE_INGRESO', $keyword);
	$this->db->or_like('CARRERA_PROFESIONAL', $keyword);
	$this->db->or_like('TURNO', $keyword);
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
        return $row->NOMBRE_ALUMNO . " " . $row->APELLIDO_PATERNO . " " . $row->APELLIDO_MATERNO;
    }

    function get_by_semestre_asignatura($semestre,$asignatura){
        $this->load->model('model_alumno_asignatura');
        return $this->model_alumno_asignatura->set_semestre($semestre)->get_alumnos_by_asignatura($asignatura);
    }

    function update_notas($alumno_id, $asignatura, $semestre, $data){
        $this->load->model('model_notas');
        $this->model_notas->update_by_asignatura($alumno_id, $asignatura, $semestre, $data);
    }

    function insert_notas($data){
        $this->load->model('model_notas');
        $this->model_notas->insert($data);
    }

    function get_by_asignatura_with_notas($asignatura,$semestre=''){
        $this->load->model('model_alumno_asignatura');
        return $this->model_alumno_asignatura->get_alumnos_by_asignatura_with_notas($asignatura,$semestre);
    }

    function get_by_id_with_carrera($id){
        $this->db->select('alumnos.*, carreras.NOMBRE_CARRERA');
        $this->db->join('carreras','carreras.CODIGO_CARRERA =alumnos.CARRERA_PROFESIONAL','inner');
        $this->db->where($this->id,$id);
        return $this->db->get($this->table)->row();
    }   

    function get_by_token_with_carrera($token){
        $this->db->select('alumnos.*, carreras.NOMBRE_CARRERA, alumno_tokens.SEMESTRE');
        $this->db->join('carreras','carreras.CODIGO_CARRERA =alumnos.CARRERA_PROFESIONAL','inner');
        $this->db->join('alumno_tokens','alumno_tokens.CODIGO_ALUMNO = alumnos.CODIGO_ALUMNO','inner');
        $this->db->where('alumno_tokens.TOKEN',$token);
        return $this->db->get($this->table)->row();
    }

    function create_token($data){
        return $this->db->insert('alumno_tokens',$data);
    }

    function get_token($alumno,$semestre){
        $this->db->where('CODIGO_ALUMNO',$alumno);
        $this->db->where('SEMESTRE',$semestre);
        return $this->db->get('alumno_tokens')->row();
    }

}

/* End of file Model_alumnos.php */
/* Location: ./application/models/Model_alumnos.php */
