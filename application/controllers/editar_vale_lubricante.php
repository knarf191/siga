<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Editar_vale_lubricante extends CI_Controller {

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

           

          
            $cantidad = $this->input->post('cantidad_Lubricante');
            $concepto = $this->input->post('concepto_Lubricante');
            $p_unit   = $this->input->post('precio_unitario_lubricante');       

            $delete = $this->eliminar->deleteLubricantes($folio); 

            
            if ($delete) 
            {
                $validation             = $this->agregar->updateLubricante($folio,$data_post);
                $validation_lubricantes = $this->agregar->setLubricantes($folio,$cantidad,$concepto,$p_unit);

                if ($validation && $validation_lubricantes) 
                {
                    echo '<script language="javascript">alert("No se han podido cargar los datos, intente de nuevo");</script>';
                    redirect(base_url().'vales_lubricantes','refresh');
                }
                else
                {
                    echo '<script language="javascript">alert("Los datos se han actualizado correctamente");</script>';
                    redirect(base_url().'vales_lubricantes','refresh');  
                }  
            }    
        }
    }

    private function load()
    {
        $folio         = $_GET['folio'];
        $data          = $this->consultas->getValesLubricanteByFolio($folio);

        $solicita      = $data['solicita'];
        $chofer        = $data['chofer'];
        $fecha         = $data['fecha'];
        $departamento  = $data['departamento'];
        $vehiculo      = $data['vehiculo'];
        $placas        = $data['placas'];
        $econ          = $data['econ'];
        $refaccionaria = $data['refaccionaria'];

        $html = '';

        $html .= '<div class="page-header" ><h1>Editar Vale Aceites y/o Lubricantes</h1></div>'; 
            $html .= '<div class="span12">';
                $html .= '<form class="form-inline" action="'.base_url().'editar_vale_lubricante/editar" method="post">';
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
                             $html .= '<label>&nbsp;&nbsp;Departamento: &nbsp;</label><input type="text" class="form-control" name="departamento_Lubricante" required id="departamento_refacciones" value="'.$departamento.'">';
                        $html .= '</div>';

                            
                        $html .= '<div class="col-md-4">';

                             
                        $html .= '<label>Folio: &nbsp; &nbsp;</label><input type="text"  value="'.$folio.'" name="folio" class="form-control"><br>';
                            
                           
                        $html .= '</div>';
                    $html .= '</div>';  

                     $html .= '<div class="col-md-12" id="titles">';
                        $html .= '<div class="col-md-8">';
                            $html .= '<label>Chofer: &nbsp;</label><input type="text" class="form-control" name="chofer_Lubricante" required id="chofer_refacciones" value="'.$chofer.'">';
                             $html .= '<label>&nbsp;&nbsp;Vehiculo: &nbsp;</label><input type="text" class="form-control" name="vehiculo_Lubricante" required id="vehiculo_refacciones" value="'.$vehiculo.'">';
                        $html .= '</div>';

                        $html .= '<div class="col-md-4">';
                            $date = date("Y-m-d");
                            $html .= '<br><label>Fecha: &nbsp</label><input type="date"  name="fecha" class="form-control" id="fecha_nuevo_vale" value="'.$fecha.'">';
                        $html .= '</div>';
                    $html .= '</div>';

                    $html .= '<div class="col-md-12" id="titles_lubricantes">';
                        $html .= '<div class="col-md-4">';
                            $html .= '<label>Placas: &nbsp;</label><input type="text" class="form-control" name="placas_Lubricante" required id="placas_refacciones" value="'.$placas.'">';
                        $html .= '</div>';

                        $html .= '<div class="col-md-4">';
                            $html .= '<label>No. Econ: &nbsp;</label><input type="text" class="form-control" name="econ_Lubricante" required id="econ_refacciones" value="'.$econ.'">';
                        $html .= '</div>';

                        $html .= '<div class="col-md-4">';
                            $html .= '<label>Refaccionaria: &nbsp;</label><input type="text" class="form-control" name="refaccionaria" required id="refaccionaria" value="'.$refaccionaria.'">';
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
                                        $html .= '<th></th>';
                                        $html .= '<th class="btnRefacciones"></th>';
                                    $html .= '</tr>';
                                $html .= '</thead>';
                                $html .= '<tbody>';
                                   

                                    $data_lubricantes = $query = $this->db->query("SELECT * FROM lubricantes WHERE folio = '$folio' ");
                                    foreach ($data_lubricantes->result_array() as $row)
                                    {
                                        $html .= '<tr>';
                                            $html .= '<td><input type="text" class="form-control" name="cantidad_Lubricante[]" id="cantidad_Lubricante" value="'.$row['cantidad'].'"></td>';
                                            $html .= '<td><input type="text" class="form-control"  name="concepto_Lubricante[]" id="concepto_Lubricante" value="'.$row['concepto'].'"></td>';
                                             $html .= '<td><input type="text" class="form-control"  name="precio_unitario_lubricante[]" id="precio_unitario_lubricante" value="'.$row['p_unit'].'"></td>';
                                            $html .= '<td><input type="text" class="form-control"  name="importe_Lubricante[]" id="importe_Lubricante" disabled value="'.$row['importe'].'"></td>';
                                            $html .= '<td class="btnRefacciones"><i class="fa fa-plus-circle fa-lg" id="plusLubricante"></i></td>'; 
                                            $html .= '<td><i class="fa fa-minus-circle fa-lg" id="minusLubricante"></i></td>'; 
                                        $html .= '</tr>';
                                    }     
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
