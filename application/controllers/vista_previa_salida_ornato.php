<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vista_previa_salida_ornato extends CI_Controller {

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

    private function load()
    {
        $folio     = $_GET['folio'];
        $data      = $this->consultas->getSalidaOrnatoByFolio($folio);
        $fecha     = $data['fecha'];
        $solicita  = $data['solicita'];
        $departamento = $data['departamento'];


        $html = '';
            $html .= '<div class="span12">';
                $html .= '<div class="col-md-12">';

                    $html .= '<div class="col-md-2" id="logo_header">';
                        $html .= '<img src="img/logo_jaltipan.png" id="logo">';
                    $html .= '</div>';

                    $html .= '<div clss="col-md-10" id="vale_header">';
                        $html .= '<div class="title_header"><b>H. AYUNTAMIENTO CONSTITUCIONAL</b></div>';
                        $html .= '<h4><b>JALTIPAN DE MORELOS, VERACRUZ</b></h4 >';
                        $html .= '<h5><b>TRIENIO 2014 - 2017</b></h5 >';
                    $html .= '</div>';
                $html .= '</div>';
            $html .= '</div>';

            $html .= '<div class="title_refacciones"><b>ENTREGA DE MATERIAL</b></div>';


            $html .= '<div >';
                $html .= '<table id="printOrden">';
                    $html .= '<thead></thead>';
                    $html .= '<tbody>';
                        $html .= '<tr>';
                            $html .= '<td></td>';
                            $html .= '<td></td>';
                            $html .= '<td class="spaceVale"></td>';
                            $html .= '<td class="spaceVale"></td>';
                            $html .= '<td ><center><b>FOLIO:</b></center></td>';
                            if ($folio<10) 
                            {
                                $html .= '<td class="contentTitlePrintVale"><center id="folioPrintVale"><b>0000'.$folio.'</b></center></td>';
                            }
                            if (($folio>=10)&&($folio<100)) 
                            {
                                $html .= '<td class="contentTitlePrintVale"><center id="folioPrintVale"><b>000'.$folio.'</b></center></td>';
                            }
                            if (($folio>=100)&&($folio<1000)) 
                            {
                                $html .= '<td class="contentTitlePrintVale"><center id="folioPrintVale"><b>00'.$folio.'</b></center></td>';
                            }
                            if (($folio>=1000)&&($folio<10000)) 
                            {
                                $html .= '<td class="contentTitlePrintVale"><center id="folioPrintVale"><b>0'.$folio.'</b></center></td>';
                            }
                            if (($folio>=10000)&&($folio<100000)) 
                            {
                                $html .= '<td class="contentTitlePrintVale"><center id="folioPrintVale"><b>'.$folio.'</b></center></td>';
                            }      
                        $html .= '</tr>';

                        $html .= '<tr>';
                            
                            $html .= '<td class="titlePrintVale" colspan="3"><center><b>SOLICITA</b></center></td>';
                            $html .= '<td class="titlePrintVale" colspan="2"><center><b>DEPARTAMENTO</b></center></td>';
                            $html .= '<td class="titlePrintVale"><center><b>FECHA</b></center></td>';
                        $html .= '</tr>';

                        $html .= '<tr>';
                           
                            $html .= '<td class="contentPrintVale" colspan="3"><center>'.$solicita.'</center></td>';
                            $html .= '<td class="contentPrintVale" colspan="2"><center>'.$departamento.'</center></td>';
                            $html .= '<td class="contentPrintVale"><center>'.$fecha.'</center></td>';
                        $html .= '</tr>';

                        $html .= '<tr>';
                            $html .= '<td colspan="6"><center><b>DE ACUERDO A LA SOLICITUD, SE HACE ENTREGA DEL SIGUIENTE MATERIAL:</b></center></td>';
                        $html .= '</tr>';

                        $html .= '<tr>';
                            $html .= '<td class="titlePrintVale" ><center><b>CANTIDAD</b></center></td>';
                            $html .= '<td class="titlePrintVale" colspan="4"><center><b>CONCEPTO</b></center></td>';
                            $html .= '<td class="titlePrintVale"><center><b>UNIDAD</b></center></td>';
                        $html .= '</tr>';

                        $subtotal = 0;
                        $data_medicamentos = $query = $this->db->query("SELECT * FROM material_salida_ornato WHERE id = '$folio' ");
                        foreach ($data_medicamentos->result_array() as $row)
                        {
                            $html .= '<tr>';
                                $html .= '<td class="contentPrintVale"><center>'.$row['cantidad'].'</center></td>';
                                $html .= '<td class="contentPrintVale" colspan="4"><center>'.$row['descripcion'].'</center></td>';

                                $producto = $row['descripcion'];
                                $data_unidad = $query = $this->db->query("SELECT*FROM stock_ornato WHERE descripcion = '$producto' ");

                                foreach ($data_unidad->result_array() as $field)
                                {
                                    $html .= '<td class="contentPrintVale"><center>'.$field['unidad'].'</center></td>';   
                                }
                            $html .= '</tr>';
                        }

                        $html .= '<tr>';
                            $html .= '<td colspan="6"></td>';
                        $html .= '</tr>';
                        $html .= '<tr>';
                            $html .= '<td class="contentPrintValeSello" colspan="2"><center>'.$solicita.'</center></td>';
                            $html .= '<td class="contentPrintValeSello" colspan="2"><center></center></td>';
                            $html .= '<td class="contentPrintValeSello" colspan="2"><center></center></td>';
                        $html .= '</tr>';

                        $html .= '<tr>';
                            $html .= '<td class="footPrintVale" colspan="2"><center><b>SOLICITA</b></center></td>';
                            $html .= '<td class="footPrintVale" colspan="2"><center><b>OBSERVACIONES</b></center></td>';
                            $html .= '<td class="footPrintValeAut" colspan="2"><center><b>ING. HEBERT M. <BR> REYES FAJARDO</b></center></td>';
                        $html .= '</tr>';
                    $html .= '</tbody>';
                $html .= '</table>';

                $html .= '<a id="printValeDetail" class="btn btn-success">Imprimir</a>';
                $html .= '<button class="btn btn-primary" id="btnCancelOUTOrnato">&nbsp;Cancelar</button>';
            $html .= '</div>';
        $html .= '</div>';

        $this->init('','principal_login',$html);

    }
}
