<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Salidas_computo extends CI_Controller {

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

    private function load()
    {
        $data = $this->consultas->getSalidasComputo();
        $user = $this->session->userdata('user');
        $data_vale = $this->consultas->getPermisosById($user, "inventario");
        
        $html = '';
        $html .= '<div class="page-header" ><h1>Control de salidas de artículos de cómputo</h1></div>'; 
            $html .= '<div class="span12">';
            $agregar_orden = $data_vale['agregar'];
            if ($agregar_orden=="true") 
            {
                $html .= '<a href="'.base_url().'nueva_salida_computo" class="btn btn-success" id="newVale"><i class="fa fa-plus-circle"></i>&nbsp;Nuevo</a>';
            }                                           
               
                $html .= '<div class="col-md-10" id="range_date">';
                    $html .= '<br><label>Between: &nbsp</label><input type="text"  name="min" class="datepicker hasDatepicker" id="min" >';
                    $html .= '<label>&nbsp and: &nbsp</label><input type="text"  name="max" class="datepicker hasDatepicker" id="max" >';
                $html .= '</div>';
                
                $html .= '<table id="tSalidas" class="display data_table2">';
                    $html .= '<thead>';
                        $html .= '<tr>';
                            $html .= '<th>ID</th>';
                            $html .= '<th>Fecha</th>';
                            $html .= '<th>Solicita</th>';
                            $html .= '<th>Departamento</th>';
                            $html .= '<th>Material y/o herramienta solicitado</th>';
                            $html .= '<th></th>';
                        $html .= '</tr>';
                    $html .= '</thead>';
                    $html .= '<tbody>';
                       
                        if(!empty($data))
                        {
                            foreach ($data as $key => $row) 
                            {
                                $fecha = $row->fecha;
                                $html .= '<tr>';
                                    $html .= '<td>'.$row->folio.'</td>';
                                    $html .= '<td>'.$row->fecha.'</td>';
                                    $html .= '<td>'.$row->solicita.'</td>';
                                    $html .= '<td>'.$row->departamento.'</td>';
                                $folio = $row->folio;
                                $data_tools = $query = $this->db->query("SELECT * FROM material_salida_computo WHERE id = '$folio' ");
                                    $pedido="";
                                    foreach ($data_tools->result_array() as $row)
                                    {
                                        $pedido .= $row['cantidad'];
                                        $pedido .= ' ';
                                        $pedido .= $row['descripcion']; 
                                        $pedido .= ', ';                                    
                                    }
                                    $html .= '<td>'.$pedido.'</td>';

                                     $html .= '<td>';

                                        $imprimir_orden = $data_vale['eliminar'];
                                        if ($imprimir_orden=="true") 
                                        {
                                            $html .= '<button class="btn btn-info" title="Imprimir" id="imprimir_salida_computo">';
                                                $html .= '<i class="fa fa-print"></i>';
                                            $html .= '</button>';
                                        }

                                        $editar_orden = $data_vale['editar'];
                                        if ($editar_orden=="true") 
                                        {
                                            $date = date("Y-m-d");

                                            if ($fecha==$date) 
                                            {
                                            $html .= ' <a href="" class="btn btn-warning" title="Editar" id="editar_salida_computo">';
                                                $html .= '<i class="fa fa-pencil"></i>';
                                            $html .= '</a>';
                                            }
                                        }
                                        $html .= '</td>';
                                $html .= '</tr>';
                            }
                        }
                    $html .= '</tbody>';
                $html .= '</table>'; 

            $html .= '</div>';
        $html .= '</div>';

        $this->init('','principal_login',$html);

    }
}
