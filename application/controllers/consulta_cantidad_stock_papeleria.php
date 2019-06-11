<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Consulta_cantidad_stock_papeleria extends CI_Controller {

    public function index()
    {
        $this->load();

    }

  

    private function load()
    {

    	$codigo       = $_GET['codigo'];

    	$search = $this->db->query("SELECT * FROM stock_papeleria WHERE codigo ='".$codigo."'");

    	foreach ($search->result_array() as $row)
        {
        	echo $row['cantidad'];
        }
    }
}
?>