<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vista_previa_solicitud_medicamentos extends CI_Controller {

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
        $data      = $this->consultas->getSolicitudMedicamentosByFolio($folio);
        $fecha     = $data['fecha'];
        $solicita  = $data['solicita'];
        $ficha     = $data['ficha'];
        $documento = $data['documento'];
        $farmacia  = $data['farmacia'];

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

            $html .= '<div class="title_refacciones"><b>SOLICITUD DE MEDICAMENTOS</b></div>';


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
                            
                            $html .= '<td class="titlePrintVale" colspan="5"><center><b>SOLICITA</b></center></td>';
                            $html .= '<td class="titlePrintVale"><center><b>FECHA</b></center></td>';
                        $html .= '</tr>';

                        $html .= '<tr>';
                           
                            $html .= '<td class="contentPrintVale" colspan="5"><center>'.$solicita.'</center></td>';
                            $html .= '<td class="contentPrintVale"><center>'.$fecha.'</center></td>';
                        $html .= '</tr>';

                        $html .= '<tr>';
                            $html .= '<td class="titlePrintVale" colspan="2"><center><b>DEPARTAMENTO</b></center></td>';
                            $html .= '<td class="titlePrintVale" colspan="2"><center><b>DOCUMENTO</b></center></td>';
                            $html .= '<td class="titlePrintVale" colspan="2"><center><b>FARMACIA</b></center></td>';
                        $html .= '</tr>';

                        $html .= '<tr>';
                                $farmacia = strtoupper($farmacia);
                            $html .= '<td class="contentPrintVale" colspan="2"><center>'.$ficha.'</center></td>';
                            $html .= '<td class="contentPrintVale" colspan="2"><center>'.$documento.'</center></td>';
                            $html .= '<td class="contentPrintVale" colspan="2"><center>'.$farmacia.'</center></td>';
                        $html .= '</tr>';

                        $html .= '<tr>';
                            $html .= '<td colspan="6"><center><b>DE LA MANERA MAS ATENTA SOLICITO A USTED LOS SIGUIENTES MEDICAMENTOS:</b></center></td>';
                        $html .= '</tr>';

                        $html .= '<tr>';
                            $html .= '<td class="titlePrintVale" ><center><b>CANTIDAD</b></center></td>';
                            $html .= '<td class="titlePrintVale" colspan="3"><center><b>CONCEPTO</b></center></td>';
                            $html .= '<td class="titlePrintVale"><center><b>P. UNIT.</b></center></td>';
                            $html .= '<td class="titlePrintVale"><center><b>IMPORTE</b></center></td>';
                        $html .= '</tr>';

                        $subtotal = 0;
                        $data_medicamentos = $query = $this->db->query("SELECT * FROM medicamentos WHERE folio = '$folio' ");
                        foreach ($data_medicamentos->result_array() as $row)
                        {
                            $subtotal += $row['importe'];
                            $html .= '<tr>';
                                $html .= '<td class="contentPrintVale"><center>'.$row['cantidad'].'</center></td>';
                                $html .= '<td class="contentPrintVale" colspan="3"><center>'.$row['medicamento'].'</center></td>';
                                $html .= '<td class="contentPrintVale"><center>$'.$row['p_unit'].'</center></td>';
                                $html .= '<td class="contentPrintVale"><center>$'.$row['importe'].'</center></td>';    
                            $html .= '</tr>';
                        }

                          if($subtotal=="0")
                        {
                            $html .= '<tr>';
                                $html .= '<td colspan="4"></td>';
                                $html .= '<td class="contentPrintVale"><center><b>Subtotal:</b></center></td>';
                                $html .= '<td class="contentPrintVale"><center></center></td>';
                            $html .= '</tr>';

                            
                            $html .= '<tr>';
                                $html .= '<td colspan="4"></td>';
                                $html .= '<td class="contentPrintVale"><center><b>IVA:</b></center></td>';
                                $html .= '<td class="contentPrintVale"><center></center></td>';
                            $html .= '</tr>';

                            
                            $html .= '<tr>';
                                $html .= '<td colspan="4"></td>';
                                $html .= '<td class="contentPrintVale"><center><b>Total:</b></center></td>';
                                $html .= '<td class="contentPrintVale"><center></center></td>';
                            $html .= '</tr>';
                        }
                        else
                        {
                            $html .= '<tr>';
                                $html .= '<td colspan="4"></td>';
                                $html .= '<td class="contentPrintVale"><center><b>Subtotal:</b></center></td>';
                                $html .= '<td class="contentPrintVale"><center>$'.$subtotal.'</center></td>';
                            $html .= '</tr>';

                            $iva = $subtotal * 0.16;    
                            $html .= '<tr>';
                                $html .= '<td colspan="4"></td>';
                                $html .= '<td class="contentPrintVale"><center><b>IVA:</b></center></td>';
                                $html .= '<td class="contentPrintVale"><center>$'.$iva.'</center></td>';
                            $html .= '</tr>';

                            $total = $subtotal + $iva;
                            $html .= '<tr>';
                                $html .= '<td colspan="4"></td>';
                                $html .= '<td class="contentPrintVale"><center><b>Total:</b></center></td>';
                                $html .= '<td class="contentPrintVale"><center>$'.$total.'</center></td>';
                            $html .= '</tr>';
                        }

                        $html .= '<tr>';
                            $html .= '<td colspan="6"></td>';
                        $html .= '</tr>';
                        $html .= '<tr>';
                            $html .= '<td class="contentPrintValeSello" colspan="2"><center>'.$solicita.'</center></td>';
                            $html .= '<td class="contentPrintValeSello" colspan="2"><center>'.$farmacia.'</center></td>';
                            $html .= '<td class="contentPrintValeSello" colspan="2"><center></center></td>';
                        $html .= '</tr>';

                        $html .= '<tr>';
                            $html .= '<td class="footPrintVale" colspan="2"><center><b>SOLICITA</b></center></td>';
                            $html .= '<td class="footPrintVale" colspan="2"><center><b>FARMACIA</b></center></td>';
                            $html .= '<td class="footPrintValeAut" colspan="2"><center><b>ING. HEBERT M. <BR> REYES FAJARDO</b></center></td>';
                        $html .= '</tr>';
                    $html .= '</tbody>';
                $html .= '</table>';

                $html .= '<a id="printValeDetail" class="btn btn-success">Imprimir</a>';
                $html .= '<button class="btn btn-primary" id="btnCancelSM">&nbsp;Cancelar</button>';
            $html .= '</div>';
        $html .= '</div>';

        $this->init('','principal_login',$html);

    }
}
