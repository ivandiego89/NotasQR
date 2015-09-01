<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

date_default_timezone_set('America/Mexico_City');

class Usuarios extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        //Cargamos el modelo deel controlador
        $this->load->model('model_usuarios');
        $this->load->model('model_seguridad');
        $this->load->model('model_login');
    }
    public function Seguridad()
    {
        $url = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        $this->model_seguridad->SessionActivo($url);
    }
    public function index()
    {
        /*Si el usuario esta logeado*/
        $this->Seguridad();

        $data['usuarios'] = $this->model_usuarios->ListarUsuarios();
        $this->load->view('view_usuarios', $data);

    }

    public function nuevo()
    {

        /*Si el usuario esta logeado*/
        $this->Seguridad();
        $hoy = date("Y") . "-" . date("m") . "-" . date("d") . " " . date("H:i:s");

        $this->ValidaCampos();
        if ($this->form_validation->run() == true) {
            //Verificamos si existe el email
            $VerifyExist = $this->model_usuarios->ExisteEmail($this->input->post("EMAIL"));
            if ($VerifyExist == 0) {
                $UsuariosInsertar = $this->input->post(); //Recibimos todo los campos por array nos lo envia codeigther
                $UsuariosInsertar["FECHA_REGISTRO"] = $hoy; //le agregamos la fecha de registro
                //guardamos los registros
                $this->model_usuarios->SaveUsuarios($UsuariosInsertar);
                redirect("usuarios?save=true");
            }
            if ($VerifyExist > 0) {
                $this->session->set_flashdata('msg', '<div class="alert alert-error text-center">Email Duplicado</div>');
                $this->load->view('header');
                $this->load->view('view_nuevo_usuario');
                $this->load->view('footer');
            }

        } else {

            $data = array(
                'button' => 'Nuevo',
                'action' => site_url('usuarios/guardar'),
                'NOMBRE' => set_value('NOMBRE'),
                'APELLIDOS' => set_value('APELLIDOS'),
                'EMAIL' => set_value('EMAIL'),
                'TIPO' => set_value('TIPO'),
                'ESTATUS' => set_value('ESTATUS'),
            );

            $this->load->view('view_nuevo_usuario', $data);

        }
    }
    public function ValidaCampos()
    {
        /*Campos para validar que no esten vacio los campos*/
        $this->form_validation->set_rules("NOMBRE", "Nombre", "trim|required");
        $this->form_validation->set_rules("APELLIDOS", "Apellidos", "trim|required");
        $this->form_validation->set_rules("EMAIL", "Email", "trim|required|valid_email");
        $this->form_validation->set_rules("TIPO", "Tipo", "callback_select_tipo");
        $this->form_validation->set_rules("ESTATUS", "Estatus", "callback_select_estatus");
    }
    public function select_tipo($campo)
    {
        //Validamos tipo de usuario
        if ($campo == "0") {
            $this->form_validation->set_message('select_tipo', 'El Campo Tipo Es Obligatorio.');
            return false;
        } else {
            // Retornamos
            return true;
        }
    }
    public function select_estatus($campo)
    {
        // Validamos Estatus
        if ($campo == "NONE") {
            $this->form_validation->set_message('select_estatus', 'El Campo Estatus es Obligatorio.');
            return false;
        } else {
            //
            return true;
        }
    }
    public function editar($id = null)
    {

        if ($id == null or !is_numeric($id)) {
            $data['Modulo'] = "Usuarios";
            $data['Error'] = "Error: El ID <strong>" . $id . "</strong> No es Valido, Verifica tu Busqueda !!!!!!!";
            $this->load->view('header');
            $this->load->view('view_errors', $data);
            $this->load->view('footer');
            return;
        }
        if ($this->input->post()) {

            $this->ValidaCampos();

            if ($this->form_validation->run() == true) {
                $datos_update = $this->input->post();
                $id_insertado = $this->model_usuarios->edit($datos_update, $id);
                redirect('usuarios?update=true');

            } else {
                $this->Nuevo();
            }

        } else {

            $row = $this->model_usuarios->BuscarID($id);

            if (!$row) {
            	$data = array();
                $this->load->view('view_errors', $data);

            } else {

                $data = array(
                    'action' => site_url('usuarios/guardar'),
                    'button' => 'Editar',
                    'NOMBRE' => set_value('NOMBRE', $row[0]->NOMBRE),
                    'APELLIDOS' => set_value('APELLIDOS', $row[0]->APELLIDOS),
                    'EMAIL' => set_value('EMAIL', $row[0]->EMAIL),
                    'TIPO' => set_value('TIPO', $row[0]->TIPO),
                    'ESTATUS' => set_value('ESTATUS', $row[0]->ESTATUS),
                );

                $this->load->view('view_nuevo_usuario', $data);

            }
        }

    }
    public function eliminar($id = null)
    {
        if ($id == null or !is_numeric($id)) {
            $data['Modulo'] = "Usuarios";
            $data['Error'] = "Error: El ID <strong>" . $id . "</strong> No es Valido, Verifica tu Busqueda !!!!!!!";
            
            $this->load->view('view_errors', $data);
        
            return;
        }
        if ($this->input->post()) {
            $id_eliminar = $this->input->post('ID');
            $boton = strtoupper($this->input->post('btn_guardar'));
            if ($boton == "NO") {
                redirect("usuarios");
            } else {
                $this->model_usuarios->Eliminar($id_eliminar);
                redirect("usuarios?delete=true");
            }
        } else {
            
            $row = $this->model_usuarios->BuscarID($id);

            if (!$row) {
                $data['Modulo'] = "Usuarios";
                $data['Error'] = "Error: El ID <strong>" . $id . "</strong> No es Valido, Verifica tu Busqueda !!!!!!!";
          
                $this->load->view('view_errors', $data);
            
            } else {
         		
         		$data = array(
         			'button' => 'Eliminar',
         			'ID' => $row[0]->ID,
         		);

                $this->load->view('view_delete', $data);

            }
        }
    }
    public function password($id = null)
    {
        if ($id == null or !is_numeric($id)) {
            $data['Modulo'] = "Usuarios";
            $data['Error'] = "Error: El ID <strong>" . $id . "</strong> No es Valido, Verifica tu Busqueda !!!!!!!";
            $this->load->view('header');
            $this->load->view('view_errors', $data);
            $this->load->view('footer');
            return;
        }

        $data = array();

        $row = $this->model_usuarios->BuscarID($id);

        if($row) {
	        $data = array(
	                    'button' => 'Nuevo',
	                    'action' => site_url('usuarios/guardar'),
	                    'PASSWORD' => set_value('PASSWORD', $row[0]->PASSWORD),
	                    'PASSWORD1' => set_value('PASSWORD1'),
	                );

    	}

        if ($this->input->post()) {
            $this->form_validation->set_rules("PASSWORD", "Password", "trim|required");
            $this->form_validation->set_rules("PASSWORD1", "Confirmar Password", "trim|required");
            if ($this->form_validation->run() == true) {
                $password = $this->input->post('PASSWORD');
                $password1 = $this->input->post('PASSWORD1');
                if ($password == $password1) {

                    $password_update = array('PASSWORD' => MD5($password));
                    $this->model_usuarios->edit($password_update, $id);
                    redirect('usuarios?password=true');
                } else {
                    $this->session->set_flashdata('msg', '<div class="alert alert-error text-center">La Contraseña No coincide</div>');
                   
                    $this->load->view('view_password', $data);
                   
                }
            } else {

                $this->load->view('view_password', $data);

            }

        } else {

            if (!$row) {
                $data['Modulo'] = "Usuarios";
                $data['Error'] = "Error: El ID <strong>" . $id . "</strong> No es Valido, Verifica tu Busqueda !!!!!!!";

                $this->load->view('view_errors', $data);

            } else {
            	
                

                $this->load->view('view_password', $data);

            }
        }

    }
    public function permisos($id = null)
    {
        if ($id == null or !is_numeric($id)) {
            $data['Modulo'] = "Usuarios";
            $data['Error'] = "Error: El ID <strong>" . $id . "</strong> No es Valido, Verifica tu Busqueda !!!!!!!";
   
            $this->load->view('view_errors', $data);
        
            return;
        }
        if ($this->input->post()) {
            $id = $this->input->post("ID");
            $permission_data = $this->input->post("permissions") != false ? $this->input->post("permissions") : array();
            /*APLICAMOS UPDATE*/
            $this->model_usuarios->DesactivaPermisos($id);
            foreach ($permission_data as $Permisos) {
                $ExistePermiso = $this->model_usuarios->ExistePermiso($id, $Permisos);
                /*EXISTE PERMISO ACTUALIZAMOS, SI NO INSERTAMOS*/
                if ($ExistePermiso == 1) {
                    $this->model_usuarios->ActualizaPermiso($id, $Permisos);
                } else {
                    $AgregaPermiso = array(
                        'ID_USUARIO' => $id,
                        'ID_MENU' => $Permisos,
                    );
                    $this->model_usuarios->AgregaPermiso($AgregaPermiso);
                }
            }
            /*Si el usuario que se asigno permisos es el que esta logeado entonces refrescamos la sesion*/
            $IdUserLogin = $this->session->userdata('ID');
            if ($IdUserLogin == $id) {
                $Menu = $this->model_login->PermisosMenu($id);
                $this->session->set_userdata($Menu);
            }

            redirect('usuarios?permisos=true');
        } else {
            
            $row = $this->model_usuarios->BuscarID($id);

            if (!$row) {
                $data['Modulo'] = "Usuarios";
                $data['Error'] = "Error: El ID <strong>" . $id . "</strong> No es Valido, Verifica tu Busqueda !!!!!!!";
                
                $this->load->view('view_errors', $data);
                
            } else {
                $EstatusPermiso = array();
                $DescripcionPerm = array();
                $idMenus = array();
                $CountPermiso = 0;
                $MenuCargardo = $this->model_usuarios->MenuCompleto();
                foreach ($MenuCargardo as $Menu) {
                    $MiMenu = $this->model_usuarios->MiMenu($id, $Menu->ID);
                    $EstatusPermiso[$CountPermiso] = array();
                    $DescripcionPerm[$CountPermiso] = array();
                    $idMenus[$CountPermiso] = array();
                    $EstatusPermiso[$CountPermiso] = $MiMenu;
                    $DescripcionPerm[$CountPermiso] = $Menu->DESCRIPCION;
                    $idMenus[$CountPermiso] = $Menu->ID;
                    $CountPermiso = $CountPermiso + 1;

                }
                

                $data['estatus_menu'] = $EstatusPermiso;
                $data['descripcion_menu'] = $DescripcionPerm;
                $data['id_menu'] = $idMenus;
                $data['ID_USUARIO'] = $row[0]->ID;

              
                $this->load->view('view_permisos', $data);
              
            }
        }

    }
}
/* Archivo clientes.php */
/* Location: ./application/controllers/clientes.php */
