<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orden_medica extends CI_Controller {

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
                'ficha'        => $this->input->post('ficha') ,
                'solicita'     => $this->input->post('solicita'),
                'categoria'    => $this->input->post('categoria') , 
                'contrato'     => $this->input->post('contrato'),
                'personal'     => $this->input->post('personal') ,
                'beneficiario' => $this->input->post('beneficiario') ,
                'parentesco'   => $this->input->post('parentesco') , 
                'departamento' => $this->input->post('departamento'),         
            );

            $data = $this->consultas->getFolioOrdenMedica();

            foreach ($data as $key => $row) 
            {
               $folio = $row->folio;

                if ($folio==0) 
                {
                    $folio=1;
                }

            
                $validation = $this->agregar->setOrdenMedica($data_post);
               

                if ($validation) 
                {
                    echo '<script language="javascript">alert("Los datos se han agregado correctamente");</script>';
                    redirect(base_url().'vista_previa_orden_medica?folio='.$folio,'refresh');
                   
                }
                else
                {
                     echo '<script language="javascript">alert("No se han podido cargar los datos, intente de nuevo");</script>';
                    redirect(base_url().'orden_medica','refresh');
                }     
            }              
        }
    }

    private function load()
    {
        $data = $this->consultas->getFolioOrdenMedica();

        $html = '';

        $html .= '<div class="page-header" ><h1>Nueva Orden Médica</h1></div>'; 
            $html .= '<div class="span12">';
                $html .= '<form class="form-inline" action="'.base_url().'orden_medica/agregar" method="post">';
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
                             $html .= '<label>&nbsp;&nbsp;Ficha: &nbsp;</label><input type="text" class="form-control" name="ficha" required id="ficha">';
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
                                            Datos Generales
                    ************************************************************************/

                    $html .= '<div class="col-md-12" id="titles">';
                        $html .= '<center><h4><b>Datos Generales del Solicitante</b></h4></center>';
                    $html .= '</div>';

                    $html .= '<div class="col-md-12">';
                        $html .= '<br>';
                        $html .= '<br>';
                        $html .= '<div class="col-md-4">';
                            $html .= '<label>Categoría: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label><input type="text" class="form-control" name="categoria" required>';
                        $html .= '</div>';

                        $html .= '<div class="col-md-4">';
                            $html .= '<label>Contrato: &nbsp; &nbsp;&nbsp; &nbsp;</label>
                                    <select class="form-control" name="contrato" required>
                                        <option value="" selected disabled>Tipo de contrato</option>
                                        <option value="Planta">Planta</option>
                                        <option value="Eventual">Eventual</option>
                                    </select>';
                        $html .= '</div>';

                        $html .= '<div class="col-md-4">';
                            $html .= '<label>Tipo de Personal: &nbsp</label><input type="text" class="form-control" name="personal" required>';
                        $html .= '</div>';
                    $html .= '</div>';   

                    $html .= '<div class="col-md-12">';
                        $html .= '<br>';
                        $html .= '<br>';
                        $html .= '<div class="col-md-4">';
                            $html .= '<label>Beneficiario: &nbsp</label><input type="text" class="form-control" name="beneficiario" required id="beneficiario">';
                        $html .= '</div>';

                        $html .= '<div class="col-md-4">';
                            $html .= '<label>Parentesco:&nbsp;&nbsp;&nbsp;</label><input type="text" class="form-control" name="parentesco" required>';
                        $html .= '</div>';

                        $html .= '<div class="col-md-4">';
                            $html .= '<label>Departamento: &nbsp; &nbsp;&nbsp; &nbsp;</label><input type="text" class="form-control" name="departamento" required>';
                        $html .= '</div>';
                    $html .= '</div>';     

                    

                    $html .= '<div>';
                        $html .= '<input type="submit" class="btn btn-success" value="Aceptar">';

                        $html .= '<button class="btn btn-primary" id="btnCancelOrden">&nbsp;Cancelar</button>';
                    $html .= '</div>'; 

                $html .= '</form>';
            $html .= '</div>';
        $html .= '</div>';

        $this->init('','principal_login',$html);

    }
}
