<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Edit_orden_medica extends CI_Controller {

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
            $folio = $this->input->post('folio');
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

            $validation = $this->agregar->updateOrdenMedica($folio,$data_post);

            if ($validation) 
            {
                echo 'true';
            }

            else
            {
                echo 'false';
            }       
        }
    }

    private function load()
    {
        $folio        = $_GET['folio'];
        $data         = $this->consultas->getOrdenMedicaByFolio($folio);
        $fecha        = $data['fecha'];
        $solicita     = $data['solicita'];
        $ficha        = $data['ficha'];
        $categoria    = $data['categoria'];
        $contrato     = $data['contrato'];
        $personal     = $data['personal'];
        $beneficiario = $data['beneficiario'];
        $departamento = $data['departamento'];
        $parentesco   = $data['parentesco'];

        $html = '';

        $html .= '<div class="page-header" ><h1>Editar Orden Médica</h1></div>'; 
            $html .= '<div class="span12">';
                $html .= '<form class="form-inline" action="'.base_url().'Edit_orden_medica/editar" method="post" id="updateOrdenMedica">';
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
                            $html .= '<label>Nombre: &nbsp;</label><input type="text" class="form-control" name="solicita" required id="nombre_orden" value="'.$solicita.'">';
                             $html .= '<label>&nbsp;&nbsp;Ficha: &nbsp;</label><input type="text" class="form-control" name="ficha" required id="ficha" value="'.$ficha.'">';
                        $html .= '</div>';
                            
                        $html .= '<div class="col-md-4">';
                            $html .= '<label>Folio: &nbsp; &nbsp;</label><input type="text"  value="'.$folio.'" name="folio" class="form-control" disabled id="folio_orden"><br>';
                            
                            $html .= '<br><label>Fecha: &nbsp</label><input type="date"  name="fecha" class="form-control" id="fecha_orden" value="'.$fecha.'">';    
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
                            $html .= '<label>Categoría: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label><input type="text" class="form-control" name="categoria" required value="'.$categoria.'" id="categoria">';
                        $html .= '</div>';

                        $html .= '<div class="col-md-4">';
                            $html .= '<label>Contrato: &nbsp; &nbsp;&nbsp; &nbsp;</label>';
                                $html .= '<select class="form-control" name="contrato" required id="contrato" value="'.$contrato.'">
                                    <option value="'.$contrato.'" selected disabled>'.$contrato.'</option>
                                    <option value="Planta">Planta</option>
                                    <option value="Eventual">Eventual</option>
                                </select>';
                        $html .= '</div>';

                        $html .= '<div class="col-md-4">';
                            $html .= '<label>Tipo de Personal: &nbsp</label><input type="text" class="form-control" name="personal" required value="'.$personal.'" id="personal">';
                        $html .= '</div>';
                    $html .= '</div>';   

                    $html .= '<div class="col-md-12">';
                        $html .= '<br>';
                        $html .= '<br>';
                        $html .= '<div class="col-md-4">';
                            $html .= '<label>Beneficiario: &nbsp</label><input type="text" class="form-control" name="beneficiario" required value="'.$beneficiario.'" id="beneficiario">';
                        $html .= '</div>';

                        $html .= '<div class="col-md-4">';
                            $html .= '<label>Parentesco:&nbsp;&nbsp;&nbsp;</label><input type="text" class="form-control" name="parentesco" required value="'.$parentesco.'" id="parentesco">';
                        $html .= '</div>';

                        $html .= '<div class="col-md-4">';
                            $html .= '<label>Departamento: &nbsp; &nbsp;&nbsp; &nbsp;</label><input type="text" class="form-control" name="departamento" required value="'.$departamento.'" id="departamento_orden">';
                        $html .= '</div>';
                    $html .= '</div>';     

                    $html .= '<div>';
                        $html .= '<input type="submit" class="btn btn-success" value="Aceptar" id="btnUpdateOrden">';

                        $html .= '<button class="btn btn-primary" id="btnCancelOrden">&nbsp;Cancelar</button>';
                    $html .= '</div>';     
                $html .= '</form>';
            $html .= '</div>';
        $html .= '</div>';

        $this->init('','principal_login',$html);

    }
}
