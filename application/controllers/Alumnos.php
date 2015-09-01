<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Alumnos extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('model_alumnos');
        $this->load->model('model_carreras');
        $this->load->model('model_asignaturas');
        $this->load->model('model_usuarios');
        $this->load->library('form_validation');
        $this->load->helper('common');
    }

    public function index()
    {
        $keyword = '';
        $this->load->library('pagination');

        $config['base_url'] = base_url() . 'alumnos/index/';
        $config['total_rows'] = $this->model_alumnos->total_rows();
        $config['per_page'] = 10;
        $config['uri_segment'] = 3;
        $config['suffix'] = '.html';
        $config['first_url'] = base_url() . 'alumnos.html';
        $this->pagination->initialize($config);

        $start = $this->uri->segment(3, 0);
        $alumnos = $this->model_alumnos->index_limit($config['per_page'], $start);

        $data = array(
            'alumnos_data' => $alumnos,
            'keyword' => $keyword,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );

        $this->load->view('view_alumnos', $data);

    }

    public function search()
    {
        $keyword = $this->uri->segment(3, $this->input->post('keyword', true));
        $this->load->library('pagination');

        if ($this->uri->segment(2) == 'search') {
            $config['base_url'] = base_url() . 'alumnos/search/' . $keyword;
        } else {
            $config['base_url'] = base_url() . 'alumnos/index/';
        }

        $config['total_rows'] = $this->model_alumnos->search_total_rows($keyword);
        $config['per_page'] = 10;
        $config['uri_segment'] = 4;
        $config['suffix'] = '.html';
        $config['first_url'] = base_url() . 'alumnos/search/' . $keyword . '.html';
        $this->pagination->initialize($config);

        $start = $this->uri->segment(4, 0);
        $alumnos = $this->model_alumnos->search_index_limit($config['per_page'], $start, $keyword);

        $data = array(
            'alumnos_data' => $alumnos,
            'keyword' => $keyword,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->load->view('alumnos_list', $data);
    }

    public function nuevo()
    {
        $data = array(
            'button' => 'Nuevo',
            'action' => site_url('alumnos/guardar'),
            'CODIGO_ALUMNO' => set_value('CODIGO_ALUMNO'),
            'NOMBRE_ALUMNO' => set_value('NOMBRE_ALUMNO'),
            'APELLIDO_PATERNO' => set_value('APELLIDO_PATERNO'),
            'APELLIDO_MATERNO' => set_value('APELLIDO_MATERNO'),
            'EMAIL' => set_value('EMAIL'),
            'TELEFONO' => set_value('TELEFONO'),
            'DIRECCION' => set_value('DIRECCION'),
            'SEXO' => set_value('SEXO'),
            'FECHA_NACIMIENTO' => set_value('FECHA_NACIMIENTO'),
            'DNI' => set_value('DNI'),
            'ANIO_INGRESO' => set_value('ANIO_INGRESO'),
            'SEMESTRE_INGRESO' => set_value('SEMESTRE_INGRESO'),
            'CARRERA_PROFESIONAL' => set_value('CARRERA_PROFESIONAL'),
            'TURNO' => set_value('TURNO'),
        );

        $data['carreras'] = $this->model_carreras->get_all();
        $this->load->view('view_alumnos_form', $data);

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

            $CODIGO_ALUMNO =  date('Y') . genKey(5,'numeric') . "-" . genKey(1,'alpha');

            $data = array(
                'CODIGO_ALUMNO' => $CODIGO_ALUMNO,
                'NOMBRE_ALUMNO' => $this->input->post('NOMBRE_ALUMNO', true),
                'APELLIDO_PATERNO' => $this->input->post('APELLIDO_PATERNO', true),
                'APELLIDO_MATERNO' => $this->input->post('APELLIDO_MATERNO', true),
                'EMAIL' => $this->input->post('EMAIL', true),
                'TELEFONO' => $this->input->post('TELEFONO', true),
                'DIRECCION' => $this->input->post('DIRECCION', true),
                'SEXO' => $this->input->post('SEXO', true),
                'FECHA_NACIMIENTO' => $this->input->post('FECHA_NACIMIENTO', true),
                'DNI' => $this->input->post('DNI', true),
                'ANIO_INGRESO' => $this->input->post('ANIO_INGRESO', true),
                'SEMESTRE_INGRESO' => $this->input->post('SEMESTRE_INGRESO', true),
                'CARRERA_PROFESIONAL' => $this->input->post('CARRERA_PROFESIONAL', true),
                'TURNO' => $this->input->post('TURNO', true),
            );

            if ($action == 'nuevo') {
                $this->model_alumnos->insert($data);

                $usr = $this->input->post('EMAIL', true);
                $pwd = genKey(6,'numeric');

                $data = array(
                    'NOMBRE' => $this->input->post('NOMBRE_ALUMNO', true),
                    'APELLIDOS' => $this->input->post('APELLIDO_PATERNO', true) . " " . $this->input->post('APELLIDO_MATERNO', true),
                    'EMAIL' => $usr,
                    'FECHA_REGISTRO' => date('Y-m-d HH:mm:ss') ,
                    'ESTATUS' => 1,
                    'TIPO' => 'Alumno',
                    'PASSWORD' => md5($pwd),
                );

                $this->model_usuarios->SaveUsuarios($data);

                $this->session->set_flashdata('message', "Se el usuario satisfactoriamente, Usuario: $usr   Password: $pwd");
                redirect(site_url('alumnos'));
            } else {
                $this->model_alumnos->update($id, $data);
                $this->session->set_flashdata('message', 'Se actualizó');
                redirect(site_url('alumnos'));
            }

        }
    }

    public function editar($id)
    {
        $row = $this->model_alumnos->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('alumnos/guardar/' . $row->CODIGO_ALUMNO),
                'CODIGO_ALUMNO' => set_value('CODIGO_ALUMNO', $row->CODIGO_ALUMNO),
                'NOMBRE_ALUMNO' => set_value('NOMBRE_ALUMNO', $row->NOMBRE_ALUMNO),
                'APELLIDO_PATERNO' => set_value('APELLIDO_PATERNO', $row->APELLIDO_PATERNO),
                'APELLIDO_MATERNO' => set_value('APELLIDO_MATERNO', $row->APELLIDO_MATERNO),
                'EMAIL' => set_value('EMAIL', $row->EMAIL),
                'TELEFONO' => set_value('TELEFONO', $row->TELEFONO),
                'DIRECCION' => set_value('DIRECCION', $row->DIRECCION),
                'SEXO' => set_value('SEXO', $row->SEXO),
                'FECHA_NACIMIENTO' => set_value('FECHA_NACIMIENTO', $row->FECHA_NACIMIENTO),
                'DNI' => set_value('DNI', $row->DNI),
                'ANIO_INGRESO' => set_value('ANIO_INGRESO', $row->ANIO_INGRESO),
                'SEMESTRE_INGRESO' => set_value('SEMESTRE_INGRESO', $row->SEMESTRE_INGRESO),
                'CARRERA_PROFESIONAL' => set_value('CARRERA_PROFESIONAL', $row->CARRERA_PROFESIONAL),
                'TURNO' => set_value('TURNO', $row->TURNO),

            );
            $data['carreras'] = $this->model_carreras->get_all();
            $this->load->view('view_alumnos_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('alumnos'));
        }
    }

    public function eliminar($id)
    {
        $row = $this->model_alumnos->get_by_id($id);

        if ($row) {
            $this->model_alumnos->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('alumnos'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('alumnos'));
        }
    }

    public function constancia()
    {
        $alumno_id = '20112345-L';
        $data['alumno'] = $this->model_alumnos->get_by_id_with_carrera($alumno_id);
        $data['SEMESTRE'] = $this->semestre_actual();

        if (($token = $this->get_token($alumno_id, $this->semestre_actual())) === null) {
            $token = $this->crear_token($alumno_id, $this->semestre_actual());
        }

        $data['asignatura_notas'] = $this->model_asignaturas->get_by_alumno_with_notas($alumno_id, $this->semestre_actual());

        $data['token'] = $token;

        $this->load->view('view_alumnos_constancia', $data);

    }

    public function ver_notas($token)
    {

        $alumno_token = $this->model_alumnos->get_by_token_with_carrera($token);

        if ($alumno_token == null) {
            show_404('page');
            die();
        }

        $data['asignatura_notas'] = $this->model_asignaturas->get_by_alumno_with_notas($alumno_token->CODIGO_ALUMNO, $alumno_token->SEMESTRE);
        $data['alumno'] = $alumno_token;
        $data['SEMESTRE'] = $alumno_token->SEMESTRE;

        $data['token'] = $this->get_token($alumno_token->CODIGO_ALUMNO, $data['SEMESTRE']);

        $this->load->view('view_alumnos_constancia', $data);

    }

    public function get_token($alumno, $semestre)
    {
        $token = $this->model_alumnos->get_token($alumno, $semestre);
        return $token;
    }

    public function crear_token($alumno, $semestre)
    {
        $data = array(
            'TOKEN' => genKey(60),
            'CODIGO_ALUMNO' => $alumno,
            'SEMESTRE' => $semestre,
        );
        $this->model_alumnos->create_token($data);
        return $this->get_token($alumno, $semestre);
    }

    public function semestre_actual()
    {
        return get_current_semester();
    }

    public function _rules()
    {
        $this->form_validation->set_rules('NOMBRE_ALUMNO', ' ', 'trim|required');
        $this->form_validation->set_rules('APELLIDO_PATERNO', ' ', 'trim|required');
        $this->form_validation->set_rules('APELLIDO_MATERNO', ' ', 'trim|required');
        $this->form_validation->set_rules('EMAIL', ' ', 'trim|required');
        $this->form_validation->set_rules('TELEFONO', ' ', 'trim|required');
        $this->form_validation->set_rules('DIRECCION', ' ', 'trim|required');
        $this->form_validation->set_rules('SEXO', ' ', 'trim|required');
        $this->form_validation->set_rules('FECHA_NACIMIENTO', ' ', 'trim|required|numeric');
        $this->form_validation->set_rules('DNI', ' ', 'trim|required|numeric');
        $this->form_validation->set_rules('ANIO_INGRESO', ' ', 'trim|required|numeric');
        $this->form_validation->set_rules('SEMESTRE_INGRESO', ' ', 'trim|required');
        $this->form_validation->set_rules('CARRERA_PROFESIONAL', ' ', 'trim|required');
        $this->form_validation->set_rules('TURNO', ' ', 'trim|required');

        $this->form_validation->set_rules('CODIGO_ALUMNO', 'CODIGO_ALUMNO', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "alumnos.xls";
        $judul = "alumnos";
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
        xlsWriteLabel($tablehead, $kolomhead++, "NOMBRE_ALUMNO");
        xlsWriteLabel($tablehead, $kolomhead++, "APELLIDO_PATERNO");
        xlsWriteLabel($tablehead, $kolomhead++, "APELLIDO_MATERNO");
        xlsWriteLabel($tablehead, $kolomhead++, "EMAIL");
        xlsWriteLabel($tablehead, $kolomhead++, "TELEFONO");
        xlsWriteLabel($tablehead, $kolomhead++, "DIRECCION");
        xlsWriteLabel($tablehead, $kolomhead++, "SEXO");
        xlsWriteLabel($tablehead, $kolomhead++, "FECHA_NACIMIENTO");
        xlsWriteLabel($tablehead, $kolomhead++, "DNI");
        xlsWriteLabel($tablehead, $kolomhead++, "AÑO_INGRESO");
        xlsWriteLabel($tablehead, $kolomhead++, "SEMESTRE_INGRESO");
        xlsWriteLabel($tablehead, $kolomhead++, "CARRERA_PROFESIONAL");
        xlsWriteLabel($tablehead, $kolomhead++, "TURNO");

        foreach ($this->model_alumnos->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
            xlsWriteLabel($tablebody, $kolombody++, $data->NOMBRE_ALUMNO);
            xlsWriteLabel($tablebody, $kolombody++, $data->APELLIDO_PATERNO);
            xlsWriteLabel($tablebody, $kolombody++, $data->APELLIDO_MATERNO);
            xlsWriteLabel($tablebody, $kolombody++, $data->EMAIL);
            xlsWriteLabel($tablebody, $kolombody++, $data->TELEFONO);
            xlsWriteLabel($tablebody, $kolombody++, $data->DIRECCION);
            xlsWriteLabel($tablebody, $kolombody++, $data->SEXO);
            xlsWriteNumber($tablebody, $kolombody++, $data->FECHA_NACIMIENTO);
            xlsWriteNumber($tablebody, $kolombody++, $data->DNI);
            xlsWriteNumber($tablebody, $kolombody++, $data->AÑO_INGRESO);
            xlsWriteLabel($tablebody, $kolombody++, $data->SEMESTRE_INGRESO);
            xlsWriteLabel($tablebody, $kolombody++, $data->CARRERA_PROFESIONAL);
            xlsWriteLabel($tablebody, $kolombody++, $data->TURNO);

            $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

};

/* End of file Alumnos.php */
/* Location: ./application/controllers/Alumnos.php */
