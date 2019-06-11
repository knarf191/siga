<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ordenes_medicas extends CI_Controller {

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
		$data = $this->consultas->getOrdenesMedicas();
        $user = $this->session->userdata('user');
        $data_vale = $this->consultas->getPermisosById($user, "medicamentos");
        $html = '';
        $html .= '<div class="page-header" ><h1>Órdenes Médicas</h1></div>'; 
            $html .= '<div class="span12">';
            $agregar_orden = $data_vale['agregar'];
                if ($agregar_orden=="true") 
                {
                    $html .= '<a href="'.base_url().'orden_medica" class="btn btn-success" id="newOrden"><i class="fa fa-plus-circle"></i>&nbsp;Nuevo</a>';
                }

                $html .= '<div class="col-md-10" id="range_date">';
                    $html .= '<br><label>Between: &nbsp</label><input type="text"  name="min" class="datepicker hasDatepicker" id="min" >';
                    $html .= '<label>&nbsp and: &nbsp</label><input type="text"  name="max" class="datepicker hasDatepicker" id="max" >';
                $html .= '</div>';

                $html .= '<table id="tOrdenMedica" class="display data_table2">';
                        $html .= '<thead>';
                            $html .= '<tr>';
                                $html .= '<th>Folio</th>';
                                $html .= '<th class="fecha_medicamentos">Fecha</th>';
                                $html .= '<th class="trabajador">Trabajador</th>';
                                $html .= '<th>Ficha</th>';
                                $html .= '<th class="departamento">Departamento</th>';
                                $html .= '<th>Contrato</th>';
                       
                                $html .= '<th class="beneficiario">Beneficiario</th>';
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
                                        $html .= '<td class="departamento">'.$row->departamento.'</td>';
                                        $html .= '<td>'.$row->contrato.'</td>';
                                       
                                        $html .= '<td class="beneficiario">'.$row->beneficiario.'</td>';
                                        $html .= '<td class="celda_space">';
                                        $imprimir_orden = $data_vale['eliminar'];
                                        if ($imprimir_orden=="true") 
                                        {
                                            $html .= '<button class="btn btn-info" title="Imprimir" id="imprimir_orden">';
                                                $html .= '<i class="fa fa-print"></i>';
                                            $html .= '</button>';
                                        }

                                        $editar_orden = $data_vale['editar'];
                                        if ($editar_orden=="true") 
                                        {
                                            $html .= ' <a href="" class="btn btn-warning" title="Editar" id="editar_orden">';
                                                $html .= '<i class="fa fa-pencil"></i>';
                                            $html .= '</a>';
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
