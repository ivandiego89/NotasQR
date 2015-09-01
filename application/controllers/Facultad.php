<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Facultad extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('model_facultad');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $keyword = '';
        $this->load->library('pagination');

        $config['base_url'] = base_url() . 'facultad/index/';
        $config['total_rows'] = $this->model_facultad->total_rows();
        $config['per_page'] = 10;
        $config['uri_segment'] = 3;
        $config['suffix'] = '.html';
        $config['first_url'] = base_url() . 'facultad.html';
        $this->pagination->initialize($config);

        $start = $this->uri->segment(3, 0);
        $facultad = $this->model_facultad->index_limit($config['per_page'], $start);

        $data = array(
            'facultad_data' => $facultad,
            'keyword' => $keyword,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );

        $this->load->view('facultad_list', $data);
    }
    
    public function search() 
    {
        $keyword = $this->uri->segment(3, $this->input->post('keyword', TRUE));
        $this->load->library('pagination');
        
        if ($this->uri->segment(2)=='search') {
            $config['base_url'] = base_url() . 'facultad/search/' . $keyword;
        } else {
            $config['base_url'] = base_url() . 'facultad/index/';
        }

        $config['total_rows'] = $this->model_facultad->search_total_rows($keyword);
        $config['per_page'] = 10;
        $config['uri_segment'] = 4;
        $config['suffix'] = '.html';
        $config['first_url'] = base_url() . 'facultad/search/'.$keyword.'.html';
        $this->pagination->initialize($config);

        $start = $this->uri->segment(4, 0);
        $facultad = $this->model_facultad->search_index_limit($config['per_page'], $start, $keyword);

        $data = array(
            'facultad_data' => $facultad,
            'keyword' => $keyword,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->load->view('facultad_list', $data);
    }

    public function read($id) 
    {
        $row = $this->model_facultad->get_by_id($id);
        if ($row) {
            $data = array(
		'CODIGO_FACULTAD' => $row->CODIGO_FACULTAD,
		'NOMBRE_FACULTAD' => $row->NOMBRE_FACULTAD,
	    );
            $this->load->view('facultad_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('facultad'));
        }
    }
    
    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('facultad/create_action'),
	    'CODIGO_FACULTAD' => set_value('CODIGO_FACULTAD'),
	    'NOMBRE_FACULTAD' => set_value('NOMBRE_FACULTAD'),
	);
        $this->load->view('facultad_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'NOMBRE_FACULTAD' => $this->input->post('NOMBRE_FACULTAD',TRUE),
	    );

            $this->model_facultad->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('facultad'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->model_facultad->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('facultad/update_action'),
		'CODIGO_FACULTAD' => set_value('CODIGO_FACULTAD', $row->CODIGO_FACULTAD),
		'NOMBRE_FACULTAD' => set_value('NOMBRE_FACULTAD', $row->NOMBRE_FACULTAD),
	    );
            $this->load->view('facultad_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('facultad'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('CODIGO_FACULTAD', TRUE));
        } else {
            $data = array(
		'NOMBRE_FACULTAD' => $this->input->post('NOMBRE_FACULTAD',TRUE),
	    );

            $this->model_facultad->update($this->input->post('CODIGO_FACULTAD', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('facultad'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->model_facultad->get_by_id($id);

        if ($row) {
            $this->model_facultad->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('facultad'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('facultad'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('NOMBRE_FACULTAD', ' ', 'trim|required');

	$this->form_validation->set_rules('CODIGO_FACULTAD', 'CODIGO_FACULTAD', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "facultad.xls";
        $judul = "facultad";
        $tablehead = 2;
        $tablebody = 3;
        $nourut = 1;
        //penulisan header
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Disposition: attachment;filename=" . $namaFile . "");
        header("Content-Transfer-Encoding: binary ");

        xlsBOF();

        xlsWriteLabel(0, 0, $judul);

        $kolomhead = 0;
        xlsWriteLabel($tablehead, $kolomhead++, "no");
	xlsWriteLabel($tablehead, $kolomhead++, "NOMBRE_FACULTAD");

	foreach ($this->model_facultad->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->NOMBRE_FACULTAD);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

};

/* End of file Facultad.php */
/* Location: ./application/controllers/Facultad.php */