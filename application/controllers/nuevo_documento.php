<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Nuevo_documento extends CI_Controller {

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
                'folio_vale'   => $this->input->post('folio') ,
                'fecha'        => $this->input->post('fecha_documento') ,
                'no_documento' => $this->input->post('documento') ,
                'gasolinera'   => $this->input->post('gasolinera') ,
                'litros'       => $this->input->post('litros') , 
                'costo_total'  => $this->input->post('importe'),     
            );

            $validation = $this->agregar->setDocumento($data_post);

            if ($validation) 
            {   
               echo '<script language="javascript">alert("Los datos se han agregado correctamente");</script>';
                redirect(base_url().'vales','refresh'); 
            }
            else
            {
                echo '<script language="javascript">alert("No se han podido cargar los datos, intente de nuevo");</script>';
                redirect(base_url().'vales','refresh');
                
            }                   
        }
    }

    private function load()
    {
        $folio = $_GET['folio'];
        $data         = $this->consultas->getValesByFolio($folio);
        $folio_asoc = $data['folio_asoc'];
        $litros       = $data['litros'];
        $gasolinera   = $data['gasolinera'];

        $html = '';

        $html .= '<div class="page-header" ><h1>Facturas de vales</h1></div>'; 
            $html .= '<div class="span12">';
                $html .= '<form class="form-inline" action="'.base_url().'nuevo_documento/agregar" method="post">';
                    /************************************************************************
                                            Solicitante, Fecha y Folio
                    ************************************************************************/
                    $html .= '<div class="col-md-12" id="titles">';
                        $html .= '<center><h4><b>Datos</b></h4></center>';
                    $html .= '</div>';


                    $html .= '<div class="col-md-12" id="solicitante_orden">';
                        $html .= '<br>';
                        $html .= '<div class="col-md-2">';  
                         $html .= '<label>Folio:&nbsp;</label><br><input type="text" name="folio" class="form-control" value="'.$folio.'">';
                        $html .= '</div>';

                        $html .= '<div class="col-md-2">';  
                         $date = date("Y-m-d");
                            $html .= '<label>Fecha: &nbsp</label><input type="date"  name="fecha_documento" class="form-control" id="fecha_documento" value="'.$date.'">';
                        $html .= '</div>';

                        $html .= '<div class="col-md-2">';  
                         $html .= '<label>No. Documento:&nbsp;</label><input type="text" name="documento" class="form-control">';
                        $html .= '</div>';

                        $html .= '<div class="col-md-2">';  
                         $html .= '<label>Gasolinera:&nbsp;</label><br><input type="text" name="gasolinera" class="form-control" value="'.$gasolinera.'">';
                        $html .= '</div>';

                        $html .= '<div class="col-md-2">';  
                         $html .= '<label>Litros:&nbsp;</label><br><input type="text" name="litros" class="form-control" value="'.$litros.'">';
                        $html .= '</div>';

                        $html .= '<div class="col-md-2">';  
                         $html .= '<label>Importe:&nbsp;</label><br><input type="text" name="importe" class="form-control">';
                        $html .= '</div>';
                    $html .= '</div>';  

                    

                    $html .= '<div>';
                        $html .= '<input type="submit" class="btn btn-success" value="Aceptar">';

                        $html .= '<button class="btn btn-primary" id="cancelar_vale">&nbsp;Cancelar</button>';
                    $html .= '</div>'; 

                $html .= '</form>';
            $html .= '</div>';
        $html .= '</div>';

        $this->init('','principal_login',$html);

    }
}
