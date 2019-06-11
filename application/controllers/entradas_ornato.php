<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Entradas_ornato extends CI_Controller {

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
        $data = $this->consultas->getEntradasOrnato();
        $user = $this->session->userdata('user');
        $data_vale = $this->consultas->getPermisosById($user, "inventario");
        
        $html = '';
        $html .= '<div class="page-header" ><h1>Control de entrada de artículos de ornato y limpieza</h1></div>'; 
            $html .= '<div class="span12">';
            $agregar_orden = $data_vale['agregar'];
            if ($agregar_orden=="true") 
            {
                $html .= '<a href="'.base_url().'nueva_entrada_ornato" class="btn btn-success" id="newVale"><i class="fa fa-plus-circle"></i>&nbsp;Nuevo</a>';                                            
            }
                $html .= '<div class="col-md-10" id="range_date">';
                    $html .= '<br><label>Between: &nbsp</label><input type="text"  name="min" class="datepicker hasDatepicker" id="min" >';
                    $html .= '<label>&nbsp and: &nbsp</label><input type="text"  name="max" class="datepicker hasDatepicker" id="max" >';
                $html .= '</div>';
                
                $html .= '<table id="tEntradas" class="display data_table2">';
                        $html .= '<thead>';
                            $html .= '<tr>';
                                $html .= '<th>ID</th>';
                                $html .= '<th class="fecha_vales">Fecha</th>';
                                $html .= '<th>Código</th>';
                                $html .= '<th>Descripción</th>';
                                $html .= '<th>Departamento</th>';
                                $html .= '<th>Proveedor</th>';
                                $html .= '<th class="placa">Cantidad</th>';
                                $html .= '<th>Costo</th>';
                                $html .= '<th>Documento</th>';
                                $html .= '<th></th>';
                            $html .= '</tr>';
                        $html .= '</thead>';
                        $html .= '<tbody>';

                            if (!empty($data)) 
                            {
                                $gasto = 0;
                                foreach ($data as $clave => $row) 
                                {
                                    $html .= '<tr>';
                                        $html .= '<td>'.$row->folio.'</td>';
                                        
                                        $html .= '<td class="fecha_vales">'.$row->fecha.'</td>';
                                        $html .= '<td >'.$row->codigo.'</td>';
                                        $html .= '<td>'.$row->descripcion.'</td>';
                                        $html .= '<td>'.$row->departamento.'</td>';
                                        $html .= '<td class="placa">'.$row->proveedor.'</td>';
                                        $html .= '<td>'.$row->cantidad.'</td>';
                                        $html .= '<td>$'.$row->costo.'</td>';
                                        $html .= '<td>'.$row->documento.'</td>';
                                        $html .= '<td>';
                                         $editar_orden = $data_vale['editar'];
                                        if ($editar_orden=="true") 
                                        {
                                            $date = date("Y-m-d");

                                            if ($row->fecha==$date) 
                                            {
                                            $html .= ' <a href="" class="btn btn-warning" title="Editar" id="editar_entrada_ornato">';
                                                $html .= '<i class="fa fa-pencil"></i>';
                                            $html .= '</a>';
                                            }
                                        }
                                        $html .= '</td>';
                                    $html .= '</tr>';
                                    
                                }
                            }
                        $html .= '</tbody>';
                        $html .= '<tfoot>';
                            $html .= '<tr>';
                                $html .= '<td></td>';
                                $html .= '<td></td>';
                                $html .= '<td></td>';
                                $html .= '<td></td>';
                                $html .= '<td></td>';
                                $html .= '<td></td>';
                                $html .= '<td>Gasto Total:</td>';
                                $html .= '<td></td>';
                                $html .= '<td></td>';
                            $html .= '</tr>';
                        $html .= '</tfoot>';

                    $html .= '</table>'; 

            $html .= '</div>';
        $html .= '</div>';

        $this->init('','principal_login',$html);

    }
}
