<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Curso_alumno extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('model_curso_alumno');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $keyword = '';
        $this->load->library('pagination');

        $config['base_url'] = base_url() . 'curso_alumno/index/';
        $config['total_rows'] = $this->model_curso_alumno->total_rows();
        $config['per_page'] = 10;
        $config['uri_segment'] = 3;
        $config['suffix'] = '.html';
        $config['first_url'] = base_url() . 'curso_alumno.html';
        $this->pagination->initialize($config);

        $start = $this->uri->segment(3, 0);
        $curso_alumno = $this->model_curso_alumno->index_limit($config['per_page'], $start);

        $data = array(
            'curso_alumno_data' => $curso_alumno,
            'keyword' => $keyword,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );

        $this->load->view('curso_alumno_list', $data);
    }
    
    public function search() 
    {
        $keyword = $this->uri->segment(3, $this->input->post('keyword', TRUE));
        $this->load->library('pagination');
        
        if ($this->uri->segment(2)=='search') {
            $config['base_url'] = base_url() . 'curso_alumno/search/' . $keyword;
        } else {
            $config['base_url'] = base_url() . 'curso_alumno/index/';
        }

        $config['total_rows'] = $this->model_curso_alumno->search_total_rows($keyword);
        $config['per_page'] = 10;
        $config['uri_segment'] = 4;
        $config['suffix'] = '.html';
        $config['first_url'] = base_url() . 'curso_alumno/search/'.$keyword.'.html';
        $this->pagination->initialize($config);

        $start = $this->uri->segment(4, 0);
        $curso_alumno = $this->model_curso_alumno->search_index_limit($config['per_page'], $start, $keyword);

        $data = array(
            'curso_alumno_data' => $curso_alumno,
            'keyword' => $keyword,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->load->view('curso_alumno_list', $data);
    }

    public function read($id) 
    {
        $row = $this->model_curso_alumno->get_by_id($id);
        if ($row) {
            $data = array(
		'CODIGO_MATRICULA' => $row->CODIGO_MATRICULA,
		'CODIGO_ALUMNO' => $row->CODIGO_ALUMNO,
		'CODIGO_ASIGNATURA' => $row->CODIGO_ASIGNATURA,
		'SEMESTRE' => $row->SEMESTRE,
	    );
            $this->load->view('curso_alumno_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('curso_alumno'));
        }
    }
    
    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('curso_alumno/create_action'),
	    'CODIGO_MATRICULA' => set_value('CODIGO_MATRICULA'),
	    'CODIGO_ALUMNO' => set_value('CODIGO_ALUMNO'),
	    'CODIGO_ASIGNATURA' => set_value('CODIGO_ASIGNATURA'),
	    'SEMESTRE' => set_value('SEMESTRE'),
	);
        $this->load->view('curso_alumno_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'SEMESTRE' => $this->input->post('SEMESTRE',TRUE),
	    );

            $this->model_curso_alumno->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('curso_alumno'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->model_curso_alumno->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('curso_alumno/update_action'),
		'CODIGO_MATRICULA' => set_value('CODIGO_MATRICULA', $row->CODIGO_MATRICULA),
		'CODIGO_ALUMNO' => set_value('CODIGO_ALUMNO', $row->CODIGO_ALUMNO),
		'CODIGO_ASIGNATURA' => set_value('CODIGO_ASIGNATURA', $row->CODIGO_ASIGNATURA),
		'SEMESTRE' => set_value('SEMESTRE', $row->SEMESTRE),
	    );
            $this->load->view('curso_alumno_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('curso_alumno'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('CODIGO_MATRICULA', TRUE));
        } else {
            $data = array(
		'SEMESTRE' => $this->input->post('SEMESTRE',TRUE),
	    );

            $this->model_curso_alumno->update($this->input->post('CODIGO_MATRICULA', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('curso_alumno'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->model_curso_alumno->get_by_id($id);

        if ($row) {
            $this->model_curso_alumno->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('curso_alumno'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('curso_alumno'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('SEMESTRE', ' ', 'trim|required');

	$this->form_validation->set_rules('CODIGO_MATRICULA', 'CODIGO_MATRICULA', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

};

/* End of file Curso_alumno.php */
/* Location: ./application/controllers/Curso_alumno.php */