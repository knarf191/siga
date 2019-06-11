<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vales_lubricantes extends CI_Controller {

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
        $data = $this->consultas->getValesLubricantes();

        $user = $this->session->userdata('user');
        $data_vale = $this->consultas->getPermisosById($user, "insumos");

        $html = '';
        $html .= '<div class="page-header" ><h1>Vales de Aceites y Lubricantes</h1></div>'; 
            $html .= '<div class="span12">';
            $agregar_orden = $data_vale['agregar'];
            if ($agregar_orden=="true") 
            {
                $html .= '<a href="'.base_url().'nuevo_vale_lubricante" class="btn btn-success" id="newVale"><i class="fa fa-plus-circle"></i>&nbsp;Nuevo</a>';
            }
                $html .= '<div class="col-md-10" id="range_date">';
                    $html .= '<br><label>Between: &nbsp</label><input type="text"  name="min" class="datepicker hasDatepicker" id="min" >';
                    $html .= '<label>&nbsp and: &nbsp</label><input type="text"  name="max" class="datepicker hasDatepicker" id="max" >';
                $html .= '</div>';
                $html .= '<table id="tLubricantes" class="display data_table2">';
                        $html .= '<thead>';
                            $html .= '<tr>';
                                $html .= '<th>Folio</th>';
                                $html .= '<th class="fecha_vales">Fecha</th>';
                                $html .= '<th>Solicita</th>';
                                $html .= '<th>Departamento</th>';
                                $html .= '<th>Unidad</th>';
                                $html .= '<th class="placa">Importe</th>';
                                $html .= '<th>Proveedor</th>';
                                $html .= '<th></th>';
                            $html .= '</tr>';
                        $html .= '</thead>';
                        $html .= '<tbody>';

                            if (!empty($data)) 
                            {
                                foreach ($data as $clave => $row) 
                                {
                                    $html .= '<tr>';
                                        $html .= '<td>'.$row->folio.'</td>';
                                        $html .= '<td class="fecha_vales">'.$row->fecha.'</td>';
                                        $html .= '<td >'.$row->solicita.'</td>';
                                        $html .= '<td>'.$row->departamento.'</td>';
                                        $html .= '<td>'.$row->vehiculo.'</td>';
                                        $folio = $row->folio;
                                        $data_refacciones = $query = $this->db->query("SELECT * FROM lubricantes WHERE folio =".$folio);
                                        $subtotal = 0;
                                        foreach ($data_refacciones->result_array() as $clave)
                                        {
                                            $subtotal += $clave['importe'];
                                            
                                        }

                                        $iva = $subtotal*0.16;
                                        $total = $subtotal + $iva;
                                        $html .= '<td class="placa">$'.$total.'</td>';
                                        $html .= '<td>'.$row->refaccionaria.'</td>';
                                        $html .= '<td>';

                                        $imprimir_orden = $data_vale['eliminar'];
                                        if ($imprimir_orden=="true") 
                                        {
                                            $html .= '<button class="btn btn-info" title="Imprimir" id="imprimir_vale_lubricante">';
                                                $html .= '<i class="fa fa-print"></i>';
                                            $html .= '</button>';
                                        }

                                        $editar_orden = $data_vale['editar'];
                                        if ($editar_orden=="true") 
                                        {
                                            $html .= ' <a href="" class="btn btn-warning" title="Editar" id="editar_lubricante">';
                                                $html .= '<i class="fa fa-pencil"></i>';
                                            $html .= '</a>';
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
                                $html .= '<td>Gasto Total:</td>';
                                $html .= '<td></td>';
                            $html .= '</tr>';
                        $html .= '</tfoot>';
                    $html .= '</table>';    
            $html .= '</div>';
        $html .= '</div>';

        $this->init('','principal_login',$html);

    }
}
