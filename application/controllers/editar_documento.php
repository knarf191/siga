<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Editar_documento extends CI_Controller {

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

    public function editar()
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

            $folio = $this->input->post('folio');

            $validation = $this->agregar->updateDocumento($folio,$data_post);

            if ($validation) 
            {   
               echo '<script language="javascript">alert("Los datos se han modificado correctamente");</script>';
                redirect(base_url().'documentos','refresh'); 
            }
            else
            {
                echo '<script language="javascript">alert("No se han podido modificar los datos, intente de nuevo");</script>';
                redirect(base_url().'documentos','refresh');
                
            }                   
        }
    }

    private function load()
    {
        $folio = $_GET['folio'];
        $data         = $this->consultas->getDocumentosByFolio($folio);
        $fecha = $data['fecha'];
        $no_documento = $data['no_documento'];
        $litros     = $data['litros'];
        $gasolinera = $data['gasolinera'];
        $costo_total = $data['costo_total'];

        $html = '';

        $html .= '<div class="page-header" ><h1>Facturas de vales</h1></div>'; 
            $html .= '<div class="span12">';
                $html .= '<form class="form-inline" action="'.base_url().'editar_documento/editar" method="post">';
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
                            $html .= '<label>Fecha: &nbsp</label><input type="date"  name="fecha_documento" class="form-control" id="fecha_documento" value="'.$fecha.'">';
                        $html .= '</div>';

                        $html .= '<div class="col-md-2">';  
                         $html .= '<label>No. Documento:&nbsp;</label><input type="text" name="documento" class="form-control" value="'.$no_documento.'">';
                        $html .= '</div>';

                        $html .= '<div class="col-md-2">';  
                         $html .= '<label>Gasolinera:&nbsp;</label><br><input type="text" name="gasolinera" class="form-control" value="'.$gasolinera.'">';
                        $html .= '</div>';

                        $html .= '<div class="col-md-2">';  
                         $html .= '<label>Litros:&nbsp;</label><br><input type="text" name="litros" class="form-control" value="'.$litros.'">';
                        $html .= '</div>';

                        $html .= '<div class="col-md-2">';  
                         $html .= '<label>Importe:&nbsp;</label><br><input type="text" name="importe" class="form-control" value="'.$costo_total.'">';
                        $html .= '</div>';
                    $html .= '</div>';  

                    

                    $html .= '<div>';
                        $html .= '<input type="submit" class="btn btn-success" value="Aceptar">';

                        $html .= '<button class="btn btn-primary" id="cancelar_documento">&nbsp;Cancelar</button>';
                    $html .= '</div>'; 

                $html .= '</form>';
            $html .= '</div>';
        $html .= '</div>';

        $this->init('','principal_login',$html);

    }
}
