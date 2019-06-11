<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Editar_vale extends CI_Controller {

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

   function editar()
    {
        
        if ($this->input->post()) 
        {
            $folio = $this->input->post('folio');

            $data = array(  
            'folio'        => $this->input->post('folio'),
            'folio_asoc'   => $this->input->post('folio_asoc'),
            'fecha'        => $this->input->post('fecha'),
            'solicita'     => $this->input->post('solicita'),
            'chofer'       => $this->input->post('chofer'),
            'unidad'       => $this->input->post('unidad'),
            'no_econ'      => $this->input->post('no_econ'),
            'placas'       => $this->input->post('placas'),
            'litros'       => $this->input->post('litros'),
            'departamento' => $this->input->post('departamento'),
            'km'           => $this->input->post('km'),
            'gasolinera'   => $this->input->post('gasolinera'),
            'descripcion'  => $this->input->post('descripcion')      
            );

            /***********************************************************************
            Recuperar Saldo de acuerdo a la gasolina introducia al crear el vale
            ***********************************************************************/

            $data_back    = $this->consultas->getValesByFolio($folio);
            $litros_back       = $data_back['litros'];
            $descripcion_back  = $data_back['descripcion'];
            
            if ($descripcion_back=='Gasolina Magna') 
            {
                $precio = $litros_back *15.40;
            }
            elseif ($descripcion_back=='Diesel') 
            {
                $precio = $litros_back *16.48;
            }

            
            $saldo       = $this->consultas->getSaldo();
            foreach ($saldo as $key => $row) 
            {
                $id = $row->id;
                $saldo = $this->consultas->getRecargaByFolio($id);
                $saldo_disponible = $saldo['saldo_actual'];
            }

            $saldo_actual = $saldo_disponible+$precio;

            $actualizar_saldo = $this->agregar->updateSaldo($id,$saldo_actual);


            /***********************************************************************
                        Actualizacion de Datos
            ***********************************************************************/

            $descripcion = $this->input->post('descripcion');
            if ($descripcion=='Gasolina Magna') 
            {
                $precio = $this->input->post('litros')*15.40;
            }
            elseif ($descripcion=='Diesel') 
            {
                $precio = $this->input->post('litros')*16.48;
            }

            
            $saldo = $this->consultas->getSaldo();
            foreach ($saldo as $key => $row) 
            {
                $id = $row->id;
                $saldo = $this->consultas->getRecargaByFolio($id);
                $saldo_disponible = $saldo['saldo_actual'];
            }

            $saldo_actual = $saldo_disponible-$precio;
            $actualizar_saldo = $this->agregar->updateSaldo($id,$saldo_actual);

            $update = $this->agregar->updateVale($folio,$data);

            if($update)
            {   
                echo "true";         
            }
            else
            {
               echo "false";
            }   
        }   
    }

    private function load()
    {
        $folio        = $_GET['folio'];
        $data         = $this->consultas->getValesByFolio($folio);
        $folio_asoc   = $data['folio_asoc'];
        $fecha        = $data['fecha'];
        $solicita     = $data['solicita'];
        $chofer       = $data['chofer'];
        $unidad       = $data['unidad'];
        $no_econ      = $data['no_econ'];
        $placas       = $data['placas'];
        $litros       = $data['litros'];
        $departamento = $data['departamento'];
        $km           = $data['km'];
        $gasolinera   = $data['gasolinera'];
        $descripcion  = $data['descripcion'];
        
        $html = '';
        $html .= '<div class="page-header" ><h1>Editar Vale de Gasolina</h1></div>'; 
            $html .= '<div class="span12">';
                $html .= '<form class="form-inline" action="'.base_url().'editar_vale/editar" method="post" id="updateVale">';
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


                    $html .= '<div class="col-md-12" id="solicitante">';
                        $html .= '<br>';
                        $html .= '<div class="col-md-8">';
                            $html .= '<label>Nombre: &nbsp;</label><input type="text" class="form-control" name="solicita" required id="nombre" value="'.$solicita.'"><br>';
                            $html .= '<br><label>Departamento: &nbsp;</label><input type="text" class="form-control" name="departamento" value="'.$departamento.'" required id="departamento">';
                            $html .= ' &nbsp<label>Descripción:&nbsp; &nbsp;</label>
                                    <select class="form-control" name="descripcion" required value="'.$descripcion.'" id="descripcion">';
                                        if ($descripcion=='Gasolina Magna') 
                                        {
                                            $html .= '<option value="Gasolina Magna">Gasolina Magna</option>';
                                            $html .= '<option value="Diesel">Diesel</option>';
                                        }
                                        elseif ($descripcion=='Diesel') 
                                        {
                                            $html .= '<option value="Diesel">Diesel</option>';
                                            $html .= '<option value="Gasolina Magna">Gasolina Magna</option>';
                                        }
                                    $html .= '</select><br>';
                             $html .= '<br><label>Gasolinera: &nbsp</label><input type="text" class="form-control" name="gasolinera" value="'.$gasolinera.'" required id="gasolinera">';
                        $html .= '</div>';
                            
                        $html .= '<div class="col-md-4">';

                            $html .= '<label>Folio: &nbsp; &nbsp;</label><input type="text" value="'.$folio.'" name="folio" class="form-control" id="folio"><br>';             
                            $html .= '<br><label>Folio Asoc.: &nbsp; &nbsp;</label><input type="text" name="folio_asoc" class="form-control" value="'.$folio_asoc.'" id="folio_asoc"><br>';
                            $html .= '<br><label>Fecha: &nbsp</label><input type="date"  name="fecha" class="form-control" id="fecha_vale" value="'.$fecha.'">';
                        $html .= '</div>';
                    $html .= '</div>';  

                    /************************************************************************
                                            Datos del Vehiculo
                    ************************************************************************/

                    $html .= '<div class="col-md-12" id="titles">';
                        $html .= '<center><h4><b>Datos Generales del Vehículo</b></h4></center>';
                    $html .= '</div>';

                    $html .= '<div class="col-md-12">';
                        $html .= '<br>';
                        $html .= '<br>';
                        $html .= '<div class="col-md-4">';
                            $html .= '<label>Chofer: &nbsp</label><input type="text" class="form-control" name="chofer" required value="'.$chofer.'" id="chofer">';
                            
                        $html .= '</div>';

                        $html .= '<div class="col-md-4">';
                            $html .= '<label>Unidad: &nbsp; &nbsp;&nbsp; &nbsp;</label><input type="text" class="form-control" name="unidad"  value="'.$unidad.'" required id="unidad">';
                        $html .= '</div>';

                        $html .= '<div class="col-md-4">';
                            $html .= '<label>No. Economico: &nbsp</label><input type="text" class="form-control" name="no_econ" value="'.$no_econ.'" required id="no_econ">';
                        $html .= '</div>';
                    $html .= '</div>';   

                    $html .= '<div class="col-md-12">';
                        $html .= '<br>';
                        $html .= '<br>';
                        $html .= '<div class="col-md-4">';
                            $html .= '<label>Placas: &nbsp</label><input type="text" class="form-control" name="placas" value="'.$placas.'" required id="placas">';
                        $html .= '</div>';

                        $html .= '<div class="col-md-4">';
                            $html .= '<label>Litros: &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;</label><input type="text" class="form-control" name="litros" value="'.$litros.'" required id="litros">';
                        $html .= '</div>';

                        $html .= '<div class="col-md-4">';
                            $html .= '<label>K.M.: &nbsp; &nbsp;&nbsp;</label><input type="text" class="form-control" name="km" value="'.$km.'" required id="km">';
                        $html .= '</div>';
                    $html .= '</div>';     

                    $html .= '<div>';
                        $html .= '<a href="" type="submit" class="btn btn-success">Actualizar</a>';

                        $html .= '<button class="btn btn-primary" id="cancelar_vale">&nbsp;Cancelar</button>';
                    $html .= '</div>';     
                $html .= '</form>';
            $html .= '</div>';
        $html .= '</div>';        

        $this->init('','principal_login',$html);

    }
}