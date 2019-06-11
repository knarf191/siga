<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Solicitud_medicamentos extends CI_Controller {

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

    public function agregar()
    {
        if($this->input->post())
        {
            $data_post = array(
                'folio'        => $this->input->post('folio') ,
                'fecha'        => $this->input->post('fecha') ,
                'solicita'     => $this->input->post('solicita'),
                'ficha'        => $this->input->post('ficha') ,  
                'documento'    => $this->input->post('documento'),  
                'farmacia'     => $this->input->post('farmacia'),       
            );

            $data = $this->consultas->getFolioSolicitudMedicamento();

            foreach ($data as $key => $row) 
            {
               $folio = $row->folio;

                if ($folio==0) 
                {
                    $folio=1;
                }

                $cantidad = $this->input->post('cantidad_medicamentos');
                $concepto = $this->input->post('medicamento') ; 
                $p_unit   = $this->input->post('precio_unitario');  

                $validation = $this->agregar->setSolicitudMedicamentos($data_post);
                $validation_medicamentos = $this->agregar->setMedicamentos($folio,$cantidad,$concepto,$p_unit);

                $data = $this->consultas->getFolioSM();


                if ($validation && $validation_medicamentos) 
                {   
                    echo '<script language="javascript">alert("No se han podido cargar los datos, intente de nuevo");</script>';
                    redirect(base_url().'solicitud_medicamentos','refresh');
                }

                else
                {
                    echo '<script language="javascript">alert("Los datos se han agregado correctamente");</script>';
                    redirect(base_url().'vista_previa_solicitud_medicamentos?folio='.$folio,'refresh');
                }     
            }              
        }
    }

    private function load()
    {
        $data = $this->consultas->getFolioSolicitudMedicamento();

        $html = '';

        $html .= '<div class="page-header" ><h1>Solicitud de Medicamentos</h1></div>'; 
            $html .= '<div class="span12">';
                $html .= '<form class="form-inline" action="'.base_url().'solicitud_medicamentos/agregar" method="post">';
                    /************************************************************************
                                            Solicitante, Fecha y Folio
                    ************************************************************************/
                    $html .= '<div class="col-md-12" id="titles">';
                        $html .= '<div class="col-md-8">';
                            $html .= '<center><h4><b>Solicitante</b></h4></center>';
                        $html .= '</div>';

                        $html .= '<div class="col-md-4">';
                            $html .= '<center><h4><b>Fecha y Folio</b></h4><center>';
                        $html .= '</div>';
                    $html .= '</div>';


                    $html .= '<div class="col-md-12" id="solicitante_orden">';
                        $html .= '<br>';
                        $html .= '<div class="col-md-8">';
                            $html .= '<label>Nombre: &nbsp;</label><input type="text" class="form-control" name="solicita" required id="nombre_orden">';
                             $html .= '<label>&nbsp;&nbsp;Departamento: &nbsp;</label><input type="text" class="form-control" name="ficha" required id="ficha"><br>';
                            $html .= '<br><label>Documento: &nbsp;</label><input type="text" class="form-control" name="documento" required id="documento">';
                            $html .= '<label id="label_farmacia">Farmacia: &nbsp</label>
                                    <select class="form-control" name="farmacia" required>
                                        <option value="" selected disabled>Farmacia</option>
                                        <option value="UNION">UNION</option>
                                        <option value="SIMILARES">SIMILARES</option>
                                        <option value="YZA">YZA</option>
                                        <option value="FARMAPRONTO">FARMAPRONTO</option>
                                    </select>';
                        $html .= '</div>';
                            
                        $html .= '<div class="col-md-4">';

                            foreach ($data as $key => $row) 
                            {
                                $folio = $row->folio;

                                if ($folio==0) 
                                {
                                    $folio=1;
                                } 
                                $html .= '<label>Folio: &nbsp; &nbsp;</label><input type="text"  value="'.$folio.'" name="folio" class="form-control" disabled><br>';
                            }
                           

                            $date = date("Y-m-d");
                            $html .= '<br><label>Fecha: &nbsp</label><input type="date"  name="fecha" class="form-control" id="fecha_nuevo_vale" value="'.$date.'">';
                        $html .= '</div>';
                    $html .= '</div>';  

                    /************************************************************************
                                            Medicamentos
                    ************************************************************************/

                    $html .= '<div class="col-md-12" id="titles">';
                        $html .= '<center><h4><b>Medicamentos Solicitados</b></h4></center>';
                    $html .= '</div>';

                    

                    $html .= '<div class="col-md-12">';
                        $html .= '<div class="row" id="lista_refacciones">';
                            $html .= '<div class="col-md-10">';

                                $html .= '<table class="display data_table2" id="table_refacciones">';
                                    $html .= '<thead>';
                                        $html .= '<tr>';
                                            $html .= '<th>Cantidad</th>';
                                            $html .= '<th>Medicamento</th>';
                                            $html .= '<th>Precio Unitario</th>';
                                            $html .= '<th>Importe</th>';
                                            $html .= '<th></th>';
                                            $html .= '<th class="btnRefacciones"></th>';
                                        $html .= '</tr>';
                                    $html .= '</thead>';
                                    $html .= '<tbody>';
                                        $html .= '<tr>';
                                            $html .= '<td><input type="text" class="form-control" name="cantidad_medicamentos[]" id="cantidad_refacciones" ></td>';
                                            $html .= '<td><input type="text" class="form-control"  name="medicamento[]" id="concepto_refacciones"></td>';
                                            $html .= '<td><input type="text" class="form-control"  name="precio_unitario[]" id="precio_unitario"></td>';
                                            $html .= '<td><input type="text" class="form-control"  name="importe_medicamentos[]" id="importe_refacciones" disabled></td>';
                                             $html .= '<td class="btnRefacciones"><i class="fa fa-plus-circle fa-lg" id="plsC"></i></td>';
                                             
                                        $html .= '</tr>';
                                    $html .= '</tbody>';
                                $html .= '</table>';  
                            $html .= '</div>'; 
                        $html .= '</div>'; 
                    $html .= '</div>';     

                    $html .= '<div>';
                        $html .= '<input type="submit" class="btn btn-success" value="Aceptar">';

                        $html .= '<button class="btn btn-primary" id="btnCancelSM">&nbsp;Cancelar</button>';
                    $html .= '</div>'; 

                $html .= '</form>';
            $html .= '</div>';
        $html .= '</div>';

        $this->init('','principal_login',$html);

    }
}
