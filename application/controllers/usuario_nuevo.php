<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class usuario_nuevo extends CI_Controller {

    public function index()
    {
        $this->load();
    }

    private function init($msj, $page, $html)
    {
        if($this->session->userdata('logueado'))
        {
            $data = array();
            $data['nombre'] = $this->session->userdata('nombre');
            $data['user'] = $this->session->userdata('user');
            $data['msj']  = $msj;
            $data['page'] = $page;
            $data['html'] = $html;
            $this->load->view('body_login',$data);
        }               
        else
        {       
            redirect(base_url().'login','refresh');
        }
    }

     public function agregar()
    {
        if($this->input->post())
        {
            $data_user = array(
                'id'           => $this->input->post('id'),
                'nombre'       => $this->input->post('nombre'),
                'user'         => $this->input->post('user'),
                'password'     => $this->input->post('password'),  
                'vales'        => $this->input->post('ver_vales'),
                'medicamentos' => $this->input->post('ver_medicamentos'),
                'insumos'      => $this->input->post('ver_inventario'),
                'inventario'   => $this->input->post('ver_insumos'),
                'usuarios'     => $this->input->post('ver_usuarios'),                     
            );

            $data_vales = array(
                'id'  => $this->input->post('id'),
                'user'     => $this->input->post('user'),
                'modulo'   => 'vales',
                'ver'      => $this->input->post('ver_vales'),
                'agregar'  => $this->input->post('agregar_vales'),
                'editar'   => $this->input->post('editar_vales'),
                'eliminar' => $this->input->post('eliminar_vales'),                       
            );

            $data_medicamentos = array(
                'id'  => $this->input->post('id'),
                'user'     => $this->input->post('user'),
                'modulo'   => 'medicamentos',
                'ver'      => $this->input->post('ver_medicamentos'),
                'agregar'  => $this->input->post('agregar_medicamentos'),
                'editar'   => $this->input->post('editar_medicamentos'),
                'eliminar' => $this->input->post('eliminar_medicamentos'),                       
            );

            $data_insumos = array(
                'id'  => $this->input->post('id'),
                'user'     => $this->input->post('user'),
                'modulo'   => 'insumos',
                'ver'      => $this->input->post('ver_insumos'),
                'agregar'  => $this->input->post('agregar_insumos'),
                'editar'   => $this->input->post('editar_insumos'),
                'eliminar' => $this->input->post('eliminar_insumos'),                  
            );

            $data_inventario = array(
                'id'  => $this->input->post('id'),
                'user'     => $this->input->post('user'),
                'modulo'   => 'inventario',
                'ver'      => $this->input->post('ver_inventario'),
                'agregar'  => $this->input->post('agregar_inventario'),
                'editar'   => $this->input->post('editar_inventario'),
                'eliminar' => $this->input->post('eliminar_inventario'),                     
            );

            $data_usuarios = array(
                'id'  => $this->input->post('id'),
                'user'     => $this->input->post('user'),
                'modulo'   => 'usuarios',
                'ver'      => $this->input->post('ver_usuarios'),
                'agregar'  => $this->input->post('agregar_usuarios'),
                'editar'   => $this->input->post('editar_usuarios'),
                'eliminar' => $this->input->post('eliminar_usuarios'),                     
            );

            $val_user         = $this->agregar->setUsuarios($data_user);
            $val_vales        = $this->agregar->setPermisos($data_vales);
            $val_medicamentos = $this->agregar->setPermisos($data_medicamentos);
            $val_insumos      = $this->agregar->setPermisos($data_insumos);
            $val_inventario   = $this->agregar->setPermisos($data_inventario);
            $val_usuarios     = $this->agregar->setPermisos($data_usuarios);

            if ($val_user && $val_vales && $val_medicamentos && $val_insumos && $val_inventario && $val_usuarios) 
            {
                echo "true";
            }

            else
            {
                echo "false";
            }       
        }
    }

    private function load()
    {
        $data = $this->consultas->getIdUser();
        $html = '';

        $html .= '<div class="page-header" ><h1>Nuevo Usuario</h1></div>'; 
            $html .= '<div class="span12">';
                $html .= '<form class="form-inline" action="'.base_url().'usuario_nuevo/agregar" method="post" id="setUser">';

                    /************************************************************************
                                            Datos del Usuario
                    ************************************************************************/

                    $html .= '<div class="col-md-12" id="titles">';
                        $html .= '<center><h4><b>Datos del Usuario</b></h4></center>';
                    $html .= '</div>';

                    $html .= '<div class="col-md-12">';
                        $html .= '<br>';
                        $html .= '<br>';

                        foreach ($data as $key => $row) 
                        {
                            $id = $row->id;

                            if ($id==0) 
                            {
                                $id=1;
                            } 

                            $html .= '<div class="col-md-3" id="id_user">';
                                $html .= '<label>ID: &nbsp</label><input type="text" class="form-control" name="idUser" id="idUser" value="'.$id.'">';   
                            $html .= '</div>';
                        }


                        $html .= '<div class="col-md-3" id="nombre_user">';
                            $html .= '<label>Nombre: &nbsp</label><input type="text" class="form-control" name="nombre" required id="nombreUser">';   
                        $html .= '</div>';

                        $html .= '<div class="col-md-3">';
                            $html .= '<label>Usuario: &nbsp; &nbsp;&nbsp; &nbsp;</label><input type="text" class="form-control" name="user" required id="user">';
                        $html .= '</div>';

                        $html .= '<div class="col-md-3">';
                            $html .= '<label>Contraseña: &nbsp</label><input type="pass" class="form-control" name="password" required id="passUser">';
                        $html .= '</div>';
                    $html .= '</div>';   

                   /************************************************************************
                                           Permisos de Usuario
                    ************************************************************************/

                    $html .= '<div class="col-md-12" id="titles">';
                        $html .= '<center><h4><b>Permisos Otorgados al Usuario</b></h4></center>';
                    $html .= '</div>';

                    $html .= '<div class="col-md-10" id="titles">';
                        $html .= '<h4><b>Vales de Gasolina</b></h4>';
                    $html .= '</div>';

                    $html .= '<div class="row" id="permisos_usuarios">';
                        $html .= '<div class="col-md-8">';

                            $html .= '<table id="tPermisos" class="display data_table2">';
                                $html .= '<thead>';
                                    $html .= '<tr>';
                                        $html .= '<th>Ver</th>';
                                        $html .= '<th>Agregar</th>';
                                        $html .= '<th>Editar</th>';
                                        $html .= '<th>Saldo</th>';
                                    $html .= '</tr>';
                                $html .= '</thead>';
                                $html .= '<tbody>';
                                    $html .= '<tr>';
                                        $html .= '<td><input type="checkbox" name="ver_vales" id="ver_vales" ></td>';
                                        $html .= '<td><input type="checkbox" name="agregar_vales" id="agregar_vales" disabled="disabled"></td>';
                                        $html .= '<td><input type="checkbox" name="editar_vales" id="editar_vales" disabled="disabled"></td>';
                                        $html .= '<td><input type="checkbox" name="eliminar_vales" id="eliminar_vales" disabled="disabled"></td>';
                                    $html .= '</tr>';
                                $html .= '</tbody>';
                            $html .= '</table>';   
                        $html .= '</div>';
                    $html .= '</div>';


                    $html .= '<div class="col-md-10" id="titles">';
                        $html .= '<h4><b>Medicamentos</b></h4>';
                    $html .= '</div>';

                    $html .= '<div class="row" id="permisos_usuarios">';
                        $html .= '<div class="col-md-8">';

                            $html .= '<table id="tPermisos" class="display data_table2">';
                                $html .= '<thead>';
                                    $html .= '<tr>';
                                        $html .= '<th>Ver</th>';
                                        $html .= '<th>Agregar</th>';
                                        $html .= '<th>Editar</th>';
                                        $html .= '<th>Imprimir</th>';
                                    $html .= '</tr>';
                                $html .= '</thead>';
                                $html .= '<tbody>';
                                    $html .= '<tr>';
                                        $html .= '<td><input type="checkbox" name="ver_medicamentos" id="ver_medicamentos"></td>';
                                        $html .= '<td><input type="checkbox" name="agregar_medicamentos" id="agregar_medicamentos" disabled="disabled"></td>';
                                        $html .= '<td><input type="checkbox" name="editar_medicamentos" id="editar_medicamentos" disabled="disabled"></td>';
                                        $html .= '<td><input type="checkbox" name="eliminar_medicamentos" id="eliminar_medicamentos" disabled="disabled"></td>';
                                    $html .= '</tr>';
                                $html .= '</tbody>';
                            $html .= '</table>';   
                        $html .= '</div>';
                    $html .= '</div>';


                    $html .= '<div class="col-md-10" id="titles">';
                        $html .= '<h4><b>Insumos</b></h4>';
                    $html .= '</div>';

                    $html .= '<div class="row" id="permisos_usuarios">';
                        $html .= '<div class="col-md-8">';

                            $html .= '<table id="tPermisos" class="display data_table2">';
                                $html .= '<thead>';
                                    $html .= '<tr>';
                                        $html .= '<th>Ver</th>';
                                        $html .= '<th>Agregar</th>';
                                        $html .= '<th>Editar</th>';
                                        $html .= '<th>Imprimir</th>';
                                    $html .= '</tr>';
                                $html .= '</thead>';
                                $html .= '<tbody>';
                                    $html .= '<tr>';
                                        $html .= '<td><input type="checkbox" name="ver_insumos" id="ver_insumos"></td>';
                                        $html .= '<td><input type="checkbox" name="agregar_insumos" id="agregar_insumos" disabled="disabled"></td>';
                                        $html .= '<td><input type="checkbox" name="editar_insumos" id="editar_insumos" disabled="disabled"></td>';
                                        $html .= '<td><input type="checkbox" name="eliminar_insumos" id="eliminar_insumos" disabled="disabled"></td>';
                                    $html .= '</tr>';
                                $html .= '</tbody>';
                            $html .= '</table>';   
                        $html .= '</div>';
                    $html .= '</div>';

                    $html .= '<div class="col-md-10" id="titles">';
                        $html .= '<h4><b>Inventario</b></h4>';
                    $html .= '</div>';

                    $html .= '<div class="row" id="permisos_usuarios">';
                        $html .= '<div class="col-md-8">';

                            $html .= '<table id="tPermisos" class="display data_table2">';
                                $html .= '<thead>';
                                    $html .= '<tr>';
                                        $html .= '<th>Ver</th>';
                                        $html .= '<th>Agregar</th>';
                                        $html .= '<th>Editar</th>';
                                        $html .= '<th>Imprimir</th>';
                                    $html .= '</tr>';
                                $html .= '</thead>';
                                $html .= '<tbody>';
                                    $html .= '<tr>';
                                        $html .= '<td><input type="checkbox" name="ver_inventario" id="ver_inventario"></td>';
                                        $html .= '<td><input type="checkbox" name="agregar_inventario" id="agregar_inventario" disabled="disabled"></td>';
                                        $html .= '<td><input type="checkbox" name="editar_inventario" id="editar_inventario" disabled="disabled"></td>';
                                        $html .= '<td><input type="checkbox" name="eliminar_inventario" id="eliminar_inventario" disabled="disabled"></td>';
                                    $html .= '</tr>';
                                $html .= '</tbody>';
                            $html .= '</table>';   
                        $html .= '</div>';
                    $html .= '</div>';

                    $html .= '<div class="col-md-10" id="titles">';
                        $html .= '<h4><b>Usuarios</b></h4>';
                    $html .= '</div>';

                    $html .= '<div class="row" id="permisos_usuarios">';
                        $html .= '<div class="col-md-8">';

                            $html .= '<table id="tPermisos" class="display data_table2">';
                                $html .= '<thead>';
                                    $html .= '<tr>';
                                        $html .= '<th>Ver</th>';
                                        $html .= '<th>Agregar</th>';
                                        $html .= '<th>Editar</th>';
                                        $html .= '<th>Eliminar</th>';
                                    $html .= '</tr>';
                                $html .= '</thead>';
                                $html .= '<tbody>';
                                    $html .= '<tr>';
                                        $html .= '<td><input type="checkbox" name="ver_usuarios" id="ver_usuarios"></td>';
                                        $html .= '<td><input type="checkbox" name="agregar_usuarios" id="agregar_usuarios" disabled="disabled"></td>';
                                        $html .= '<td><input type="checkbox" name="editar_usuarios" id="editar_usuarios" disabled="disabled"></td>';
                                        $html .= '<td><input type="checkbox" name="eliminar_usuarios" id="eliminar_usuarios" disabled="disabled"></td>';
                                    $html .= '</tr>';
                                $html .= '</tbody>';
                            $html .= '</table>';   
                        $html .= '</div>';
                    $html .= '</div>';


                    $html .= '<div>';
                        $html .= '<a href="" type="submit" class="btn btn-success" id="btnSetUser">Aceptar</a>';

                        $html .= '<button class="btn btn-primary"  id="btnCancelUser">Cancelar</button>';
                    $html .= '</div>';     
                $html .= '</form>';
            $html .= '</div>';
        $html .= '</div>';

        $this->init('','principal_login',$html);

    }
}
