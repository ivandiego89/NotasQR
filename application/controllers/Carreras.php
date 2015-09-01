<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Carreras extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('model_carreras');
        $this->load->model('model_facultad');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $keyword = '';
        $this->load->library('pagination');

        $config['base_url'] = base_url() . 'carreras/index/';
        $config['total_rows'] = $this->model_carreras->total_rows();
        $config['per_page'] = 10;
        $config['uri_segment'] = 3;
        $config['suffix'] = '.html';
        $config['first_url'] = base_url() . 'carreras.html';
        $this->pagination->initialize($config);

        $start = $this->uri->segment(3, 0);
        $carreras = $this->model_carreras->index_limit($config['per_page'], $start);

        $data = array(
            'carreras_data' => $carreras,
            'keyword' => $keyword,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );


        $this->load->view('view_carreras', $data);
    }

    public function search()
    {
        $keyword = $this->uri->segment(3, $this->input->post('keyword', true));
        $this->load->library('pagination');

        if ($this->uri->segment(2) == 'search') {
            $config['base_url'] = base_url() . 'carreras/search/' . $keyword;
        } else {
            $config['base_url'] = base_url() . 'carreras/index/';
        }

        $config['total_rows'] = $this->model_carreras->search_total_rows($keyword);
        $config['per_page'] = 10;
        $config['uri_segment'] = 4;
        $config['suffix'] = '.html';
        $config['first_url'] = base_url() . 'carreras/search/' . $keyword . '.html';
        $this->pagination->initialize($config);

        $start = $this->uri->segment(4, 0);
        $carreras = $this->model_carreras->search_index_limit($config['per_page'], $start, $keyword);

        $data = array(
            'carreras_data' => $carreras,
            'keyword' => $keyword,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->load->view('view_carreras', $data);
    }

    public function nuevo()
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('carreras/guardar'),
            'CODIGO_CARRERA' => set_value('CODIGO_CARRERA'),
            'NOMBRE_CARRERA' => set_value('NOMBRE_CARRERA'),
            'FACULTAD' => set_value('FACULTAD'),
        );

        $data['facultades'] = $this->model_facultad->get_all();

        $this->load->view('view_carreras_form', $data);
    }

    public function guardar($id = null)
    {
        $this->_rules();

        $action = $id ? "guardar" : "nuevo";

        if ($this->form_validation->run() == false) {
            if ($action == 'nuevo') {
                $this->nuevo();
            } else {
                $this->editar($id);
            }

        } else {
            $data = array(
                'NOMBRE_CARRERA' => $this->input->post('NOMBRE_CARRERA', true),
                'FACULTAD' => $this->input->post('FACULTAD', true),
            );

            if ($action == 'nuevo') {
                $this->model_carreras->insert($data);
                $this->session->set_flashdata('message', 'Se añadió la carrera satisfactoriamente');
                redirect(site_url('carreras'));
            } else {
                $this->model_carreras->update($id, $data);
                $this->session->set_flashdata('message', 'Se actualizó');
                redirect(site_url('carreras'));
            }

        }
    }

    public function editar($id)
    {
        $row = $this->model_carreras->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('carreras/guardar/' . $id),
                'CODIGO_CARRERA' => set_value('CODIGO_CARRERA', $row->CODIGO_CARRERA),
                'NOMBRE_CARRERA' => set_value('NOMBRE_CARRERA', $row->NOMBRE_CARRERA),
                'FACULTAD' => set_value('FACULTAD', $row->FACULTAD),
            );
            $data['facultades'] = $this->model_facultad->get_all();
            $this->load->view('view_carreras_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('carreras'));
        }
    }

   
    public function elminar($id)
    {
        $row = $this->model_carreras->get_by_id($id);

        if ($row) {
            $this->model_carreras->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('carreras'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('carreras'));
        }
    }

    public function _rules()
    {
        $this->form_validation->set_rules('NOMBRE_CARRERA', ' ', 'trim|required');
        $this->form_validation->set_rules('FACULTAD', ' ', 'trim|required');

        $this->form_validation->set_rules('CODIGO_CARRERA', 'CODIGO_CARRERA', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "carreras.xls";
        $judul = "carreras";
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
        xlsWriteLabel($tablehead, $kolomhead++, "NOMBRE_CARRERA");
        xlsWriteLabel($tablehead, $kolomhead++, "FACULTAD");

        foreach ($this->model_carreras->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
            xlsWriteLabel($tablebody, $kolombody++, $data->NOMBRE_CARRERA);
            xlsWriteLabel($tablebody, $kolombody++, $data->FACULTAD);

            $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

};

/* End of file Carreras.php */
/* Location: ./application/controllers/Carreras.php */
