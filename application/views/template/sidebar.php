<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="header">MENU PRINCIPAL</li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-dashboard"></i> <span>Usuarios</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo site_url('usuarios/nuevo') ?>"><i class="fa fa-circle-o"></i> Nuevo Usuario</a></li>
                    <li><a href="<?php echo site_url('usuarios') ?>"><i class="fa fa-circle-o"></i> Listar Usuarios</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-dashboard"></i> <span>Carreras</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo site_url('carreras/nuevo') ?>"><i class="fa fa-circle-o"></i> Nueva Carrera</a></li>
                    <li><a href="<?php echo site_url('carreras') ?>"><i class="fa fa-circle-o"></i> Listado de Carreras</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-dashboard"></i> <span>Asignaturas</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo site_url('asignaturas/nuevo') ?>"><i class="fa fa-circle-o"></i> Nueva Asignatura</a></li>
                    <li><a href="<?php echo site_url('asignaturas') ?>"><i class="fa fa-circle-o"></i> Listar Catalogo</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-dashboard"></i> <span>Docentes</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo site_url('docentes/nuevo') ?>"><i class="fa fa-circle-o"></i> Nuevo Docente</a></li>
                    <li><a href="<?php echo site_url('docentes') ?>"><i class="fa fa-circle-o"></i> Listar Docentes</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-dashboard"></i> <span>Alumnos</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo site_url('alumnos/nuevo') ?>"><i class="fa fa-circle-o"></i> Nuevo Alumno</a></li>
                    <li><a href="<?php echo site_url('alumnos') ?>"><i class="fa fa-circle-o"></i> Listar Alumnos</a></li>

                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-dashboard"></i> <span>Matriculas</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo site_url('matriculas/nuevo') ?>"><i class="fa fa-circle-o"></i> Ingresar Matricula</a></li>
                    <li><a href="<?php echo site_url('matriculas/reporte') ?>"><i class="fa fa-circle-o"></i> Reporte Matriculas</a></li>
                    
                </ul>
            </li>
            
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
<!-- =============================================== -->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">