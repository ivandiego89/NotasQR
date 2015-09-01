<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Matriculas extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('model_alumnos');
        $this->load->model('model_matriculas');
        $this->load->model('model_carreras');
        $this->load->model('model_alumno_asignatura');
        $this->load->model('model_asignaturas');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $keyword = '';
        $this->load->library('pagination');

        $config['base_url'] = base_url() . 'matriculas/index/';
        $config['total_rows'] = $this->model_matriculas->total_rows();
        $config['per_page'] = 10;
        $config['uri_segment'] = 3;
        $config['suffix'] = '.html';
        $config['first_url'] = base_url() . 'matriculas.html';
        $this->pagination->initialize($config);

        $start = $this->uri->segment(3, 0);
        $matriculas = $this->model_matriculas->index_limit($config['per_page'], $start);

        $data = array(
            'matriculas_data' => $matriculas,
            'keyword' => $keyword,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );

        $this->load->view('matriculas_list', $data);
    }

    public function search()
    {
        $keyword = $this->uri->segment(3, $this->input->post('keyword', true));
        $this->load->library('pagination');

        if ($this->uri->segment(2) == 'search') {
            $config['base_url'] = base_url() . 'matriculas/search/' . $keyword;
        } else {
            $config['base_url'] = base_url() . 'matriculas/index/';
        }

        $config['total_rows'] = $this->model_matriculas->search_total_rows($keyword);
        $config['per_page'] = 10;
        $config['uri_segment'] = 4;
        $config['suffix'] = '.html';
        $config['first_url'] = base_url() . 'matriculas/search/' . $keyword . '.html';
        $this->pagination->initialize($config);

        $start = $this->uri->segment(4, 0);
        $matriculas = $this->model_matriculas->search_index_limit($config['per_page'], $start, $keyword);

        $data = array(
            'matriculas_data' => $matriculas,
            'keyword' => $keyword,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->load->view('matriculas_list', $data);
    }

    public function read($id)
    {
        $row = $this->model_matriculas->get_by_id($id);
        if ($row) {
            $data = array(
                'CODIGO_MATRICULA' => $row->CODIGO_MATRICULA,
                'CODIGO_ALUMNO' => $row->CODIGO_ALUMNO,
                'FECHA_MATRICULA' => $row->FECHA_MATRICULA,
                'CODIGO_CARRERA' => $row->CODIGO_CARRERA,
            );
            $this->load->view('matriculas_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('matriculas'));
        }
    }

    public function nuevo()
    {

        $button = 'Buscar';

        $data = array(
            'button' => $button,
            'action' => '',
            'CODIGO_MATRICULA' => set_value('CODIGO_MATRICULA'),
            'CODIGO_ALUMNO' => set_value('CODIGO_ALUMNO'),
            'FECHA_MATRICULA' => set_value('FECHA_MATRICULA'),
            'CODIGO_CARRERA' => set_value('CODIGO_CARRERA'),
            'SEMESTRE' => set_value('SEMESTRE'),
            'ASIGNATURA_SEMESTRE' => set_value('ASIGNATURA_SEMESTRE'),
        );

        if ($this->input->post('CODIGO_ALUMNO')) {
            $button = 'Continuar';
            $data['alumno'] = $this->model_alumnos->get_by_id($this->input->post('CODIGO_ALUMNO'));
            $data['carrera_profesional'] = $this->model_carreras->get_by_id($data['alumno']->CARRERA_PROFESIONAL);
        }

        $asig_semestre = $this->input->post('ASIGNATURA_SEMESTRE');

        if (!empty($asig_semestre)) {
            $data['asignaturas'] = $this->model_asignaturas->find_by_cycle($asig_semestre);
        }

        if ($this->input->post('ACTION')) {
            $this->procesar();
        }

        $data['cursos_matriculados'] = $this->input->post('_asignaturas') ?: [];

        //$data['alumno'];

        $this->load->view('view_matriculas_form', $data);
    }

    public function procesar()
    {
        $this->_rules();

        if ($this->form_validation->run() == false) {            
            //$this->nuevo();
        } else {

            $data = array(
                'CODIGO_ALUMNO' => $this->input->post('CODIGO_ALUMNO', true),
                'FECHA_MATRICULA' => time(),
                'CODIGO_CARRERA' => $this->input->post('CODIGO_CARRERA', true),
                'SEMESTRE' => $this->input->post('SEMESTRE', true),
            );

            $matricula_id = $this->model_matriculas->insert($data);

            foreach ($this->input->post('_asignaturas') as $_asignatura) {
                $data = array(
                    'CODIGO_MATRICULA' => $matricula_id,
                    'CODIGO_ALUMNO' => $this->input->post('CODIGO_ALUMNO', true),
                    'CODIGO_ASIGNATURA' => $_asignatura,
                    'SEMESTRE' => $this->input->post('CODIGO_CARRERA', true),
                );
                $this->model_alumno_asignatura->insert($data);
            }

            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('matriculas/nuevo'));
        }
    }

    

    public function update($id)
    {
        $row = $this->model_matriculas->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('matriculas/update_action'),
                'CODIGO_MATRICULA' => set_value('CODIGO_MATRICULA', $row->CODIGO_MATRICULA),
                'CODIGO_ALUMNO' => set_value('CODIGO_ALUMNO', $row->CODIGO_ALUMNO),
                'FECHA_MATRICULA' => set_value('FECHA_MATRICULA', $row->FECHA_MATRICULA),
                'CODIGO_CARRERA' => set_value('CODIGO_CARRERA', $row->CODIGO_CARRERA),
            );
            $this->load->view('matriculas_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('matriculas'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == false) {
            $this->update($this->input->post('CODIGO_MATRICULA', true));
        } else {
            $data = array(
                'CODIGO_ALUMNO' => $this->input->post('CODIGO_ALUMNO', true),
                'FECHA_MATRICULA' => $this->input->post('FECHA_MATRICULA', true),
                'CODIGO_CARRERA' => $this->input->post('CODIGO_CARRERA', true),
            );

            $this->model_matriculas->update($this->input->post('CODIGO_MATRICULA', true), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('matriculas'));
        }
    }

    public function delete($id)
    {
        $row = $this->model_matriculas->get_by_id($id);

        if ($row) {
            $this->model_matriculas->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('matriculas'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('matriculas'));
        }
    }

    public function _rules()
    {
        $this->form_validation->set_rules('CODIGO_ALUMNO', ' ', 'trim|required');
        $this->form_validation->set_rules('FECHA_MATRICULA', ' ', 'trim|required');
        $this->form_validation->set_rules('CODIGO_CARRERA', ' ', 'trim|required|numeric');
        $this->form_validation->set_rules('_asignaturas[]', 'Asignaturas', 'callback_has_asignatures_selected');

        $this->form_validation->set_rules('CODIGO_MATRICULA', 'CODIGO_MATRICULA', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    function has_asignatures_selected(){

        if(count($this->input->post('_asignaturas')) == 0){
            $this->form_validation->set_message('has_asignatures_selected', 'Por favor seleccionar los cursos a los cuales se matriculará.');
            return false;    
        }

        return true;
    }

};

/* End of file Matriculas.php */
/* Location: ./application/controllers/Matriculas.php */
