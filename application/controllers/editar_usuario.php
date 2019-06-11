<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Editar_usuario extends CI_Controller {

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

    function editar()
    {
        if($this->input->post())
        {
            $user = $this->input->post('user');
            $id   = $this->input->post('id');

            $data_user = array(
                'id'           => $this->input->post('id'),
                'nombre'       => $this->input->post('nombre'),
                'user'         => $this->input->post('user'),
                'password'     => $this->input->post('password'),  
                'vales'        => $this->input->post('ver_vales'),
                'medicamentos' => $this->input->post('ver_medicamentos'),
                'insumos'      => $this->input->post('ver_insumos'),
                'inventario'      => $this->input->post('ver_inventario'),
                'usuarios'     => $this->input->post('ver_usuarios'),                     
            );

            $data_vales = array(
                'user'     => $this->input->post('user'),
                'modulo'   => 'vales',
                'ver'      => $this->input->post('ver_vales'),
                'agregar'  => $this->input->post('agregar_vales'),
                'editar'   => $this->input->post('editar_vales'),
                'eliminar' => $this->input->post('eliminar_vales'),                       
            );

            $data_medicamentos = array(
                'user'     => $this->input->post('user'),
                'modulo'   => 'medicamentos',
                'ver'      => $this->input->post('ver_medicamentos'),
                'agregar'  => $this->input->post('agregar_medicamentos'),
                'editar'   => $this->input->post('editar_medicamentos'),
                'eliminar' => $this->input->post('eliminar_medicamentos'),                       
            );

            $data_insumos = array(
                'user'     => $this->input->post('user'),
                'modulo'   => 'insumos',
                'ver'      => $this->input->post('ver_insumos'),
                'agregar'  => $this->input->post('agregar_insumos'),
                'editar'   => $this->input->post('editar_insumos'),
                'eliminar' => $this->input->post('eliminar_insumos'),                  
            );

            $data_inventario = array(
                'user'     => $this->input->post('user'),
                'modulo'   => 'inventario',
                'ver'      => $this->input->post('ver_inventario'),
                'agregar'  => $this->input->post('agregar_inventario'),
                'editar'   => $this->input->post('editar_inventario'),
                'eliminar' => $this->input->post('eliminar_inventario'),                     
            );

            $data_usuarios = array(
                'user'     => $this->input->post('user'),
                'modulo'   => 'usuarios',
                'ver'      => $this->input->post('ver_usuarios'),
                'agregar'  => $this->input->post('agregar_usuarios'),
                'editar'   => $this->input->post('editar_usuarios'),
                'eliminar' => $this->input->post('eliminar_usuarios'),                     
            );



            $val_user         = $this->agregar->updateUsuarios($id,$data_user);
            $val_vales        = $this->agregar->updatePermisos($id,'vales',$data_vales);
            $val_medicamentos = $this->agregar->updatePermisos($id,'medicamentos',$data_medicamentos);
            $val_insumos      = $this->agregar->updatePermisos($id,'insumos',$data_insumos);
            $val_inventario   = $this->agregar->updatePermisos($id,'inventario',$data_inventario);
            $val_usuarios     = $this->agregar->updatePermisos($id,'usuarios',$data_usuarios);



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
        $id       = $_GET['id'];
        $data_user = $this->consultas->getUserById($id);

        $nombre   = $data_user['nombre'];
        $user     = $data_user['user'];
        $password = $data_user['password'];

        $data_vale = $this->consultas->getPermisosById($user, "vales");

        $ver_vales      = $data_vale['ver'];
        $agregar_vales  = $data_vale['agregar'];
        $editar_vales   = $data_vale['editar'];
        $eliminar_vales = $data_vale['eliminar'];

        $data_medicamentos = $this->consultas->getPermisosById($user, "medicamentos");

        $ver_medicamentos      = $data_medicamentos['ver'];
        $agregar_medicamentos  = $data_medicamentos['agregar'];
        $editar_medicamentos   = $data_medicamentos['editar'];
        $eliminar_medicamentos = $data_medicamentos['eliminar'];

        $data_insumos = $this->consultas->getPermisosById($user, "insumos");

        $ver_insumos      = $data_insumos['ver'];
        $agregar_insumos  = $data_insumos['agregar'];
        $editar_insumos   = $data_insumos['editar'];
        $eliminar_insumos = $data_insumos['eliminar'];

        $data_inventario = $this->consultas->getPermisosById($user, "inventario");

        $ver_inventario      = $data_inventario['ver'];
        $agregar_inventario  = $data_inventario['agregar'];
        $editar_inventario   = $data_inventario['editar'];
        $eliminar_inventario = $data_inventario['eliminar'];

        $data_usuarios = $this->consultas->getPermisosById($user, "usuarios");

        $ver_usuarios      = $data_usuarios['ver'];
        $agregar_usuarios  = $data_usuarios['agregar'];
        $editar_usuarios   = $data_usuarios['editar'];
        $eliminar_usuarios = $data_usuarios['eliminar'];

        $html = '';
        $html .= '<div class="page-header" ><h1>Editar Registro y Permisos de Usuario</h1></div>'; 
            $html .= '<div class="span12">';
                $html .= '<form class="form-inline" action="'.base_url().'editar_usuario/editar" method="post" id="updateUsuario">';

                    /************************************************************************
                                            Datos del Usuario
                    ************************************************************************/

                    $html .= '<div class="col-md-12" id="titles">';
                        $html .= '<center><h4><b>Datos del Usuario</b></h4></center>';
                    $html .= '</div>';

                    $html .= '<div class="col-md-12">';
                        $html .= '<br>';
                        $html .= '<br>';
                        
                        $html .= '<div class="col-md-3" id="id_user">';
                            $html .= '<label>ID: &nbsp</label><input type="text" class="form-control" name="idUser" disabled="disabled" id="idUser" value="'.$id.'">';   
                        $html .= '</div>';
    
                        $html .= '<div class="col-md-3" id="nombre_user">';
                            $html .= '<label>Nombre: &nbsp</label><input type="text" class="form-control" name="nombre" required id="nombreUser" value="'.$nombre.'">';   
                        $html .= '</div>';

                        $html .= '<div class="col-md-3">';
                            $html .= '<label>Usuario: &nbsp; &nbsp;&nbsp; &nbsp;</label><input type="text" class="form-control" name="user" required id="user" value="'.$user.'">';
                        $html .= '</div>';

                        $html .= '<div class="col-md-3">';
                            $html .= '<label>Contraseña: &nbsp</label><input type="pass" class="form-control" name="password" required id="passUser" value="'.$password.'">';
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

                                        if ($ver_vales=="true") 
                                        {
                                           $html .= '<td><input type="checkbox" name="ver_vales" id="ver_vales" checked></td>'; 

                                           if ($agregar_vales=="true")
                                           {
                                             $html .= '<td><input type="checkbox" name="agregar_vales" id="agregar_vales" checked></td>';  
                                           }
                                           else
                                           {
                                                $html .= '<td><input type="checkbox" name="agregar_vales" id="agregar_vales"></td>';
                                           }

                                           if ($editar_vales=="true")
                                           {
                                                $html .= '<td><input type="checkbox" name="editar_vales" id="editar_vales" checked></td>'; 
                                           }
                                           else
                                           {
                                                $html .= '<td><input type="checkbox" name="editar_vales" id="editar_vales"></td>';
                                           }
                                           if ($eliminar_vales=="true")
                                           {
                                                $html .= '<td><input type="checkbox" name="eliminar_vales" id="eliminar_vales" checked></td>';
                                           }
                                           else
                                           {
                                                $html .= '<td><input type="checkbox" name="eliminar_vales" id="eliminar_vales"></td>';
                                           }
                                        }
                                        else
                                        {
                                            $html .= '<td><input type="checkbox" name="ver_vales" id="ver_vales"></td>'; 
                                            $html .= '<td><input type="checkbox" name="agregar_vales" id="agregar_vales" disabled="disabled"></td>';
                                            $html .= '<td><input type="checkbox" name="editar_vales" id="editar_vales" disabled="disabled"></td>';
                                            $html .= '<td><input type="checkbox" name="eliminar_vales" id="eliminar_vales" disabled="disabled"></td>';
                                        }                                           
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

                                        if ($ver_medicamentos=="true") 
                                        {
                                           $html .= '<td><input type="checkbox" name="ver_medicamentos" id="ver_medicamentos" checked></td>'; 

                                           if ($agregar_medicamentos=="true")
                                           {
                                             $html .= '<td><input type="checkbox" name="agregar_medicamentos" id="agregar_medicamentos" checked></td>';  
                                           }
                                           else
                                           {
                                                $html .= '<td><input type="checkbox" name="agregar_medicamentos" id="agregar_medicamentos"></td>';
                                           }

                                           if ($editar_medicamentos=="true")
                                           {
                                                $html .= '<td><input type="checkbox" name="editar_medicamentos" id="editar_medicamentos" checked></td>'; 
                                           }
                                           else
                                           {
                                                $html .= '<td><input type="checkbox" name="editar_medicamentos" id="editar_medicamentos"></td>';
                                           }
                                           if ($eliminar_medicamentos=="true")
                                           {
                                                $html .= '<td><input type="checkbox" name="eliminar_medicamentos" id="eliminar_medicamentos" checked></td>';
                                           }
                                           else
                                           {
                                                $html .= '<td><input type="checkbox" name="eliminar_medicamentos" id="eliminar_medicamentos"></td>';
                                           }
                                        }
                                        else
                                        {
                                            $html .= '<td><input type="checkbox" name="ver_medicamentos" id="ver_medicamentos"></td>'; 
                                            $html .= '<td><input type="checkbox" name="agregar_medicamentos" id="agregar_medicamentos" disabled="disabled"></td>';
                                            $html .= '<td><input type="checkbox" name="editar_medicamentos" id="editar_medicamentos" disabled="disabled"></td>';
                                            $html .= '<td><input type="checkbox" name="eliminar_medicamentos" id="eliminar_medicamentos" disabled="disabled"></td>';
                                   
                                        }
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
                                        if ($ver_insumos=="true") 
                                        {
                                           $html .= '<td><input type="checkbox" name="ver_insumos" id="ver_insumos" checked></td>'; 

                                           if ($agregar_insumos=="true")
                                           {
                                             $html .= '<td><input type="checkbox" name="agregar_insumos" id="agregar_insumos" checked></td>';  
                                           }
                                           else
                                           {
                                                $html .= '<td><input type="checkbox" name="agregar_insumos" id="agregar_insumos"></td>';
                                           }

                                           if ($editar_insumos=="true")
                                           {
                                                $html .= '<td><input type="checkbox" name="editar_insumos" id="editar_insumos" checked></td>'; 
                                           }
                                           else
                                           {
                                                $html .= '<td><input type="checkbox" name="editar_insumos" id="editar_insumos"></td>';
                                           }
                                           if ($eliminar_insumos=="true")
                                           {
                                                $html .= '<td><input type="checkbox" name="eliminar_insumos" id="eliminar_insumos" checked></td>';
                                           }
                                           else
                                           {
                                                $html .= '<td><input type="checkbox" name="eliminar_insumos" id="eliminar_insumos"></td>';
                                           }
                                        }
                                        else
                                        {
                                            $html .= '<td><input type="checkbox" name="ver_insumos" id="ver_insumos"></td>'; 
                                            $html .= '<td><input type="checkbox" name="agregar_insumos" id="agregar_insumos" disabled="disabled"></td>';
                                            $html .= '<td><input type="checkbox" name="editar_insumos" id="editar_insumos" disabled="disabled"></td>';
                                            $html .= '<td><input type="checkbox" name="eliminar_insumos" id="eliminar_insumos" disabled="disabled"></td>';
                                        }   
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
                                        if ($ver_inventario=="true") 
                                        {
                                           $html .= '<td><input type="checkbox" name="ver_inventario" id="ver_inventario" checked></td>'; 

                                           if ($agregar_inventario=="true")
                                           {
                                             $html .= '<td><input type="checkbox" name="agregar_inventario" id="agregar_inventario" checked></td>';  
                                           }
                                           else
                                           {
                                                $html .= '<td><input type="checkbox" name="agregar_inventario" id="agregar_inventario"></td>';
                                           }

                                           if ($editar_inventario=="true")
                                           {
                                                $html .= '<td><input type="checkbox" name="editar_inventario" id="editar_inventario" checked></td>'; 
                                           }
                                           else
                                           {
                                                $html .= '<td><input type="checkbox" name="editar_inventario" id="editar_inventario"></td>';
                                           }
                                           if ($eliminar_inventario=="true")
                                           {
                                                $html .= '<td><input type="checkbox" name="eliminar_inventario" id="eliminar_inventario" checked></td>';
                                           }
                                           else
                                           {
                                                $html .= '<td><input type="checkbox" name="eliminar_inventario" id="eliminar_inventario"></td>';
                                           }
                                        }
                                        else
                                        {
                                            $html .= '<td><input type="checkbox" name="ver_inventario" id="ver_inventario"></td>'; 
                                            $html .= '<td><input type="checkbox" name="agregar_inventario" id="agregar_inventario" disabled="disabled"></td>';
                                            $html .= '<td><input type="checkbox" name="editar_inventario" id="editar_inventario" disabled="disabled"></td>';
                                            $html .= '<td><input type="checkbox" name="eliminar_inventario" id="eliminar_inventario" disabled="disabled"></td>';
                                        }   
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
                                        if ($ver_usuarios=="true") 
                                        {
                                           $html .= '<td><input type="checkbox" name="ver_usuarios" id="ver_usuarios" checked></td>'; 

                                           if ($agregar_usuarios=="true")
                                           {
                                             $html .= '<td><input type="checkbox" name="agregar_usuarios" id="agregar_usuarios" checked></td>';  
                                           }
                                           else
                                           {
                                                $html .= '<td><input type="checkbox" name="agregar_usuarios" id="agregar_usuarios"></td>';
                                           }

                                           if ($editar_usuarios=="true")
                                           {
                                                $html .= '<td><input type="checkbox" name="editar_usuarios" id="editar_usuarios" checked></td>'; 
                                           }
                                           else
                                           {
                                                $html .= '<td><input type="checkbox" name="editar_usuarios" id="editar_usuarios"></td>';
                                           }
                                           if ($eliminar_usuarios=="true")
                                           {
                                                $html .= '<td><input type="checkbox" name="eliminar_usuarios" id="eliminar_usuarios" checked></td>';
                                           }
                                           else
                                           {
                                                $html .= '<td><input type="checkbox" name="eliminar_usuarios" id="eliminar_usuarios"></td>';
                                           }
                                        }
                                        else
                                        {
                                            $html .= '<td><input type="checkbox" name="ver_usuarios" id="ver_usuarios" ></td>'; 
                                            $html .= '<td><input type="checkbox" name="agregar_usuarios" id="agregar_usuarios" disabled="disabled"></td>';
                                            $html .= '<td><input type="checkbox" name="editar_usuarios" id="editar_usuarios" disabled="disabled"></td>';
                                            $html .= '<td><input type="checkbox" name="eliminar_usuarios" id="eliminar_usuarios" disabled="disabled"></td>';
                                        }   
                                    $html .= '</tr>';
                                $html .= '</tbody>';
                            $html .= '</table>';   
                        $html .= '</div>';
                    $html .= '</div>';


                    $html .= '<div>';
                        $html .= '<a href="" type="submit" class="btn btn-success" id="btnUpdateUser">Aceptar</a>';

                        $html .= '<button class="btn btn-primary"  id="btnCancelUser">Cancelar</button>';
                    $html .= '</div>';     
                $html .= '</form>';
            $html .= '</div>';
        $html .= '</div>';

        $this->init('','principal_login',$html);

    }
}
