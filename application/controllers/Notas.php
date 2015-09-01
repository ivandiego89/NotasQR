<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Notas extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('model_notas');
        $this->load->model('model_docentes');
        $this->load->model('model_alumnos');
        $this->load->library('form_validation');
        $this->load->helper('common');
    }

    function semestre_actual(){
        return get_current_semester();
    }

    public function ingresar()
    {
        $docente_id = 2;

        
       
        if($this->input->post('ASIGNATURA')){
            $data['alumnos_asignatura'] = $this->model_alumnos->get_by_asignatura_with_notas($this->input->post('ASIGNATURA'),$this->semestre_actual());    
        }

        if($this->input->post('BUTTON_SAVE')){
            
            $notas = $this->input->post('notas');


            foreach ($data['alumnos_asignatura'] as $alumno) {
                
                if($notas[$alumno->CODIGO_ALUMNO][1]=="" && $notas[$alumno->CODIGO_ALUMNO][2]=="")
                    continue;
                
                $data = array(
                    'PRIMER_PARCIAL' =>  $notas[$alumno->CODIGO_ALUMNO][1]!="" ? $notas[$alumno->CODIGO_ALUMNO][1] : null,
                    'SEGUNDA_PARCIAL' => $notas[$alumno->CODIGO_ALUMNO][2]!="" ? $notas[$alumno->CODIGO_ALUMNO][2]: null,
                    'NOTA_FINAL' => ($notas[$alumno->CODIGO_ALUMNO][1] + $notas[$alumno->CODIGO_ALUMNO][2]) / 2,
                );

                if($alumno->NOTA_FINAL!==null ) {
                    $data += array(
                        'FECHA_MODIFICACION' => time(),
                    );
                    $this->model_alumnos->update_notas($alumno->CODIGO_ALUMNO,$this->input->post('ASIGNATURA'),$this->semestre_actual(),$data);
                }else{
                    $data += array(
                        'CODIGO_ASIGNATURA'=> $this->input->post('ASIGNATURA'),
                        'SEMESTRE' => $this->semestre_actual(),
                        'CODIGO_ALUMNO' => $alumno->CODIGO_ALUMNO,
                        'FECHA_ING_NOTAS' => time(),
                    );
                    $this->model_alumnos->insert_notas($data);
                }

            }

            $data['alumnos_asignatura'] = $this->model_alumnos->get_by_asignatura_with_notas($this->input->post('ASIGNATURA'),$this->semestre_actual());    

        }
        
        $data['ASIGNATURA'] = $this->input->post('ASIGNATURA'); 

        $data['cursos_asignados'] = $this->model_docentes->get_cursos_asignados_por_carrera($docente_id,1,$this->semestre_actual());     
        
        $this->load->view('view_ingreso_notas_form',$data);

    }


    public function acta(){

        $docente_id = 2;

        $data['cursos_asignados'] = $this->model_docentes->get_cursos_asignados_por_carrera($docente_id,1,$this->semestre_actual());
        
        if($this->input->post('ASIGNATURA')){
            $data['alumnos_asignatura'] = $this->model_alumnos->get_by_asignatura_with_notas($this->input->post('ASIGNATURA'),$this->semestre_actual());    
        }
       
        $data['ASIGNATURA'] = $this->input->post('ASIGNATURA');

        
        $data['ESTADISTICA'] = $this->model_notas->get_estadisticas($this->input->post('ASIGNATURA'),$this->semestre_actual());

        $this->load->view('view_resumen_notas',$data);

    }


    public function constancia(){
        $alumno_id = '200921407F';
        
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('CODIGO_NOTA', ' ', 'trim|required|numeric');
	$this->form_validation->set_rules('CODIGO_ALUMNO', ' ', 'trim|required');
	$this->form_validation->set_rules('CODIGO_ASIGNATURA', ' ', 'trim|required');
	$this->form_validation->set_rules('PRIMER_PARCIAL', ' ', 'trim|required|numeric');
	$this->form_validation->set_rules('SEGUNDA_PARCIAL', ' ', 'trim|required|numeric');
	$this->form_validation->set_rules('NOTA_FINAL', ' ', 'trim|required|numeric');
	$this->form_validation->set_rules('FECHA_ING_NOTAS', ' ', 'trim|required|numeric');
	$this->form_validation->set_rules('SEMESTRE', ' ', 'trim|required');

	$this->form_validation->set_rules('', '', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function generaqr($token=""){
        header("Content-Type: image/png");
        $this->load->library('ciqrcode'); 
        $params['data'] = site_url('alumno/ver_notas/'.$token);        
        $this->ciqrcode->generate($params);             
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "notas.xls";
        $judul = "notas";
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
	xlsWriteLabel($tablehead, $kolomhead++, "CODIGO_NOTA");
	xlsWriteLabel($tablehead, $kolomhead++, "CODIGO_ALUMNO");
	xlsWriteLabel($tablehead, $kolomhead++, "CODIGO_ASIGNATURA");
	xlsWriteLabel($tablehead, $kolomhead++, "PRIMER_PARCIAL");
	xlsWriteLabel($tablehead, $kolomhead++, "SEGUNDA_PARCIAL");
	xlsWriteLabel($tablehead, $kolomhead++, "NOTA_FINAL");
	xlsWriteLabel($tablehead, $kolomhead++, "FECHA_ING_NOTAS");
	xlsWriteLabel($tablehead, $kolomhead++, "SEMESTRE");

	foreach ($this->model_notas->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteNumber($tablebody, $kolombody++, $data->CODIGO_NOTA);
	    xlsWriteLabel($tablebody, $kolombody++, $data->CODIGO_ALUMNO);
	    xlsWriteLabel($tablebody, $kolombody++, $data->CODIGO_ASIGNATURA);
	    xlsWriteNumber($tablebody, $kolombody++, $data->PRIMER_PARCIAL);
	    xlsWriteNumber($tablebody, $kolombody++, $data->SEGUNDA_PARCIAL);
	    xlsWriteNumber($tablebody, $kolombody++, $data->NOTA_FINAL);
	    xlsWriteNumber($tablebody, $kolombody++, $data->FECHA_ING_NOTAS);
	    xlsWriteLabel($tablebody, $kolombody++, $data->SEMESTRE);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

};

/* End of file Notas.php */
/* Location: ./application/controllers/Notas.php */