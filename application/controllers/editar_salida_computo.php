<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Editar_salida_computo extends CI_Controller {

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
            $folio        = $this->input->post('folio');
            $fecha        = $this->input->post('fecha');  
            $solicita     = $this->input->post('solicita'); 
            $departamento = $this->input->post('departamento');
                  
           
            $validation = $this->agregar->updateSalidaComputo($folio,$fecha,$solicita,$departamento);

            $codigo      = $this->input->post('codigo');
            $descripcion = $this->input->post('descripcion') ; 
            $cantidad    = $this->input->post('cantidad');  

          
                for ($i=0; $i < count($codigo); $i++) 
                { 
                   $query = $this->db->query("SELECT *FROM stock_computo WHERE codigo ='".$codigo[$i]."'");
                   $data = $query->row_array();

                   $query2 = $this->db->query("SELECT * FROM material_salida_computo WHERE id = '$folio' AND codigo='".$codigo[$i]."'");
                   $data2 = $query2->row_array();

                   $update = $data['cantidad']+$data2['cantidad'];

                   $update  = $this->agregar->updateStockComputo($codigo[$i],$update);
                }
            

             

            
            $delete_tools = $this->eliminar->deleteMaterialComputo($folio);

            $validation_tools = $this->agregar->setSalidaMaterialComputo($folio, $codigo, $descripcion, $cantidad);




            if ($validation && $validation_tools) 
            {   
                echo '<script language="javascript">alert("No se han podido modificar los datos, intente de nuevo");</script>';
                redirect(base_url().'salidas_computo','refresh');
            }
            else
            {
                for ($i=0; $i < count($codigo); $i++) 
                { 
                   $query = $this->db->query("SELECT *FROM stock_computo WHERE codigo ='".$codigo[$i]."'");
                   $data = $query->row_array();
                   $update = $data['cantidad']-$cantidad[$i];

                   $update  = $this->agregar->updateStockComputo($codigo[$i],$update);
                }

                echo '<script language="javascript">alert("Los datos se han modificado correctamente");</script>';
                redirect(base_url().'salidas_computo','refresh'); 
            }                   
        }
    }


    private function load()
    {
        $folio        = $_GET['folio'];
        $data         = $this->consultas->getSalidaComputoByFolio($folio);
        $fecha        = $data['fecha'];
        $solicita     = $data['solicita'];
        $departamento = $data['departamento'];
        

        $html = '';

        $html .= '<div class="page-header" ><h1>Editar salida de artículos de cómputo</h1></div>'; 
            $html .= '<div class="span12">';
                $html .= '<form class="form-inline" action="'.base_url().'editar_salida_computo/editar" method="post">';
                    /************************************************************************
                                            Solicitante, Fecha y Folio
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
                            $html .= '<label>Solicita: &nbsp;</label><input type="text" class="form-control" name="solicita" required id="nombre_orden" value="'.$solicita.'">';
                            $html .= '<br><br><label>Departamento: &nbsp;</label><input type="text" class="form-control" name="departamento" required id="documento" value="'.$departamento.'">';
                        $html .= '</div>';
                            
                        $html .= '<div class="col-md-4">';

                         
                            $html .= '<label>Folio: &nbsp; &nbsp;</label><input type="text"  value="'.$folio.'" name="folio" class="form-control"><br>';

                            $html .= '<br><label>Fecha: &nbsp</label><input type="date"  name="fecha" class="form-control" id="fecha_nuevo_vale" value="'.$fecha.'">';
                        $html .= '</div>';
                    $html .= '</div>';  

                    /************************************************************************
                                            Medicamentos
                    ************************************************************************/

                    $html .= '<div class="col-md-12" id="titles">';
                        $html .= '<center><h4><b>Material y/o herramienta</b></h4></center>';
                    $html .= '</div>';

                    

                    $html .= '<div class="col-md-12">';
                        $html .= '<div class="row" id="lista_salida">';
                            $html .= '<div class="col-md-11">';

                                $html .= '<table class="display data_table2" id="table_Outs">';
                                    $html .= '<thead>';
                                        $html .= '<tr>';
                                            $html .= '<th>Codigo</th>';
                                            $html .= '<th>Descripción</th>';
                                            $html .= '<th>Cantidad disponible</th>';
                                            $html .= '<th>Cantidad Solicitada</th>';
                                            $html .= '<th class="btnRefacciones"></th>';
                                        $html .= '</tr>';
                                    $html .= '</thead>';
                                    $html .= '<tbody>';

                                    $data_material = $query = $this->db->query("SELECT * FROM material_salida_computo WHERE id = '".$folio."' ");
                                    foreach ($data_material->result_array() as $row)
                                    {
                                        $html .= '<tr>';
                                            $html .= '<td><input type="text" class="form-control" name="codigo[]" id="codigo_salida" value="'.$row['codigo'].'"></td>';

                                            $html .= '<td><input type="text" class="form-control" name="descripcion[]" id="descripcion_salida" value="'.$row['descripcion'].'"></td>';
                                       
                                            $search = $this->db->query("SELECT * FROM stock_computo WHERE codigo = '".$row['codigo']."'");

                                            foreach ($search->result_array() as $ident)
                                            {
                                                $html .= '<td><input type="text" class="form-control" id="cantidad_salida" disabled value="'.$ident['cantidad'].'"></td>';
                                            }
                                            
                                            $html .= '<td><input type="text" class="form-control" name="cantidad[]" id="cantidad_solicitada" value="'.$row['cantidad'].'"></td>';    
                                            $html .= '<td class="btnRefacciones"><i class="fa fa-plus-circle fa-lg" id="plusOutOrnato"></i></td>';                                        
                                        $html .= '</tr>';
                                    }
                                    $html .= '</tbody>';
                                $html .= '</table>'; 
                                $html .= '<input type="hidden" id="producto">'; 
                                $html .= '<input type="hidden" id="cantidad_sol">'; 
                            $html .= '</div>'; 
                        $html .= '</div>'; 
                    $html .= '</div>';     

                    $html .= '<div>';
                        $html .= '<input type="submit" class="btn btn-success" value="Aceptar">';

                        $html .= '<button class="btn btn-primary" id="btnCancelOUTComputo">&nbsp;Cancelar</button>';
                    $html .= '</div>'; 

                $html .= '</form>';
            $html .= '</div>';
        $html .= '</div>';

        $this->init('','principal_login',$html);

    }
}
