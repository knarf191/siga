<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Nueva_salida_computo extends CI_Controller {

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
            $folio       = $this->input->post('folio');
            $data = array(
                'folio'        => $this->input->post('folio') ,
                'fecha'        => $this->input->post('fecha') ,  
                'solicita'     => $this->input->post('solicita'), 
                'departamento' => $this->input->post('departamento'),
                  
            );
            $validation = $this->agregar->setSalidaComputo($data);

            $codigo      = $this->input->post('codigo');
            $descripcion = $this->input->post('descripcion') ; 
            $cantidad    = $this->input->post('cantidad');   

            


            $validation_tools = $this->agregar->setSalidaMaterialComputo($folio, $codigo, $descripcion, $cantidad);


            if ($validation && $validation_tools) 
            {   
                echo '<script language="javascript">alert("No se han podido cargar los datos, intente de nuevo");</script>';
                redirect(base_url().'salidas_computo','refresh');
            }
            else
            {
                for ($i=0; $i < count($codigo); $i++) 
                { 
                   $query = $this->db->query("SELECT *FROM stock_computo WHERE codigo = '".$codigo[$i]."'");
                   $data = $query->row_array();
                   $update = $data['cantidad']-$cantidad[$i];

                   $update  = $this->agregar->updateStockComputo($codigo[$i],$update);
                }

                $data = $this->consultas->getFolioOUTOrnato();

                foreach ($data as $key => $row) 
                {
                    $folio = $row->folio;

                    if ($folio==0) 
                    {
                        $folio=1;
                    }   
                }

                echo '<script language="javascript">alert("Los datos se han agregado correctamente");</script>';
                redirect(base_url().'vista_previa_salida_computo?folio='.$folio,'refresh'); 
            }                   
        }
    }


    private function load()
    {
        $data = $this->consultas->getFolioSalidaComputo();

        $html = '';

        $html .= '<div class="page-header" ><h1>Salida de artículos de cómputo</h1></div>'; 
            $html .= '<div class="span12">';
                $html .= '<form class="form-inline" action="'.base_url().'nueva_salida_computo/agregar" method="post">';
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
                            $html .= '<label>Solicita: &nbsp;</label><input type="text" class="form-control" name="solicita" required id="nombre_orden">';
                            $html .= '<br><br><label>Departamento: &nbsp;</label><input type="text" class="form-control" name="departamento" required id="documento">';
                        $html .= '</div>';
                            
                        $html .= '<div class="col-md-4">';

                            foreach ($data as $key => $row) 
                            {
                                $folio = $row->folio;

                                if ($folio==0) 
                                {
                                    $folio=1;
                                } 
                                $html .= '<label>Folio: &nbsp; &nbsp;</label><input type="text"  value="'.$folio.'" name="folio" class="form-control"><br>';
                            }
                           

                            $date = date("Y-m-d");
                            $html .= '<br><label>Fecha: &nbsp</label><input type="date"  name="fecha" class="form-control" id="fecha_nuevo_vale" value="'.$date.'">';
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

                                $html .= '<table class="display data_table2" id="table_OutsComputo">';
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
                                        $html .= '<tr>';
                                            $html .= '<td><input type="text" class="form-control" name="codigo[]" id="codigo_salida_computo"></td>';

                                            $html .= '<td><input type="text" class="form-control" name="descripcion[]" id="descripcion_salida"></td>';
                                       
                                            $html .= '<td><input type="text" class="form-control" id="cantidad_salida_computo" disabled></td>';
                                            $html .= '<td><input type="text" class="form-control" name="cantidad[]" id="cantidad_solicitada_computo"></td>';    
                                            $html .= '<td class="btnRefacciones"><i class="fa fa-plus-circle fa-lg" id="plusOutComputo"></i></td>';                                        
                                        $html .= '</tr>';
                                    $html .= '</tbody>';
                                $html .= '</table>'; 
                                $html .= '<input type="hidden" id="producto">'; 
                                $html .= '<input type="hidden" id="cantidad_sol_computo">'; 
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
