<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Editar_solicitud_refacciones extends CI_Controller {

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
            $data = array(
                'folio'         => $this->input->post('folio') ,
                'solicita'      => $this->input->post('solicita'),
                'chofer'        => $this->input->post('chofer_refacciones') , 
                'fecha'         => $this->input->post('fecha') ,
                'departamento'  => $this->input->post('departamento_refacciones'),     
                'vehiculo'      => $this->input->post('vehiculo_refacciones'),
                'placas'        => $this->input->post('placas_refacciones') ,
                'econ'          => $this->input->post('econ_refacciones') ,
                'refaccionaria' => $this->input->post('refaccionaria') , 
                'estatus'       => $this->input->post('estatus_refacciones') ,       
            );      

           

          
            $cantidad = $this->input->post('cantidad_refacciones');
            $concepto = $this->input->post('concepto_refacciones') ; 
            $p_unit   = $this->input->post('precio_unitario');

            $delete = $this->eliminar->deleteRefacciones($folio); 

            
            if ($delete) 
            {
                $validation             = $this->agregar->updateSolicitudRefacciones($folio,$data);
                $validation_refacciones = $this->agregar->setRefacciones($folio,$cantidad,$concepto,$p_unit);

                if ($validation && $validation_refacciones) 
                {
                    echo '<script language="javascript">alert("No se han podido cargar los datos, intente de nuevo");</script>';
                    redirect(base_url().'refacciones','refresh');
                }
                else
                {
                    echo '<script language="javascript">alert("Los datos se han actualizado correctamente");</script>';
                    redirect(base_url().'refacciones','refresh');  
                }  
            }    
        }
    }

    private function load()
    {
        $folio         = $_GET['folio'];
        $data          = $this->consultas->getSolicitudByFolio($folio);

        $solicita      = $data['solicita'];
        $chofer        = $data['chofer'];
        $fecha         = $data['fecha'];
        $departamento  = $data['departamento'];
        $vehiculo      = $data['vehiculo'];
        $placas        = $data['placas'];
        $econ          = $data['econ'];
        $refaccionaria = $data['refaccionaria'];
        $estatus       = $data['estatus'];

        $html = '';

        $html .= '<div class="page-header" ><h1>Editar Solicitud de Refacciones</h1></div>'; 
            $html .= '<div class="span12">';
                $html .= '<form class="form-inline" action="'.base_url().'editar_solicitud_refacciones/editar" method="post">';
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
                            $html .= '<label>Nombre: &nbsp;</label><input type="text" class="form-control" name="solicita" required id="nombre_refacciones" value="'.$solicita.'">';
                             $html .= '<label>&nbsp;&nbsp;Departamento: &nbsp;</label><input type="text" class="form-control" name="departamento_refacciones" required id="departamento_refacciones" value="'.$departamento.'">';
                        $html .= '</div>';

                            
                        $html .= '<div class="col-md-4">';

 
                        $html .= '<label>Folio: &nbsp; &nbsp;</label><input type="text"  value="'.$folio.'" name="folio" class="form-control" ><br>';
                            
                           
                        $html .= '</div>';
                    $html .= '</div>';  

                     $html .= '<div class="col-md-12" id="titles">';
                        $html .= '<div class="col-md-8">';
                            $html .= '<label>Chofer: &nbsp;</label><input type="text" class="form-control" name="chofer_refacciones" required id="chofer_refacciones" value="'.$chofer.'">';
                             $html .= '<label>&nbsp;&nbsp;Vehiculo: &nbsp;</label><input type="text" class="form-control" name="vehiculo_refacciones" required id="vehiculo_refacciones" value="'.$vehiculo.'">';
                        $html .= '</div>';

                        $html .= '<div class="col-md-4">';
                            
                            $html .= '<br><label>Fecha: &nbsp</label><input type="date"  name="fecha" class="form-control" id="fecha_nuevo_vale" value="'.$fecha.'">';
                        $html .= '</div>';
                    $html .= '</div>';

                    $html .= '<div class="col-md-12" id="titles_refacciones">';
                        $html .= '<div class="col-md-3">';
                            $html .= '<label>Placas: &nbsp;</label><input type="text" class="form-control" name="placas_refacciones" required id="placas_refacciones" value="'.$placas.'">';
                        $html .= '</div>';

                        $html .= '<div class="col-md-3">';
                            $html .= '<label>No. Econ: &nbsp;</label><input type="text" class="form-control" name="econ_refacciones" required id="econ_refacciones" value="'.$econ.'">';
                        $html .= '</div>';

                        $html .= '<div class="col-md-3">';
                            $html .= '<label>Refaccionaria: &nbsp;</label><input type="text" class="form-control" name="refaccionaria" required id="refaccionaria" value="'.$refaccionaria.'">';
                        $html .= '</div>';

                        $html .= '<div class="col-md-3">';
                            $html .= '<label>Estatus: &nbsp; &nbsp;&nbsp; &nbsp;</label>
                                    <select class="form-control" name="estatus_refacciones" required value="'.$estatus.'">';
                                    if($estatus=="Pendiente")
                                    {
                                        $html .= '<option value="Pendiente">Pendiente</option>
                                        <option value="Entregado">Entregado</option>';
                                    }
                                    elseif ($estatus=="Entregado") 
                                    {
                                        $html .= '<option value="Entregado">Entregado</option>
                                        <option value="Pendiente">Pendiente</option>';
                                    }    
                                     $html .= '</select>';
                        $html .= '</div>'; 
                    $html .= '</div>';

                    /************************************************************************
                                            Refacciones a Solicitar
                    ************************************************************************/
                    $html .= '<div class="col-md-12" id="titles">';
                        $html .= '<center><h4><b>Refacciones Solicitadas</b></h4></center>';
                    $html .= '</div>';

                    $html .= '<div class="row" id="lista_refacciones">';
                        $html .= '<div class="col-md-10">';

                            $html .= '<table class="display data_table2" id="table_refacciones">';
                                $html .= '<thead>';
                                    $html .= '<tr>';
                                        $html .= '<th>Cantidad</th>';
                                        $html .= '<th>Concepto</th>';
                                        $html .= '<th>Precio Unitario</th>';
                                        $html .= '<th>Importe</th>';
                                        $html .= '<th></th>';
                                        $html .= '<th class="btnRefacciones"></th>';
                                    $html .= '</tr>';
                                $html .= '</thead>';
                                $html .= '<tbody>';

                                    $data_refacciones = $query = $this->db->query("SELECT * FROM refacciones WHERE folio = '$folio' ");
                                    foreach ($data_refacciones->result_array() as $row)
                                    {
                                        $html .= '<tr>';
                                            $html .= '<td><input type="text" class="form-control" name="cantidad_refacciones[]" id="cantidad_refacciones" value="'.$row['cantidad'].'"></td>';
                                            $html .= '<td><input type="text" class="form-control"  name="concepto_refacciones[]" id="concepto_refacciones" value="'.$row['concepto'].'"></td>';
                                            $html .= '<td><input type="text" class="form-control"  name="precio_unitario[]" id="precio_unitario" value="'.$row['p_unit'].'"></td>';
                                            $html .= '<td><input type="text" class="form-control"  name="importe_refacciones[]" id="importe_refacciones" disabled value="'.$row['importe'].'"></td>';
                                            $html .= '<td class="btnRefacciones"><i class="fa fa-plus-circle fa-lg" id="plusCeld"></i></td>'; 
                                            $html .= '<td><i class="fa fa-minus-circle fa-lg" id="minusCeld"></i></td>'; 
                                        $html .= '</tr>';
                                    }                                        
                                $html .= '</tbody>';
                            $html .= '</table>'; 

                            /*$html .= '<div class="importe_total">';
                                $html .= '<label>Importe Total:&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; $ &nbsp;<input class="form-control" id="total_refacciones" disabled></input>&nbsp;&nbsp;</label>';
                            $html .= '</div>';  */  
                        $html .= '</div>';
                    $html .= '</div>';

                    $html .= '<div>';
                        $html .= '<input type="submit" class="btn btn-success" value="Aceptar">';

                        $html .= '<button class="btn btn-primary" id="cancelar_solicitud">&nbsp;Cancelar</button>';
                    $html .= '</div>';     
                $html .= '</form>';
            $html .= '</div>';
        $html .= '</div>';

        $this->init('','principal_login',$html);

    }
}
