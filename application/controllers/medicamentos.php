<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Medicamentos extends CI_Controller {

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
		$data = $this->consultas->getSolicitud_Medicamentos();
        $user = $this->session->userdata('user');
        $data_vale = $this->consultas->getPermisosById($user, "medicamentos");
        $html = '';
        $html .= '<div class="page-header" ><h1>Medicamentos</h1></div>'; 
            $html .= '<div class="span12">';
            $agregar_orden = $data_vale['agregar'];
            if ($agregar_orden=="true") 
            {
                $html .= '<a href="'.base_url().'solicitud_medicamentos" class="btn btn-success" id="newOrden"><i class="fa fa-plus-circle"></i>&nbsp;Nuevo</a>';
            }
                $html .= '<div class="col-md-10" id="range_date">';
                    $html .= '<br><label>Between: &nbsp</label><input type="text"  name="min" class="datepicker hasDatepicker" id="min" >';
                    $html .= '<label>&nbsp and: &nbsp</label><input type="text"  name="max" class="datepicker hasDatepicker" id="max" >';
                $html .= '</div>';
                $html .= '<table id="tMedicamentos" class="display data_table2">';
                        $html .= '<thead>';
                            $html .= '<tr>';
                                $html .= '<th>Folio</th>';
                                $html .= '<th class="fecha_medicamentos">Fecha</th>';
                                $html .= '<th class="trabajador">Trabajador</th>';
                                $html .= '<th>Ficha</th>';
                                $html .= '<th class="departamento">Documento</th>';
                                $html .= '<th>Farmacia</th>';
                                $html .= '<th class="personal">Costo</th>';
                                $html .= '<th class="celda_space"></th>';
                            $html .= '</tr>';
                        $html .= '</thead>';
                        $html .= '<tbody>';

                            if (!empty($data)) 
                            {
                                foreach ($data as $clave => $row) 
                                {
                                    $html .= '<tr>';
                                        $html .= '<td>'.$row->folio.'</td>';
                                        $html .= '<td class="fecha_medicamentos">'.$row->fecha.'</td>';
                                        $html .= '<td class="trabajador">'.$row->solicita.'</td>';
                                        $html .= '<td>'.$row->ficha.'</td>';
                                        $html .= '<td class="departamento">'.$row->documento.'</td>';

                                        $farmacia = strtoupper($row->farmacia);
                                        $html .= '<td>'.$farmacia.'</td>';

                                        $folio = $row->folio;
                                        $data_medicamentos = $query = $this->db->query("SELECT * FROM medicamentos WHERE folio =".$folio);
                                        $subtotal = 0;
                                        foreach ($data_medicamentos->result_array() as $clave)
                                        {
                                            $subtotal += $clave['importe'];
                                            
                                        }
                                        $iva = $subtotal*0.16;
                                        $total = $subtotal + $iva;
                                        $html .= '<td class="beneficiario">$'.$total.'</td>';
                                        $html .= '<td class="celda_space">';

                                        $imprimir_orden = $data_vale['eliminar'];
                                        if ($imprimir_orden=="true") 
                                        {
                                            $html .= '<button class="btn btn-info" title="Imprimir" id="imprimir_SM">';
                                                $html .= '<i class="fa fa-print"></i>';
                                            $html .= '</button>';
                                        }

                                        $editar_orden = $data_vale['editar'];
                                        if ($editar_orden=="true") 
                                        {
                                            $html .= ' <a href="" class="btn btn-warning" title="Editar" id="editar_SM">';
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
