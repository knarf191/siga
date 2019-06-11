<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Editar_entrada_ornato extends CI_Controller {

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
            $cantidad = $this->input->post('cantidad');
            $precio_unitario = $this->input->post('precio_unitario');
            $importe = $cantidad*$precio_unitario;
            $data_post = array(
                'folio'        => $this->input->post('folio') ,
                'codigo'       => $this->input->post('codigo'), 
                'descripcion'  => $this->input->post('descripcion'),
                'departamento' => $this->input->post('departamento'),
                'cantidad'     => $this->input->post('cantidad'),
                'proveedor'    => $this->input->post('proveedor'),
                'documento'    => $this->input->post('documento'), 
                'costo'        => $importe,  
                'responsable'  => $this->input->post('responsable'),   
                'fecha'        => $this->input->post('fecha') ,    
            );

                $folio = $this->input->post('folio');

                

                $data_entrada     = $this->consultas->getEntradaOrnatoByFolio($folio);
                $cantidad_entrada = $data_entrada['cantidad'];

                $codigo = $this->input->post('codigo');
                $datastock = $this->consultas->getStockOrnatoByCodigo($codigo);

                
                $cantidad_stock     = $datastock['cantidad'];
               

                $cant_act = $cantidad_stock-$cantidad_entrada+$cantidad;

                $stock = $this->agregar->updateCantOrnatoStock($codigo,$cant_act);

                if ($stock) 
                {
                    $validation = $this->agregar->updateEntradaOrnato($folio, $data_post);
                    if ($validation) 
                    {   
                       echo '<script language="javascript">alert("Los datos se han actualizado correctamente");</script>';
                        redirect(base_url().'entradas_ornato','refresh'); 
                    }
                    else
                    {
                        echo '<script language="javascript">alert("No se han podido actualizar los datos, intente de nuevo");</script>';
                        redirect(base_url().'entradas_ornato','refresh');
                        
                    } 
                }              
        }
    }

    private function load()
    {
        $folio        = $_GET['folio'];
        $data         = $this->consultas->getEntradaOrnatoByFolio($folio);
        $codigo       = $data['codigo'];
        $descripcion  = $data['descripcion'];
        $departamento = $data['departamento'];
        $cantidad     = $data['cantidad'];
        $proveedor    = $data['proveedor'];
        $documento    = $data['documento'];
        $costo        = $data['costo'];
        $responsable  = $data['responsable'];
        $fecha        = $data['fecha'];

        $html = '';

        $html .= '<div class="page-header" ><h1>Editar entrada de artículos de limpieza y ornato</h1></div>'; 
            $html .= '<div class="span12">';
                $html .= '<form class="form-inline" action="'.base_url().'editar_entrada_ornato/editar" method="post">';
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
                            $html .= '<label>Responsable: &nbsp;</label><input type="text" class="form-control" name="responsable" required id="nombre_orden" value="'.$responsable.'">';
                            $html .= '<label>&nbsp;&nbsp;Código: &nbsp;</label><input type="text" class="form-control" name="codigo" required id="codigo" value="'.$codigo.'"><br>';
                            $html .= '<br><label>Documento: &nbsp;</label><input type="text" class="form-control" name="documento" required id="documento" value="'.$documento.'">';
                            $html .= '<label id="label_farmacia">Proveedor: &nbsp</label><input type="text" class="form-control" name="proveedor" required id="proveedor" value="'.$proveedor.'">';
                            $html .= '<label>Departamento: &nbsp</label><input type="text" class="form-control" name="departamento" required id="departamento_entrada" value="'.$departamento.'">';
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
                        $html .= '<div class="row" id="lista_refacciones">';
                            $html .= '<div class="col-md-10">';

                                $html .= '<table class="display data_table2" id="table_refacciones">';
                                    $html .= '<thead>';
                                        $html .= '<tr>';
                                            $html .= '<th>Cantidad</th>';
                                            $html .= '<th>Herramienta y/o material</th>';
                                            $html .= '<th>Precio Unitario</th>';
                                            $html .= '<th>Importe</th>';
                                            $html .= '<th></th>';
                                            $html .= '<th class="btnRefacciones"></th>';
                                        $html .= '</tr>';
                                    $html .= '</thead>';
                                    $html .= '<tbody>';
                                        $html .= '<tr>';
                                            $html .= '<td><input type="text" class="form-control" name="cantidad" id="cantidad_refacciones" value="'.$cantidad.'"></td>';
                                            $html .= '<td><input type="text" class="form-control"  name="descripcion" id="concepto_refacciones" value="'.$descripcion.'"></td>';

                                            $punit = $costo/$cantidad;
                                            $html .= '<td><input type="text" class="form-control"  name="precio_unitario" id="precio_unitario" value="'.$punit.'"></td>';


                                            $html .= '<td><input type="text" class="form-control"  name="costo" id="importe_refacciones" disabled value="'.$costo.'"></td>';                                            
                                        $html .= '</tr>';
                                    $html .= '</tbody>';
                                $html .= '</table>';  
                            $html .= '</div>'; 
                        $html .= '</div>'; 
                    $html .= '</div>';     

                    $html .= '<div>';
                        $html .= '<input type="submit" class="btn btn-success" value="Aceptar">';

                        $html .= '<button class="btn btn-primary" id="btnCancelINOrnato">&nbsp;Cancelar</button>';
                    $html .= '</div>'; 

                $html .= '</form>';
            $html .= '</div>';
        $html .= '</div>';

        $this->init('','principal_login',$html);

    }
}
