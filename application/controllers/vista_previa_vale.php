<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vista_previa_vale extends CI_Controller {

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

            $html .= '<div class="title_vale"><b>&nbsp&nbspVALE DE GASOLINA</b></div>';


            $html .= '<div >';
                $html .= '<table id="printVale">';
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
                            $html .= '<td><center><b>FECHA:</b></center></td>';
                            $html .= '<td class="contentTitlePrintVale"><center>'.$fecha.'</center></td>';
                             $html .= '<td class="spaceVale"></td>';
                            $html .= '<td class="spaceVale"></td>';
                            $html .= '<td ><center><b>FOLIO ASOC.:</b></center></td>';
                            $html .= '<td class="contentTitlePrintVale"><center id="folioPrintVale"><b>'.$folio_asoc.'</b></center></td>';
                        $html .= '</tr>';

                        $html .= '<tr>';
                            $html .= '<td class="titlePrintVale"><center><b>LITROS</b></center></td>';
                            $html .= '<td class="titlePrintVale" colspan="2"><center><b>NOMBRE DEL CHOFER</b></center></td>';
                            $html .= '<td class="titlePrintVale" colspan="2"><center><b>UNIDAD</b></center></td>';
                            $html .= '<td class="titlePrintVale"><center><b>No. ECONOMICO</b></center></td>';
                        $html .= '</tr>';

                        $html .= '<tr>';
                            $html .= '<td class="contentPrintVale"><center>'.$litros.'</center></td>';
                            $html .= '<td class="contentPrintVale" colspan="2"><center>'.$chofer.'</center></td>';
                            $html .= '<td class="contentPrintVale" colspan="2"><center>'.$unidad.'</center></td>';
                            $html .= '<td class="contentPrintVale"><center>'.$no_econ.'</center></td>';
                        $html .= '</tr>';

                        $html .= '<tr>';
                            $html .= '<td class="titlePrintVale" colspan="2"><center><b>DEPARTAMENTO</b></center></td>';
                            $html .= '<td class="titlePrintVale" colspan="2"><center><b>PLACAS</b></center></td>';
                            $html .= '<td class="titlePrintVale" colspan="2"><center><b>KM</b></center></td>';
                        $html .= '</tr>';

                        $html .= '<tr>';
                            $html .= '<td class="contentPrintVale" colspan="2"><center>'.$departamento.'</center></td>';
                            $html .= '<td class="contentPrintVale" colspan="2"><center>'.$placas.'</center></td>';
                            $html .= '<td class="contentPrintVale" colspan="2"><center>'.$km.'</center></td>';
                        $html .= '</tr>';

                        $html .= '<tr>';
                            $html .= '<td class="titlePrintVale" colspan="6"><center><b>DESCRIPCION</b></center></td>';
                        $html .= '</tr>';

                        $html .= '<tr>';
                            $html .= '<td class="contentPrintValeDesc" colspan="6"><center>'.$descripcion.'</center></td>';
                        $html .= '</tr>';

                         $html .= '<tr>';
                            $html .= '<td class="contentPrintValeSello" colspan="2"><center>'.$solicita.'</center></td>';
                            $html .= '<td class="contentPrintValeSello" colspan="2"><center>'.$gasolinera.'</center></td>';
                            $html .= '<td class="contentPrintValeSello" colspan="2"><center></center></td>';
                        $html .= '</tr>';

                        $html .= '<tr>';
                            $html .= '<td class="footPrintVale" colspan="2"><center><b>SOLICITA</b></center></td>';
                            $html .= '<td class="footPrintVale" colspan="2"><center><b>GASOLINERA</b></center></td>';
                            $html .= '<td class="footPrintValeAut" colspan="2"><center><b>ING. HEBERT M. <BR>REYES FAJARDO</b></center></td>';
                        $html .= '</tr>';
                    $html .= '</tbody>';
                $html .= '</table>';

                $html .= '<a id="printValeDetail" class="btn btn-success">Imprimir</a>';
                $html .= '<button class="btn btn-primary" id="cancelar_vale">&nbsp;Cancelar</button>';
            $html .= '</div>';
        $html .= '</div>';

        $this->init('','principal_login',$html);

    }
}
