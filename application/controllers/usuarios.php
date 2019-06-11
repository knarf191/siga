<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios extends CI_Controller {

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

    function deleteUser()
    {       
        $usuario        = $this->input->post('usuario');
        
        $delete         = $this->eliminar->deleteUser($usuario);
        $deletePermisos = $this->eliminar->deletePermisos($usuario);

        if($delete && $deletePermisos)
        {   
            echo "true";        
        }
        else
        {
            echo "false";
        }
    }

	private function load()
	{

        $data = $this->consultas->getUsuarios();

        $user = $this->session->userdata('user');
        $data_vale = $this->consultas->getPermisosById($user, "usuarios");
		$html = '';

        $html .= '<div class="page-header" ><h1>Usuarios</h1></div>'; 
            $html .= '<div class="span12">';

            $agregar_orden = $data_vale['agregar'];
            if ($agregar_orden=="true") 
            {
                $html .= '<a href="'.base_url().'usuario_nuevo" class="btn btn-success"><i class="fa fa-user-plus"></i>&nbsp;Nuevo</a>';
            }
                $html .= '<div class="col-md-8" id="range_dateUsers">';
                    $html .= '<br><label>Between: &nbsp</label><input type="text"  name="min" class="datepicker hasDatepicker" id="min" >';
                    $html .= '<label>&nbsp and: &nbsp</label><input type="text"  name="max" class="datepicker hasDatepicker" id="max" >';
                $html .= '</div>';

                $html .= '<table id="tUsuarios" class="display data_table2">';
                    $html .= '<thead>';
                        $html .= '<tr>';
                            $html .= '<th>ID</th>';
                            $html .= '<th>Nombre</th>';
                            $html .= '<th>User</th>';
                            $html .= '<th>Contraseña</th>';
                            $html .= '<th>Vales</th>';
                            $html .= '<th>Medicamentos</th>';
                            $html .= '<th>Insumos</th>';
                            $html .= '<th>Inventario</th>';
                            $html .= '<th>Usuarios</th>';
                            $html .= '<th></th>';
                        $html .= '</tr>';
                    $html .= '</thead>';
                    $html .= '<tbody>';
                       
                        if(!empty($data))
                        {
                            foreach ($data as $key => $row) 
                            {
                                $html .= '<tr>';
                                    $html .= '<td>'.$row->id.'</td>';
                                    $html .= '<td>'.$row->nombre.'</td>';
                                    $html .= '<td>'.$row->user.'</td>';
                                    $html .= '<td>'.$row->password.'</td>';

                                    if ($row->vales=="true") 
                                    {
                                        $html .= '<td><i class="fa fa-check"></i></td>';   
                                    }
                                    else
                                    {
                                        $html .= '<td><i class="fa fa-close"></i></td>'; 
                                    }
                                    if ($row->medicamentos=="true") 
                                    {
                                        $html .= '<td><i class="fa fa-check"></i></td>';   
                                    }
                                    else
                                    {
                                        $html .= '<td><i class="fa fa-close"></i></td>'; 
                                    }
                                    if ($row->insumos=="true") 
                                    {
                                        $html .= '<td><i class="fa fa-check"></i></td>';   
                                    }
                                    else
                                    {
                                        $html .= '<td><i class="fa fa-close"></i></td>'; 
                                    }
                                    if ($row->inventario=="true") 
                                    {
                                        $html .= '<td><i class="fa fa-check"></i></td>';   
                                    }
                                    else
                                    {
                                        $html .= '<td><i class="fa fa-close"></i></td>'; 
                                    }
                                    if ($row->usuarios=="true") 
                                    {
                                        $html .= '<td><i class="fa fa-check"></i></td>';   
                                    }
                                    else
                                    {
                                        $html .= '<td><i class="fa fa-close"></i></td>'; 
                                    }

                                    if ($row->user=="root") 
                                    {
                                      $html .= '<td></td>';
                                    }
                                    else
                                    {
                                        $html .= '<td>';
                                        $eliminar_orden = $data_vale['eliminar'];
                                        if ($eliminar_orden=="true") 
                                        {
                                            $html .= '<a href="" class="btn btn-danger" title="Eliminar" id="deleteUser">';
                                                $html .= '<i class="fa fa-minus-circle"></i>';
                                            $html .= '</a>';
                                        }
                                        $editar_orden = $data_vale['editar'];
                                        if ($editar_orden=="true") 
                                        {
                                            $html .= '  <a href="" class="btn btn-warning" title="Modificar" id="editarUser">';
                                                $html .= '<i class="fa fa-pencil"></i>';
                                            $html .= '</a>';
                                        }
                                        $html .= '</td>';  
                                    }  
                                $html .= '</tr>';
                            }
                        }
                    $html .= '</tbody>';
                $html .= '</table>';    
            $html .= '</div>';
        $html .= '</div>';

        $html .= '<div>';
            $html .= '<input type="hidden" value="'.base_url().'usuarios/deleteUser" id="deleteUsuario">';
        $html .= '</div>';

		$this->init('','principal_login',$html);

	}
}
