<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Editar_recarga extends CI_Controller {

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
            $saldo = $this->consultas->getSaldo();

            $fecha = $this->input->post('fecha');

            foreach ($saldo as $key => $row) 
            {
                $folio = $row->id;
                $saldo = $this->consultas->getRecargaByFolio($folio);
                $saldo_anterior = $saldo['saldo_actual'];
                $saldo_abonado  = $saldo['recarga'];   
            }
            $recarga  = $this->input->post('recarga');
            $saldo_ant    = $saldo_anterior - $saldo_abonado;
            $personal = $this->input->post('personal'); 

            $saldo_actual = $saldo_ant + $recarga; 

            $id = $this->input->post('folio'); 

            $validation = $this->agregar->updateRecarga($id,$fecha, $saldo_ant,$recarga,$saldo_actual,$personal);

            if ($validation) 
            {
                echo '<script language="javascript">alert("Los datos se han actualizado correctamente");</script>';
                redirect(base_url().'recargas','refresh');
            }

            else
            {
                echo '<script language="javascript">alert("No se han podido actualizar los datos, intente de nuevo");</script>';
                redirect(base_url().'recargas','refresh');
            }     
        }
    }

    private function load()
    {
        $folio        = $_GET['folio'];
        $data         = $this->consultas->getRecargaByFolio($folio);
        $fecha        = $data['fecha'];
        $solicita     = $data['personal'];
        $recarga      = $data['recarga'];

        $html = '';

        $html .= '<div class="page-header" ><h1>Nueva Recarga de Saldo</h1></div>'; 
            $html .= '<div class="span12">';
                $html .= '<form class="form-inline" action="'.base_url().'editar_recarga/editar" method="post">';
                    /************************************************************************
                                            Solicitante, Fecha y Folio
                    ************************************************************************/
                    $html .= '<div class="col-md-12" id="titles">';
                        $html .= '<div class="col-md-8">';
                            $html .= '<center><h4><b>Responsable de la recarga</b></h4></center>';
                        $html .= '</div>';

                        $html .= '<div class="col-md-4">';
                            $html .= '<center><h4><b>Fecha y Folio</b></h4><center>';
                        $html .= '</div>';
                    $html .= '</div>';


                    $html .= '<div class="col-md-12" id="solicitante">';
                        $html .= '<br>';
                        $html .= '<div class="col-md-8">';
                            $html .= '<label>Nombre: &nbsp;</label><input type="text" class="form-control" name="personal" required id="nombre" value="'.$solicita.'"><br>';

                            $html .= '<br><label>Saldo a recargar: &nbsp;</label><input type="text" class="form-control" name="recarga" required value="'.$recarga.'">';
                        $html .= '</div>';
                            
                        $html .= '<div class="col-md-4">';
 
                            $html .= '<label>Folio: &nbsp; &nbsp;</label><input type="text" value="'.$folio.'" name="folio" class="form-control" ><br>';

                            $html .= '<br><label>Fecha: &nbsp</label><input type="date"  name="fecha" class="form-control" id="fecha_nuevo_vale" value="'.$fecha.'">';
                        $html .= '</div>';
                    $html .= '</div>';  

                    
                    $html .= '<div>';
                        $html .= '<input type="submit" class="btn btn-success" value="Aceptar">';

                        $html .= '<button class="btn btn-primary" id="cancelar_recarga">&nbsp;Cancelar</button>';
                    $html .= '</div>';     
                $html .= '</form>';
            $html .= '</div>';
        $html .= '</div>';

        $this->init('','principal_login',$html);

    }
}
