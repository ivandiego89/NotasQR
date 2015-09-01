<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Asignaturas extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('model_asignaturas');
        $this->load->model('model_carreras');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $keyword = '';
        $this->load->library('pagination');

        $config['base_url'] = base_url() . 'asignaturas/index/';
        $config['total_rows'] = $this->model_asignaturas->total_rows();
        $config['per_page'] = 10;
        $config['uri_segment'] = 3;
        $config['suffix'] = '.html';
        $config['first_url'] = base_url() . 'asignaturas.html';
        $this->pagination->initialize($config);

        $start = $this->uri->segment(3, 0);
        $asignaturas = $this->model_asignaturas->index_limit($config['per_page'], $start);

        $data = array(
            'asignaturas_data' => $asignaturas,
            'keyword' => $keyword,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );

        $this->load->view('view_asignaturas', $data);
    }

    public function search()
    {
        $keyword = $this->uri->segment(3, $this->input->post('keyword', true));
        $this->load->library('pagination');

        if ($this->uri->segment(2) == 'search') {
            $config['base_url'] = base_url() . 'asignaturas/search/' . $keyword;
        } else {
            $config['base_url'] = base_url() . 'asignaturas/index/';
        }

        $config['total_rows'] = $this->model_asignaturas->search_total_rows($keyword);
        $config['per_page'] = 10;
        $config['uri_segment'] = 4;
        $config['suffix'] = '.html';
        $config['first_url'] = base_url() . 'asignaturas/search/' . $keyword . '.html';
        $this->pagination->initialize($config);

        $start = $this->uri->segment(4, 0);
        $asignaturas = $this->model_asignaturas->search_index_limit($config['per_page'], $start, $keyword);

        $data = array(
            'asignaturas_data' => $asignaturas,
            'keyword' => $keyword,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->load->view('view_asignaturas', $data);
    }

    public function read($id)
    {
        $row = $this->model_asignaturas->get_by_id($id);
        if ($row) {
            $data = array(
                'CODIGO_ASIGNATURA' => $row->CODIGO_ASIGNATURA,
                'NOMBRE_ASIGNATURA' => $row->NOMBRE_ASIGNATURA,
                'CATEGORIA' => $row->CATEGORIA,
                'HORAS' => $row->HORAS,
                'CREDITOS' => $row->CREDITOS,
            );
            $this->load->view('asignaturas_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('asignaturas'));
        }
    }

    public function nuevo()
    {
        $data = array(
            'button' => 'Guardar',
            'action' => site_url('asignaturas/guardar'),
            'CODIGO_ASIGNATURA' => set_value('CODIGO_ASIGNATURA'),
            'NOMBRE_ASIGNATURA' => set_value('NOMBRE_ASIGNATURA'),
            'CODIGO_CARRERA' => set_value('CODIGO_CARRERA'),
            'CATEGORIA' => set_value('CATEGORIA'),
            'HORAS' => set_value('HORAS'),
            'CREDITOS' => set_value('CREDITOS'),
        );

        $data['carreras'] = $this->model_carreras->get_all();
        $this->load->view('view_asignaturas_form', $data);
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
                'CODIGO_ASIGNATURA' => $this->input->post('CODIGO_ASIGNATURA', true),
                'NOMBRE_ASIGNATURA' => $this->input->post('NOMBRE_ASIGNATURA', true),
                'CODIGO_CARRERA' => $this->input->post('CODIGO_CARRERA', true),
                'CATEGORIA' => $this->input->post('CATEGORIA', true),
                'HORAS' => $this->input->post('HORAS', true),
                'CREDITOS' => $this->input->post('CREDITOS', true),
            );

            if ($action == 'nuevo') {
                $this->model_asignaturas->insert($data);
                $this->session->set_flashdata('message', 'Create Record Success');
                redirect(site_url('asignaturas'));
            } else {
                $this->model_asignaturas->update($id, $data);
                $this->session->set_flashdata('message', 'Se actualizó');
                redirect(site_url('asignaturas'));
            }

        }
    }

    public function editar($id)
    {
        $row = $this->model_asignaturas->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('asignaturas/guardar/'.$id),
                'CODIGO_ASIGNATURA' => set_value('CODIGO_ASIGNATURA', $row->CODIGO_ASIGNATURA),
                'CODIGO_CARRERA' => set_value('CODIGO_CARRERA', $row->CODIGO_CARRERA),
                'NOMBRE_ASIGNATURA' => set_value('NOMBRE_ASIGNATURA', $row->NOMBRE_ASIGNATURA),
                'CATEGORIA' => set_value('CATEGORIA', $row->CATEGORIA),
                'HORAS' => set_value('HORAS', $row->HORAS),
                'CREDITOS' => set_value('CREDITOS', $row->CREDITOS),
            );
            $data['carreras'] = $this->model_carreras->get_all();
            $this->load->view('view_asignaturas_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('asignaturas'));
        }
    }

    public function eliminar($id)
    {
        $row = $this->model_asignaturas->get_by_id($id);

        if ($row) {
            $this->model_asignaturas->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('asignaturas'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('asignaturas'));
        }
    }

    public function _rules()
    {
        $this->form_validation->set_rules('CODIGO_ASIGNATURA', ' ', 'trim|required');
        $this->form_validation->set_rules('NOMBRE_ASIGNATURA', ' ', 'trim|required');
        $this->form_validation->set_rules('CODIGO_CARRERA', ' ', 'trim|required|numeric');
        $this->form_validation->set_rules('CATEGORIA', ' ', 'trim|required');
        $this->form_validation->set_rules('HORAS', ' ', 'trim|required|numeric');
        $this->form_validation->set_rules('CREDITOS', ' ', 'trim|required|numeric');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "asignaturas.xls";
        $judul = "asignaturas";
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
        xlsWriteLabel($tablehead, $kolomhead++, "NOMBRE_ASIGNATURA");
        xlsWriteLabel($tablehead, $kolomhead++, "CATEGORIA");
        xlsWriteLabel($tablehead, $kolomhead++, "HORAS");
        xlsWriteLabel($tablehead, $kolomhead++, "CREDITOS");

        foreach ($this->model_asignaturas->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
            xlsWriteLabel($tablebody, $kolombody++, $data->NOMBRE_ASIGNATURA);
            xlsWriteLabel($tablebody, $kolombody++, $data->CATEGORIA);
            xlsWriteNumber($tablebody, $kolombody++, $data->HORAS);
            xlsWriteNumber($tablebody, $kolombody++, $data->CREDITOS);

            $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

};

/* End of file Asignaturas.php */
/* Location: ./application/controllers/Asignaturas.php */
