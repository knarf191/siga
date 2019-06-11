<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Nueva_entrada_computo extends CI_Controller {

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
            $descripcion = $this->input->post('descripcion');
            $instock = $this->consultas->getStockComputoByName($descripcion);

            if ($instock == "TRUE") 
            {
                $cantidad = $this->input->post('cantidad');
                $precio_unitario = $this->input->post('precio_unitario');
                $importe = $cantidad*$precio_unitario;
                $data_post = array(
                    'folio'        => $this->input->post('folio') ,
                    'codigo'       => $this->input->post('codigo'), 
                    'descripcion'  => $this->input->post('descripcion'),
                    'unidad'       => $this->input->post('unidad'),
                    'departamento' => $this->input->post('departamento'),
                    'cantidad'     => $this->input->post('cantidad'),
                    'proveedor'    => $this->input->post('proveedor'),
                    'documento'    => $this->input->post('documento'), 
                    'costo'        => $importe,  
                    'responsable'  => $this->input->post('responsable'),   
                    'fecha'        => $this->input->post('fecha') ,    
                );
                $stock = $this->consultas->getFolioStockComputo();

                foreach ($stock as $key => $field) 
                {
                    $folio_stock = $field->id;

                    if ($folio_stock==0) 
                    {
                        $folio_stock=1;
                    } 
                }

                $data_stock = array(
                    'id'        => $folio_stock ,
                    'codigo'       => $this->input->post('codigo'), 
                    'descripcion'  => $this->input->post('descripcion'),
                    'unidad'       => $this->input->post('unidad'),
                    'cantidad'     => $this->input->post('cantidad'),
                    'departamento' => $this->input->post('departamento'),
                );


                $validation = $this->agregar->setEntradaComputo($data_post);

                $codigo = $this->input->post('codigo');

                $datastock = $this->consultas->getStockComputoByCodigo($codigo);

                $id_stock           = $datastock['id'];
                $codigo_stock       = $datastock['codigo'];
                $descripcion_stock  = $datastock['descripcion'];
                $unidad_stock       = $datastock['unidad'];
                $cantidad_stock     = $datastock['cantidad'];
                $departamento_stock = $datastock['departamento'];

                $cant_actual = $cantidad_stock+$cantidad;

                $stock = $this->agregar->updateStockComputoByCode($id_stock,$codigo_stock,$descripcion_stock,$unidad_stock,$cant_actual,$departamento_stock);

                if ($validation) 
                {   
                   echo '<script language="javascript">alert("Los datos se han agregado correctamente");</script>';
                    redirect(base_url().'stock_computo','refresh'); 
                }
                else
                {
                    echo '<script language="javascript">alert("No se han podido cargar los datos, intente de nuevo");</script>';
                    redirect(base_url().'Nueva_entrada_computo','refresh');  
                } 
                
            }
            else
            {
                $cantidad = $this->input->post('cantidad');
                $precio_unitario = $this->input->post('precio_unitario');
                $importe = $cantidad*$precio_unitario;
                $data_post = array(
                    'folio'        => $this->input->post('folio') ,
                    'codigo'       => $this->input->post('codigo'), 
                    'descripcion'  => $this->input->post('descripcion'),
                    'unidad'       => $this->input->post('unidad'),
                    'departamento' => $this->input->post('departamento'),
                    'cantidad'     => $this->input->post('cantidad'),
                    'proveedor'    => $this->input->post('proveedor'),
                    'documento'    => $this->input->post('documento'), 
                    'costo'        => $importe,  
                    'responsable'  => $this->input->post('responsable'),   
                    'fecha'        => $this->input->post('fecha') ,    
                );
                $stock = $this->consultas->getFolioStockComputo();

                foreach ($stock as $key => $field) 
                {
                    $folio_stock = $field->id;

                    if ($folio_stock==0) 
                    {
                        $folio_stock=1;
                    } 
                }

                $data_stock = array(
                    'id'        => $folio_stock ,
                    'codigo'       => $this->input->post('codigo'), 
                    'descripcion'  => $this->input->post('descripcion'),
                    'unidad'       => $this->input->post('unidad'),
                    'cantidad'     => $this->input->post('cantidad'),
                    'departamento' => $this->input->post('departamento'),
                );


                $validation = $this->agregar->setEntradaComputo($data_post);

                $stock = $this->agregar->setStockComputo($data_stock);

                if($validation)
                {   
                   echo '<script language="javascript">alert("Los datos se han agregado correctamente");</script>';
                    redirect(base_url().'stock_computo','refresh'); 
                }
                else
                {
                    echo '<script language="javascript">alert("No se han podido cargar los datos, intente de nuevo");</script>';
                    redirect(base_url().'Nueva_entrada_computo','refresh');  
                }
            }          
        }
    }

    private function load()
    {
        $data = $this->consultas->getFolioEntradaComputo();

        $html = '';

        $html .= '<div class="page-header" ><h1>Entrada de artículos computo</h1></div>'; 
            $html .= '<div class="span12">';
                $html .= '<form class="form-inline" action="'.base_url().'nueva_entrada_computo/agregar" method="post">';
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
                            $html .= '<label>Responsable: &nbsp;</label><input type="text" class="form-control" name="responsable" required id="nombre_orden">';
                            $html .= '<label>&nbsp;&nbsp;Código: &nbsp;</label><input type="text" class="form-control" name="codigo" required id="codigo_entrada_computo"><br>';
                            $html .= '<br><label>Documento: &nbsp;</label><input type="text" class="form-control" name="documento" required id="documento">';
                            $html .= '<label id="label_farmacia">Proveedor: &nbsp</label><input type="text" class="form-control" name="proveedor" required id="proveedor">';
                            $html .= '<label>Departamento: &nbsp</label><input type="text" class="form-control" name="departamento" required id="departamento_entrada">';
                        $html .= '</div>';
                            
                        $html .= '<div class="col-md-4">';

                            foreach ($data as $key => $row) 
                            {
                                $folio = $row->folio;

                                if ($folio==0) 
                                {
                                    $folio=1;
                                } 
                                $html .= '<label>Folio: &nbsp; &nbsp;</label><input type="text"  value="'.$folio.'" name="folio" class="form-control" disabled><br>';
                            }
                           

                            $date = date("Y-m-d");
                            $html .= '<br><label>Fecha: &nbsp</label><input type="date"  name="fecha" class="form-control" id="fecha_nuevo_vale" value="'.$date.'">';
                        $html .= '</div>';
                    $html .= '</div>';  

                    /************************************************************************
                                            Medicamentos
                    ************************************************************************/

                    $html .= '<div class="col-md-12" id="titles">';
                        $html .= '<center><h4><b>Artículo a ingresar</b></h4></center>';
                    $html .= '</div>';

                    

                    $html .= '<div class="col-md-12">';
                        $html .= '<div class="row" id="lista_salida">';
                            $html .= '<div class="col-md-11">';

                                $html .= '<table class="display data_table2" id="table_refacciones">';
                                    $html .= '<thead>';
                                        $html .= '<tr>';
                                            $html .= '<th>Cantidad</th>';
                                            $html .= '<th>Descripción y/o Concepto</th>';
                                            $html .= '<th>Unidad</th>';
                                            $html .= '<th>Precio Unitario</th>';
                                            $html .= '<th>Importe</th>';
                                        $html .= '</tr>';
                                    $html .= '</thead>';
                                    $html .= '<tbody>';
                                        $html .= '<tr>';
                                            $html .= '<td><input type="text" class="form-control" name="cantidad" id="cantidad_refacciones" ></td>';
                                            $html .= '<td><input type="text" class="form-control"  name="descripcion" id="concepto_entrada_computo"></td>';
                                            $html .= '<td><input type="text" class="form-control"  name="unidad" id="cantidad_refacciones"></td>';
                                            $html .= '<td><input type="text" class="form-control"  name="precio_unitario" id="precio_unitario"></td>';
                                            $html .= '<td><input type="text" class="form-control"  name="costo" id="importe_refacciones" disabled></td>';                                            
                                        $html .= '</tr>';
                                    $html .= '</tbody>';
                                $html .= '</table>';  
                            $html .= '</div>'; 
                        $html .= '</div>'; 
                    $html .= '</div>';     

                    $html .= '<div>';
                        $html .= '<input type="submit" class="btn btn-success" value="Aceptar">';

                        $html .= '<button class="btn btn-primary" id="btnCancelINCoputo">&nbsp;Cancelar</button>';
                    $html .= '</div>'; 

                $html .= '</form>';
            $html .= '</div>';
        $html .= '</div>';

        $this->init('','principal_login',$html);

    }
}
