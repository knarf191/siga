<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Nuevo_vale_lubricante extends CI_Controller {

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
                'folio'         => $this->input->post('folio') ,
                'solicita'      => $this->input->post('solicita'),
                'chofer'        => $this->input->post('chofer_Lubricante') , 
                'fecha'         => $this->input->post('fecha') ,
                'departamento'  => $this->input->post('departamento_Lubricante'),     
                'vehiculo'      => $this->input->post('vehiculo_Lubricante'),
                'placas'        => $this->input->post('placas_Lubricante') ,
                'econ'          => $this->input->post('econ_Lubricante') ,
                'refaccionaria' => $this->input->post('refaccionaria') ,       
            );

            
                 

            $data = $this->consultas->getFolioLubricantes();

            foreach ($data as $key => $row) 
            {
                $folio = $row->folio;

                if ($folio==0) 
                {
                    $folio=1;
                }

                $cantidad = $this->input->post('cantidad_Lubricante');
                $concepto = $this->input->post('concepto_Lubricante'); 
                $p_unit   = $this->input->post('precio_unitario_lubricante');   
                

                $validation             = $this->agregar->setValeLubricante($data_post);
                $validation_lubricantes = $this->agregar->setLubricantes($folio,$cantidad,$concepto,$p_unit);

                if ($validation && $validation_lubricantes) 
                {
                    echo '<script language="javascript">alert("No se han podido cargar los datos, intente de nuevo");</script>';
                    redirect(base_url().'nuevo_vale_lubricante','refresh');
                }

                else
                {
                    echo '<script language="javascript">alert("Los datos se han agregado correctamente");</script>';
                    redirect(base_url().'vista_previa_lubricante?folio='.$folio,'refresh'); 
                }
            } 
        }
    }

    private function load()
    {
        $data = $this->consultas->getFolioLubricantes();

        $html = '';

        $html .= '<div class="page-header" ><h1>Vale Aceites y/o Lubricantes</h1></div>'; 
            $html .= '<div class="span12">';
                $html .= '<form class="form-inline" action="'.base_url().'nuevo_vale_lubricante/agregar" method="post">';
                    /************************************************************************
                                            Datos Generales, Fecha y Folio
                    ************************************************************************/
                    $html .= '<div class="col-md-12" id="titles">';
                        $html .= '<div class="col-md-8">';
                            $html .= '<center><h4><b>Datos Generales</b></h4></center>';
                        $html .= '</div>';

                        $html .= '<div class="col-md-4">';
                            $html .= '<center><h4><b>Fecha y Folio</b></h4><center>';
                        $html .= '</div>';
                    $html .= '</div>';


                    $html .= '<div class="col-md-12" id="solicitante_orden">';
                        $html .= '<br>';
                        $html .= '<div class="col-md-8">';
                            $html .= '<label>Nombre: &nbsp;</label><input type="text" class="form-control" name="solicita" required id="nombre_refacciones">';
                             $html .= '<label>&nbsp;&nbsp;Departamento: &nbsp;</label><input type="text" class="form-control" name="departamento_Lubricante" required id="departamento_refacciones">';
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
                           
                        $html .= '</div>';
                    $html .= '</div>';  

                     $html .= '<div class="col-md-12" id="titles">';
                        $html .= '<div class="col-md-8">';
                            $html .= '<label>Chofer: &nbsp;</label><input type="text" class="form-control" name="chofer_Lubricante" required id="chofer_refacciones">';
                             $html .= '<label>&nbsp;&nbsp;Vehiculo: &nbsp;</label><input type="text" class="form-control" name="vehiculo_Lubricante" required id="vehiculo_refacciones">';
                        $html .= '</div>';

                        $html .= '<div class="col-md-4">';
                            $date = date("Y-m-d");
                            $html .= '<br><label>Fecha: &nbsp</label><input type="date"  name="fecha" class="form-control" id="fecha_nuevo_vale" value="'.$date.'">';
                        $html .= '</div>';
                    $html .= '</div>';

                    $html .= '<div class="col-md-12" id="titles_lubricantes">';
                        $html .= '<div class="col-md-4">';
                            $html .= '<label>Placas: &nbsp;</label><input type="text" class="form-control" name="placas_Lubricante" required id="placas_refacciones">';
                        $html .= '</div>';

                        $html .= '<div class="col-md-4">';
                            $html .= '<label>No. Econ: &nbsp;</label><input type="text" class="form-control" name="econ_Lubricante" required id="econ_refacciones">';
                        $html .= '</div>';

                        $html .= '<div class="col-md-4">';
                            $html .= '<label>Refaccionaria: &nbsp;</label><input type="text" class="form-control" name="refaccionaria" required id="refaccionaria">';
                        $html .= '</div>';
                    $html .= '</div>';

                    /************************************************************************
                                            Lubricantes a Solicitar
                    ************************************************************************/
                    $html .= '<div class="col-md-12" id="titles">';
                        $html .= '<center><h4><b>Aceites y/o lubricantes a solicitar</b></h4></center>';
                    $html .= '</div>';

                    $html .= '<div class="row" id="lista_refacciones">';
                        $html .= '<div class="col-md-10">';

                            $html .= '<table class="display data_table2" id="table_Lubricantes">';
                                $html .= '<thead>';
                                    $html .= '<tr>';
                                        $html .= '<th>Cantidad</th>';
                                        $html .= '<th>Concepto</th>';
                                        $html .= '<th>P. Unit.</th>';
                                        $html .= '<th>Importe</th>';
                                        $html .= '<th></th>';
                                        $html .= '<th class="btnRefacciones"></th>';
                                    $html .= '</tr>';
                                $html .= '</thead>';
                                $html .= '<tbody>';
                                    $html .= '<tr>';
                                        $html .= '<td><input type="text" class="form-control" name="cantidad_Lubricante[]" id="cantidad_Lubricante" ></td>';
                                        $html .= '<td><input type="text" class="form-control"  name="concepto_Lubricante[]" id="concepto_Lubricante"></td>';
                                        $html .= '<td><input type="text" class="form-control"  name="precio_unitario_lubricante[]" id="precio_unitario_lubricante"></td>';
                                        $html .= '<td><input type="text" class="form-control"  name="importe_Lubricante[]" id="importe_Lubricante" disabled></td>';
                                        $html .= '<td class="btnRefacciones"><i class="fa fa-plus-circle fa-lg" id="plusLubricante"></i></td>'; 
                                    $html .= '</tr>';
                                $html .= '</tbody>';
                            $html .= '</table>'; 
                        $html .= '</div>';
                    $html .= '</div>';

                    $html .= '<div>';
                        $html .= '<input type="submit" class="btn btn-success" value="Aceptar">';

                        $html .= '<button class="btn btn-primary" id="cancelar_lubricante">&nbsp;Cancelar</button>';
                    $html .= '</div>';     
                $html .= '</form>';
            $html .= '</div>';
        $html .= '</div>';

        $this->init('','principal_login',$html);

    }
}
