<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Docentes extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('model_docentes');
        $this->load->model('model_alumnos');
        $this->load->model('model_notas');
        $this->load->library('form_validation');
        $this->load->helper('common');
    }

    public function index()
    {
        $keyword = '';
        $this->load->library('pagination');

        $config['base_url'] = base_url() . 'docentes/index/';
        $config['total_rows'] = $this->model_docentes->total_rows();
        $config['per_page'] = 10;
        $config['uri_segment'] = 3;
        $config['suffix'] = '.html';
        $config['first_url'] = base_url() . 'docentes.html';
        $this->pagination->initialize($config);

        $start = $this->uri->segment(3, 0);
        $docentes = $this->model_docentes->index_limit($config['per_page'], $start);

        $data = array(
            'docentes_data' => $docentes,
            'keyword' => $keyword,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );

        $this->load->view('view_docentes', $data);
    }

    public function search()
    {
        $keyword = $this->uri->segment(3, $this->input->post('keyword', true));
        $this->load->library('pagination');

        if ($this->uri->segment(2) == 'search') {
            $config['base_url'] = base_url() . 'docentes/search/' . $keyword;
        } else {
            $config['base_url'] = base_url() . 'docentes/index/';
        }

        $config['total_rows'] = $this->model_docentes->search_total_rows($keyword);
        $config['per_page'] = 10;
        $config['uri_segment'] = 4;
        $config['suffix'] = '.html';
        $config['first_url'] = base_url() . 'docentes/search/' . $keyword . '.html';
        $this->pagination->initialize($config);

        $start = $this->uri->segment(4, 0);
        $docentes = $this->model_docentes->search_index_limit($config['per_page'], $start, $keyword);

        $data = array(
            'docentes_data' => $docentes,
            'keyword' => $keyword,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->load->view('docentes_list', $data);
    }

    public function ficha($id)
    {
        $row = $this->model_docentes->get_by_id($id);
        if ($row) {
            $data = array(
                'CODIGO_DOCENTE' => $row->CODIGO_DOCENTE,
                'NOMBRE_DOCENTE' => $row->NOMBRE_DOCENTE,
                'AP_DOCENTE' => $row->AP_DOCENTE,
                'AM_DOCENTE' => $row->AM_DOCENTE,
                'DIRECCION' => $row->DIRECCION,
                'TELEFONO' => $row->TELEFONO,
                'SEXO' => $row->SEXO,
                'DNI' => $row->DNI,
                'EMAIL' => $row->EMAIL,
                'FECHA_INGRESO' => $row->FECHA_INGRESO,
            );
            $this->load->view('docentes_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('docentes'));
        }
    }

    public function nuevo()
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('docentes/guardar'),

            'NOMBRE_DOCENTE' => set_value('NOMBRE_DOCENTE'),
            'AP_DOCENTE' => set_value('AP_DOCENTE'),
            'AM_DOCENTE' => set_value('AM_DOCENTE'),
            'DIRECCION' => set_value('DIRECCION'),
            'TELEFONO' => set_value('TELEFONO'),
            'SEXO' => set_value('SEXO'),
            'DNI' => set_value('DNI'),
            'EMAIL' => set_value('EMAIL'),
            'FECHA_INGRESO' => set_value('FECHA_INGRESO'),
        );
        $this->load->view('view_docentes_form', $data);
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
                'NOMBRE_DOCENTE' => $this->input->post('NOMBRE_DOCENTE', true),
                'AP_DOCENTE' => $this->input->post('AP_DOCENTE', true),
                'AM_DOCENTE' => $this->input->post('AM_DOCENTE', true),
                'DIRECCION' => $this->input->post('DIRECCION', true),
                'TELEFONO' => $this->input->post('TELEFONO', true),
                'SEXO' => $this->input->post('SEXO', true),
                'DNI' => $this->input->post('DNI', true),
                'EMAIL' => $this->input->post('EMAIL', true),
                'FECHA_INGRESO' => $this->input->post('FECHA_INGRESO', true),
            );
            if ($action == 'nuevo') {
                $this->model_docentes->insert($data);
                $this->session->set_flashdata('message', 'Se añadió al docente satisfactoriamente');
                redirect(site_url('docentes'));
            } else {
                $this->model_docentes->update($id, $data);
                $this->session->set_flashdata('message', 'Se actualizó');
                redirect(site_url('docentes'));
            }

        }
    }

    public function editar($id)
    {
        $row = $this->model_docentes->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('docentes/guardar/' . $id),
                'CODIGO_DOCENTE' => set_value('CODIGO_DOCENTE', $row->CODIGO_DOCENTE),
                'NOMBRE_DOCENTE' => set_value('NOMBRE_DOCENTE', $row->NOMBRE_DOCENTE),
                'AP_DOCENTE' => set_value('AP_DOCENTE', $row->AP_DOCENTE),
                'AM_DOCENTE' => set_value('AM_DOCENTE', $row->AM_DOCENTE),
                'DIRECCION' => set_value('DIRECCION', $row->DIRECCION),
                'TELEFONO' => set_value('TELEFONO', $row->TELEFONO),
                'SEXO' => set_value('SEXO', $row->SEXO),
                'DNI' => set_value('DNI', $row->DNI),
                'EMAIL' => set_value('EMAIL', $row->EMAIL),
                'FECHA_INGRESO' => set_value('FECHA_INGRESO', $row->FECHA_INGRESO),
            );
            $this->load->view('view_docentes_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('docentes'));
        }
    }

    public function eliminar($id)
    {
        $row = $this->model_docentes->get_by_id($id);

        if ($row) {
            $this->model_docentes->delete($id);
            $this->session->set_flashdata('message', 'El Docente fue eliminado');
            redirect(site_url('docentes'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('docentes'));
        }
    }

    public function asignar_cursos($id)
    {

        $this->load->model('model_facultad');
        $this->load->model('model_carreras');

        $row = $this->model_docentes->get_by_id($id);

        if ($row) {


            if($this->input->post('BUTTON_SAVE')){ echo 'asas';
                foreach ($this->input->post('_asignaturas') as $asignatura) {
                    $this->_asignar_curso($asignatura,$row->CODIGO_DOCENTE,$this->input->post('SEMESTRE'),$this->input->post('CODIGO_CARRERA'));
                }
            }


            $data = array('docente' => array(
                    'CODIGO_DOCENTE' => $row->CODIGO_DOCENTE,
                    'FULLNAME' => $this->model_docentes->fullname($row),                    
                ),                
                'facultades' => $this->model_facultad->get_all(),
                'CODIGO_FACULTAD' => $this->input->post('CODIGO_FACULTAD'),
                'CODIGO_CARRERA' => $this->input->post('CODIGO_CARRERA'),                
                'SEMESTRE'=> $this->input->post('SEMESTRE'),
            );

            if ($this->input->post('CODIGO_FACULTAD')) {
                $data['carreras'] = $this->model_facultad->get_carreras($this->input->post('CODIGO_FACULTAD'));
            }

            if ($this->input->post('CODIGO_CARRERA')) {
                $data['asignaturas'] = $this->model_carreras->get_cursos($this->input->post('CODIGO_CARRERA'));
                $data['cursos_asignados'] = $this->model_docentes->get_cursos_asignados_por_carrera($row->CODIGO_DOCENTE,$this->input->post('CODIGO_CARRERA'),$this->input->post('SEMESTRE'));
            }


            $this->load->view('view_asignar_curso_docente_form', $data);

        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('docentes'));
        }

    }

    public function _asignar_curso($curso,$docente,$semestre,$carrera){
        $this->model_docentes->asignar_curso(array(
                'CODIGO_DOCENTE' => $docente,
                'CODIGO_ASIGNATURA' => $curso,
                'SEMESTRE' => $semestre,
                'CODIGO_CARRERA' => $carrera
            ));
    }

    

    function semestre_actual(){
        return get_current_semester();
    }

    public function _rules()
    {
        $this->form_validation->set_rules('NOMBRE_DOCENTE', ' ', 'trim|required');
        $this->form_validation->set_rules('AP_DOCENTE', ' ', 'trim|required');
        $this->form_validation->set_rules('AM_DOCENTE', ' ', 'trim|required');
        $this->form_validation->set_rules('DIRECCION', ' ', 'trim|required');
        $this->form_validation->set_rules('TELEFONO', ' ', 'trim|required|numeric');
        $this->form_validation->set_rules('SEXO', ' ', 'trim|required');
        $this->form_validation->set_rules('DNI', ' ', 'trim|required|numeric|min_length[8]|max_length[8]');
        $this->form_validation->set_rules('EMAIL', ' ', 'trim|required|valid_email');
        $this->form_validation->set_rules('FECHA_INGRESO', ' ', 'trim|required|numeric');

        $this->form_validation->set_rules('CODIGO_DOCENTE', 'CODIGO_DOCENTE', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "docentes.xls";
        $judul = "docentes";
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
        xlsWriteLabel($tablehead, $kolomhead++, "NOMBRE_DOCENTE");
        xlsWriteLabel($tablehead, $kolomhead++, "AP_DOCENTE");
        xlsWriteLabel($tablehead, $kolomhead++, "AM_DOCENTE");
        xlsWriteLabel($tablehead, $kolomhead++, "DIRECCION");
        xlsWriteLabel($tablehead, $kolomhead++, "TELEFONO");
        xlsWriteLabel($tablehead, $kolomhead++, "SEXO");
        xlsWriteLabel($tablehead, $kolomhead++, "DNI");
        xlsWriteLabel($tablehead, $kolomhead++, "EMAIL");
        xlsWriteLabel($tablehead, $kolomhead++, "FECHA_INGRESO");

        foreach ($this->model_docentes->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
            xlsWriteLabel($tablebody, $kolombody++, $data->NOMBRE_DOCENTE);
            xlsWriteLabel($tablebody, $kolombody++, $data->AP_DOCENTE);
            xlsWriteLabel($tablebody, $kolombody++, $data->AM_DOCENTE);
            xlsWriteLabel($tablebody, $kolombody++, $data->DIRECCION);
            xlsWriteNumber($tablebody, $kolombody++, $data->TELEFONO);
            xlsWriteLabel($tablebody, $kolombody++, $data->SEXO);
            xlsWriteNumber($tablebody, $kolombody++, $data->DNI);
            xlsWriteLabel($tablebody, $kolombody++, $data->EMAIL);
            xlsWriteNumber($tablebody, $kolombody++, $data->FECHA_INGRESO);

            $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

};

/* End of file Docentes.php */
/* Location: ./application/controllers/Docentes.php */
