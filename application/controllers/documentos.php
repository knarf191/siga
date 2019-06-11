<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Documentos extends CI_Controller {

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
        $data = $this->consultas->getDocumentos();
        
        $html = '';
        $html .= '<div class="page-header" ><h1>Documentos asociados a vales de gasolina</h1></div>'; 
            $html .= '<div class="span12">';
               
                $html .= '<div class="col-md-10" id="range_date">';
                    $html .= '<br><label>Between: &nbsp</label><input type="text"  name="min" class="datepicker hasDatepicker" id="min" >';
                    $html .= '<label>&nbsp and: &nbsp</label><input type="text"  name="max" class="datepicker hasDatepicker" id="max" >';
                $html .= '</div>';
                
                $html .= '<table id="tDocumentos" class="display data_table2">';
                        $html .= '<thead>';
                            $html .= '<tr>';
                                $html .= '<th>Folio</th>';
                                $html .= '<th class="fecha_vales">Fecha</th>';
                                $html .= '<th>No. Documento</th>';
                                $html .= '<th>Gasolinera</th>';
                                $html .= '<th>Litros</th>';
                                $html .= '<th>Costo</th>';
                                $html .= '<th></th>';

                            $html .= '</tr>';
                        $html .= '</thead>';
                        $html .= '<tbody>';

                            if (!empty($data)) 
                            {
                                foreach ($data as $clave => $row) 
                                {
                                    $html .= '<tr>';
                                        $html .= '<td>'.$row->folio_vale.'</td>';
                                        $html .= '<td class="fecha_vales">'.$row->fecha.'</td>';
                                        $html .= '<td >'.$row->no_documento.'</td>';
                                        $html .= '<td>'.$row->gasolinera.'</td>';
                                        $html .= '<td>'.$row->litros.'</td>';
                                        
                                        $html .= '<td>$'.$row->costo_total.'</td>';
                                        
                                        $html .= '<td>';
                                           
                                            $html .= ' <a href="" class="btn btn-warning" title="Editar" id="editar_documento">';
                                                $html .= '<i class="fa fa-pencil"></i>';
                                            $html .= '</a>';
                                            
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
