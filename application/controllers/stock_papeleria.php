<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stock_papeleria extends CI_Controller {

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

        $data = $this->consultas->getStockPapeleria();
		$html = '';

        $html .= '<div class="page-header" ><h1>Stock de papelería y artículos de oficina</h1></div>'; 
            $html .= '<div class="span12">';

                 $html .= '<a href="'.base_url().'entradas_papeleria" class="btn btn-success" id="newVale"><i class="fa fa-upload"></i>&nbsp;Entrada</a>';
                 $html .= '<a href="'.base_url().'salidas_papeleria" class="btn btn-danger" id="newVale"><i class="fa fa-download"></i>&nbsp;Salida</a>';
                $html .= '<div class="col-md-8" id="range_dateUsers">';
                    $html .= '<br><label>Between: &nbsp</label><input type="text"  name="min" class="datepicker hasDatepicker" id="min" >';
                    $html .= '<label>&nbsp and: &nbsp</label><input type="text"  name="max" class="datepicker hasDatepicker" id="max" >';
                $html .= '</div>';

                $html .= '<table id="tStock" class="display data_table2">';
                    $html .= '<thead>';
                        $html .= '<tr>';
                            $html .= '<th>ID</th>';
                            $html .= '<th>Código</th>';
                            $html .= '<th>Descripción</th>';
                            $html .= '<th>Unidad</th>';
                            $html .= '<th>Cantidad</th>';
                            $html .= '<th>Departamento</th>';
                        $html .= '</tr>';
                    $html .= '</thead>';
                    $html .= '<tbody>';
                       
                        if(!empty($data))
                        {
                            foreach ($data as $key => $row) 
                            {
                                $html .= '<tr>';
                                    $html .= '<td>'.$row->id.'</td>';
                                    $html .= '<td>'.$row->codigo.'</td>';
                                    $html .= '<td>'.$row->descripcion.'</td>';
                                    $html .= '<td>'.$row->unidad.'</td>';
                                    $html .= '<td>'.$row->cantidad.'</td>';
                                    $html .= '<td>'.$row->departamento.'</td>';
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
