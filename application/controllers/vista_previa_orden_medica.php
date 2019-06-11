<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vista_previa_orden_medica extends CI_Controller {

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

            $html .= '<div class="title_vale"><b>ORDEN MÉDICA</b></div>';


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
                            $html .= '<td class="titlePrintVale"><center><b>FICHA</b></center></td>';
                            $html .= '<td class="titlePrintVale" colspan="2"><center><b>NOMBRE DEL TRABAJADOR</b></center></td>';
                            $html .= '<td class="titlePrintVale" colspan="2"><center><b>CATEGORIA</b></center></td>';
                            $html .= '<td class="titlePrintVale"><center><b>FECHA</b></center></td>';
                        $html .= '</tr>';

                        $html .= '<tr>';
                            $html .= '<td class="contentPrintVale"><center>'.$ficha.'</center></td>';
                            $html .= '<td class="contentPrintVale" colspan="2"><center>'.$solicita.'</center></td>';
                            $html .= '<td class="contentPrintVale" colspan="2"><center>'.$categoria.'</center></td>';
                            $html .= '<td class="contentPrintVale"><center>'.$fecha.'</center></td>';
                        $html .= '</tr>';

                        $html .= '<tr>';
                            $html .= '<td class="titlePrintVale" colspan="2"><center><b>DEPARTAMENTO</b></center></td>';
                            $html .= '<td class="titlePrintVale" colspan="2"><center><b>TIPO DE CONTRATO</b></center></td>';
                            $html .= '<td class="titlePrintVale" colspan="2"><center><b>TIPO DE PERSONAL</b></center></td>';
                        $html .= '</tr>';

                        $html .= '<tr>';
                            $html .= '<td class="contentPrintVale" colspan="2"><center>'.$departamento.'</center></td>';
                            $html .= '<td class="contentPrintVale" colspan="2"><center>'.$contrato.'</center></td>';
                            $html .= '<td class="contentPrintVale" colspan="2"><center>'.$personal.'</center></td>';
                        $html .= '</tr>';

                        $html .= '<tr>';
                            $html .= '<td colspan="6"><center><b>A NOMBRE DE ESTE HONORABLE AYUNTAMIENTO, SOLICITO A USTED PROPORCIONE ATENCIÓN MÉDICA A:</b></center></td>';
                        $html .= '</tr>';

                        $html .= '<tr>';
                            $html .= '<td class="titlePrintVale" colspan="3"><center><b>NOMBRE DEL BENEFICIARIO</b></center></td>';
                            $html .= '<td class="titlePrintVale" colspan="1"><center><b>PARENTESCO</b></center></td>';
                            $html .= '<td class="footPrintValeAut" colspan="2" rowspan="2"><center><b>ATENTAMENTE<br> SUFRAGIO EFECTIVO, <BR>NO REELECCION <BR>JALTIPAN, VER.</b></center></td>';
                            //$html .= '<td class="contentPrintValeDesc" colspan="6"><center></center></td>';
                        $html .= '</tr>';

                         $html .= '<tr>';
                            $html .= '<td class="contentPrintVale" colspan="3"><center>'.$beneficiario.'</center></td>';
                            $html .= '<td class="contentPrintVale" colspan="1"><center>'.$parentesco.'</center></td>';
                            
                        $html .= '</tr>';

                         $html .= '<tr>';
                            $html .= '<td class="contentPrintValeSello" colspan="2"><center></center></td>';
                            $html .= '<td class="contentPrintValeSello" colspan="2" id="firma"><center></center></td>';
                            $html .= '<td class="contentPrintValeSello" colspan="2"><center></center></td>';
                        $html .= '</tr>';

                        $html .= '<tr>';
                            $html .= '<td class="titlePrintVale" colspan="2" rowspan="2"><center><b>DR. JONAS HERNANDEZ SANTIAGO <BR><BR> MEDICO MUNICIPAL</b></center></td>';
                            $html .= '<td class="titlePrintVale" colspan="2" rowspan="2"><center><b>C. FLORENTINO SANCHEZ ROVIROSA <BR><BR> JEFE DE PERSONAL</b></center></td>';
                            $html .= '<td class="titlePrintVale" colspan="2" rowspan="2"><center><b>DR. MIGUEL ANGEL BAHENA VIVEROS<BR><BR>PRESIDENTE MUNICIPAL</b></center></td>';
                        $html .= '</tr>';
                    $html .= '</tbody>';
                $html .= '</table>';

                $html .= '<a id="printValeDetail" class="btn btn-success">Imprimir</a>';
                $html .= '<button class="btn btn-primary" id="btnCancelOrden">&nbsp;Cancelar</button>';
            $html .= '</div>';
        $html .= '</div>';

        $this->init('','principal_login',$html);

    }
}
