<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Recargas extends CI_Controller {

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
        $data  = $this->consultas->getRecargas();
        $user = $this->session->userdata('user');
        $data_vale = $this->consultas->getPermisosById($user, "vales");
        

        $html = '';
        $html .= '<div class="page-header" ><h1>Recargas Gasolinera</h1></div>'; 
            $html .= '<div class="span12">';

                $agregar_vale = $data_vale['agregar'];
                if ($agregar_vale=="true") 
                {
                    $html .= '<a href="'.base_url().'nueva_recarga" class="btn btn-success" id="newVale"><i class="fa fa-plus-circle"></i>&nbsp;Nuevo</a>';
                }

                $saldo       = $this->consultas->getSaldo();
                foreach ($saldo as $key => $row) 
                {
                    $folio = $row->id;
                    $saldo = $this->consultas->getRecargaByFolio($folio);
                    $saldo_disponible = $saldo['saldo_actual'];
                    
                }

                $html .= '<label class="saldo">SALDO DISPONIBLE: $'.$saldo_disponible.'</label>';

                $html .= '<div class="col-md-10" id="range_date">';
                    $html .= '<br><label>Between: &nbsp</label><input type="text"  name="min" class="datepicker hasDatepicker" id="min" >';
                    $html .= '<label>&nbsp and: &nbsp</label><input type="text"  name="max" class="datepicker hasDatepicker" id="max" >';
                $html .= '</div>';

                $html .= '<table id="tRecargas" class="display data_table2">';
                        $html .= '<thead>';
                            $html .= '<tr>';
                                $html .= '<th>Folio</th>';
                                $html .= '<th class="fecha_vales">Fecha</th>';
                                $html .= '<th>Responsable</th>';
                                $html .= '<th>Saldo Anterior</th>';
                                $html .= '<th>Saldo Abonado</th>';
                                $html .= '<th>Saldo Actual</th>';
                                $html .= '<th></th>';
                            $html .= '</tr>';
                        $html .= '</thead>';
                        $html .= '<tbody>';

                            if (!empty($data)) 
                            {
                                foreach ($data as $clave => $row) 
                                {
                                    $html .= '<tr>';
                                        $html .= '<td>'.$row->id.'</td>';
                                        $html .= '<td class="fecha_vales">'.$row->fecha.'</td>';
                                        $html .= '<td >'.$row->personal.'</td>';
                                        $html .= '<td>$'.$row->saldo_anterior.'</td>';
                                        $html .= '<td>$'.$row->recarga.'</td>';
                                        $html .= '<td>$'.$row->saldo_actual.'</td>';
                                        $html .= '<td>';

                                            
                                            $editar_vale = $data_vale['editar'];

                                            if ($editar_vale == 'true') 
                                            {
                                                $date = date("Y-m-d");

                                                if ($row->fecha==$date) 
                                                {
                                                    $html .= ' <a href="" class="btn btn-warning" title="Editar" id="editar_recarga">';
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
                                $html .= '<td>Saldo Total Abonado:</td>';
                                $html .= '<td></td>';
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
