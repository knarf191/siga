<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Consultas extends CI_Model {

	function __construct()
  	{         
		parent::__construct();     
 	}
	

	/********************************************************
						LOGIN
	*********************************************************/		

	function login($user, $password)
	{
		$query = $this->db->query("SELECT * FROM usuarios WHERE user ='$user' and password = '$password'");

		if ($query->num_rows() > 0)
		{		     
		 	return TRUE;
		}   
		else
		{		    
			return FALSE;
		}		
	} 

	function getDatabyUser($user)
	{
		$query = $this->db->query("SELECT * FROM usuarios WHERE user = '$user' ");
		
		if ($query->num_rows() > 0)
		{
			return $query->row_array();
		}  
	}

	/********************************************************
						Modulo Vales
	*********************************************************/


	function getVales() 
	{
		$query = $this->db->get('vales_gasolina');

		if ($query->num_rows() > 0)
		{
			return $query->result();

		}
		else
		{
			return FALSE;
		}
	}

	function getDocumentos() 
	{
		$query = $this->db->get('documentos_vales_gasolina');

		if ($query->num_rows() > 0)
		{
			return $query->result();

		}
		else
		{
			return FALSE;
		}
	}


	function getFolioVales() 
	{
		$query = $this->db->query('SELECT MAX(folio)+1 AS folio FROM vales_gasolina');

		if ($query->num_rows() > 0)
		{
			return $query->result();

		}
		else
		{
			return FALSE;
		}
	}

	function getValesByFolio($folio) 
	{
		$query = $this->db->query("SELECT * FROM vales_gasolina WHERE folio = '$folio' ");
		
		if ($query->num_rows() > 0)
		{
			return $query->row_array();
		}  
	}

	function getDocumentosByFolio($folio) 
	{
		$query = $this->db->query("SELECT * FROM documentos_vales_gasolina WHERE folio_vale = '$folio' ");
		
		if ($query->num_rows() > 0)
		{
			return $query->row_array();
		}  
	}

	function getFolioV() 
	{
		$query = $this->db->query('SELECT MAX(folio) AS folio FROM vales_gasolina');

		if ($query->num_rows() > 0)
		{
			return $query->result();

		}
		else
		{
			return FALSE;
		}
	}

	/********************************************************
						Modulo Usuarios
	*********************************************************/

	function getUsuarios() 
	{
		$query = $this->db->get('usuarios');

		if ($query->num_rows() > 0)
		{
			return $query->result();

		}
		else
		{
			return FALSE;
		}
	}

	function getIdUser() 
	{
		$query = $this->db->query('SELECT MAX(id)+1 AS id FROM usuarios');

		if ($query->num_rows() > 0)
		{
			return $query->result();

		}
		else
		{
			return FALSE;
		}
	}

	function getPermisosById($user,$modulo) 
	{
		$query = $this->db->query("SELECT * FROM permisos WHERE user = '$user' AND modulo = '$modulo' ");
		
		if ($query->num_rows() > 0)
		{
			return $query->row_array();
		}  
	}

	function getUserById($id) 
	{
		$query = $this->db->query("SELECT * FROM usuarios WHERE id = '$id' ");
		
		if ($query->num_rows() > 0)
		{
			return $query->row_array();
		}  
	}

	/********************************************************
						Modulo Ordenes Medicas
	*********************************************************/

	function getOrdenesMedicas() 
	{
		$query = $this->db->get('orden_medica');

		if ($query->num_rows() > 0)
		{
			return $query->result();
		}
		else
		{
			return FALSE;
		}
	}

	function getFolioOrdenMedica() 
	{
		$query = $this->db->query('SELECT MAX(folio)+1 AS folio FROM orden_medica');

		if ($query->num_rows() > 0)
		{
			return $query->result();

		}
		else
		{
			return FALSE;
		}
	}

	function getOrdenMedicaByFolio($folio) 
	{
		$query = $this->db->query("SELECT * FROM orden_medica WHERE folio = '$folio' ");
		
		if ($query->num_rows() > 0)
		{
			return $query->row_array();
		}  
	}

	function getFolioO() 
	{
		$query = $this->db->query('SELECT MAX(folio) AS folio FROM orden_medica');

		if ($query->num_rows() > 0)
		{
			return $query->result();

		}
		else
		{
			return FALSE;
		}
	}

	/********************************************************
						Modulo Medicamentos
	*********************************************************/

	function getSolicitud_Medicamentos() 
	{
		$query = $this->db->get('solicitud_medicamentos');

		if ($query->num_rows() > 0)
		{
			return $query->result();
		}
		else
		{
			return FALSE;
		}
	}

	function getFolioSolicitudMedicamento() 
	{
		$query = $this->db->query('SELECT MAX(folio)+1 AS folio FROM solicitud_medicamentos');

		if ($query->num_rows() > 0)
		{
			return $query->result();

		}
		else
		{
			return FALSE;
		}
	}

	function getSolicitudMedicamentosByFolio($folio) 
	{
		$query = $this->db->query("SELECT * FROM solicitud_medicamentos WHERE folio = '$folio' ");
		
		if ($query->num_rows() > 0)
		{
			return $query->row_array();
		}  
	}

	function getFolioSM() 
	{
		$query = $this->db->query('SELECT MAX(folio) AS folio FROM solicitud_medicamentos');

		if ($query->num_rows() > 0)
		{
			return $query->result();

		}
		else
		{
			return FALSE;
		}
	}


	/********************************************************
						Modulo Refacciones
	*********************************************************/

	function getDatosRefacciones() 
	{
		$query = $this->db->get('solicitud_refacciones');

		if ($query->num_rows() > 0)
		{
			return $query->result();
		}
		else
		{
			return FALSE;
		}
	}

	function getFolioSolicitudRefacciones() 
	{
		$query = $this->db->query('SELECT MAX(folio)+1 AS folio FROM solicitud_refacciones');

		if ($query->num_rows() > 0)
		{
			return $query->result();

		}
		else
		{
			return FALSE;
		}
	}

	function getSolicitudByFolio($folio) 
	{
		$query = $this->db->query("SELECT * FROM solicitud_refacciones WHERE folio = '$folio' ");
		
		if ($query->num_rows() > 0)
		{
			return $query->row_array();
		}  
	}

	function getFolioS() 
	{
		$query = $this->db->query('SELECT MAX(folio) AS folio FROM solicitud_refacciones');

		if ($query->num_rows() > 0)
		{
			return $query->result();

		}
		else
		{
			return FALSE;
		}
	}

	/********************************************************
					Modulo Vales Lubricantes
	*********************************************************/


	function getValesLubricantes() 
	{
		$query = $this->db->get('vales_lubricante');

		if ($query->num_rows() > 0)
		{
			return $query->result();

		}
		else
		{
			return FALSE;
		}
	}

	function getFolioLubricantes() 
	{
		$query = $this->db->query('SELECT MAX(folio)+1 AS folio FROM vales_lubricante');

		if ($query->num_rows() > 0)
		{
			return $query->result();

		}
		else
		{
			return FALSE;
		}
	}

	function getValesLubricanteByFolio($folio) 
	{
		$query = $this->db->query("SELECT * FROM vales_lubricante WHERE folio = '$folio' ");
		
		if ($query->num_rows() > 0)
		{
			return $query->row_array();
		}  
	}

	/********************************************************
					Modulo Recargas
	*********************************************************/


	function getRecargas() 
	{
		$query = $this->db->get('recargas_saldo');

		if ($query->num_rows() > 0)
		{
			return $query->result();

		}
		else
		{
			return FALSE;
		}
	}

	function getSaldo() 
	{
		$query = $this->db->query('SELECT MAX(id) AS id FROM recargas_saldo');

		if ($query->num_rows() > 0)
		{
			return $query->result();

		}
		else
		{
			return FALSE;
		}
	}

	function getFolioRecarga() 
	{
		$query = $this->db->query('SELECT MAX(id)+1 AS id FROM recargas_saldo');

		if ($query->num_rows() > 0)
		{
			return $query->result();

		}
		else
		{
			return FALSE;
		}
	}

	function getRecargaByFolio($folio) 
	{
		$query = $this->db->query("SELECT * FROM recargas_saldo WHERE id = '$folio' ");
		
		if ($query->num_rows() > 0)
		{
			return $query->row_array();
		}  
	}

	/********************************************************
					Modulo Entradas
	*********************************************************/


	function getEntradasPapeleria() 
	{
		$query = $this->db->get('entradas_papeleria');

		if ($query->num_rows() > 0)
		{
			return $query->result();

		}
		else
		{
			return FALSE;
		}
	}
	function getEntradasOrnato() 
	{
		$query = $this->db->get('entradas_ornato');

		if ($query->num_rows() > 0)
		{
			return $query->result();

		}
		else
		{
			return FALSE;
		}
	}
	function getEntradasComputo() 
	{
		$query = $this->db->get('entradas_computo');

		if ($query->num_rows() > 0)
		{
			return $query->result();

		}
		else
		{
			return FALSE;
		}
	}

	/*function getSaldo() 
	{
		$query = $this->db->query('SELECT MAX(id) AS id FROM recargas_saldo');

		if ($query->num_rows() > 0)
		{
			return $query->result();

		}
		else
		{
			return FALSE;
		}
	}*/

	function getFolioEntradaPapeleria() 
	{
		$query = $this->db->query('SELECT MAX(folio)+1 AS folio FROM entradas_papeleria');

		if ($query->num_rows() > 0)
		{
			return $query->result();

		}
		else
		{
			return FALSE;
		}
	}
	function getFolioEntradaOrnato() 
	{
		$query = $this->db->query('SELECT MAX(folio)+1 AS folio FROM entradas_ornato');

		if ($query->num_rows() > 0)
		{
			return $query->result();

		}
		else
		{
			return FALSE;
		}
	}
	function getFolioEntradaComputo() 
	{
		$query = $this->db->query('SELECT MAX(folio)+1 AS folio FROM entradas_computo');

		if ($query->num_rows() > 0)
		{
			return $query->result();

		}
		else
		{
			return FALSE;
		}
	}

	function getEntradaPapeleriaByFolio($folio) 
	{
		$query = $this->db->query("SELECT * FROM entradas_papeleria WHERE folio = '$folio' ");
		
		if ($query->num_rows() > 0)
		{
			return $query->row_array();
		}  
	}

	function getEntradaOrnatoByFolio($folio) 
	{
		$query = $this->db->query("SELECT * FROM entradas_ornato WHERE folio = '$folio' ");
		
		if ($query->num_rows() > 0)
		{
			return $query->row_array();
		}  
	}

	function getEntradaComputoByFolio($folio) 
	{
		$query = $this->db->query("SELECT * FROM entradas_computo WHERE folio = '$folio' ");
		
		if ($query->num_rows() > 0)
		{
			return $query->row_array();
		}  
	}

	function getStockPapeleriaByName($descripcion) 
	{
		$query = $this->db->query("SELECT * FROM stock_papeleria WHERE descripcion = '$descripcion' ");
		
		if ($query->num_rows() > 0)
		{
			return TRUE;
		}  
		else
		{
			return FALSE;
		}
	}

	function getStockOrnatoByName($descripcion) 
	{
		$query = $this->db->query("SELECT * FROM stock_ornato WHERE descripcion = '$descripcion' ");
		
		if ($query->num_rows() > 0)
		{
			return TRUE;
		}  
		else
		{
			return FALSE;
		}
	}

	function getStockComputoByName($descripcion) 
	{
		$query = $this->db->query("SELECT * FROM stock_computo WHERE descripcion = '$descripcion' ");
		
		if ($query->num_rows() > 0)
		{
			return TRUE;
		}  
		else
		{
			return FALSE;
		}
	}
	/********************************************************
					Modulo Stock
	*********************************************************/


	function getStockPapeleria() 
	{
		$query = $this->db->get('stock_papeleria');

		if ($query->num_rows() > 0)
		{
			return $query->result();

		}
		else
		{
			return FALSE;
		}
	}

	function getStockOrnato() 
	{
		$query = $this->db->get('stock_ornato');

		if ($query->num_rows() > 0)
		{
			return $query->result();

		}
		else
		{
			return FALSE;
		}
	}

	function getStockComputo() 
	{
		$query = $this->db->get('stock_computo');

		if ($query->num_rows() > 0)
		{
			return $query->result();

		}
		else
		{
			return FALSE;
		}
	}

	function getStockByFolio($codigo) 
	{

		for ($i=0; $i <count($codigo); $i++) 
		{ 
			$query = $this->db->query("SELECT cantidad FROM stock WHERE codigo = '$codigo[$i]' ");

			
				for ($i=0; $i < count($codigo); $i++) 
				{ 
					$retorno[$i] = $query;
				}
			
		}
		return $retorno;
	}

	function getStockPapeleriaByCodigo($codigo) 
	{
		$query = $this->db->query("SELECT * FROM stock_papeleria WHERE codigo ='".$codigo."'");
		
		if ($query->num_rows() > 0)
		{
			return $query->row_array();
		}
	}
	function getStockOrnatoByCodigo($codigo) 
	{
		$query = $this->db->query("SELECT * FROM stock_ornato WHERE codigo ='".$codigo."'");
		
		if ($query->num_rows() > 0)
		{
			return $query->row_array();
		}
	}
	function getStockComputoByCodigo($codigo) 
	{
		$query = $this->db->query("SELECT * FROM stock_computo WHERE codigo ='".$codigo."'");
		
		if ($query->num_rows() > 0)
		{
			return $query->row_array();
		}
	}

	function getFolioStockPapeleria() 
	{
		$query = $this->db->query('SELECT MAX(id)+1 AS id FROM stock_papeleria');

		if ($query->num_rows() > 0)
		{
			return $query->result();

		}
		else
		{
			return FALSE;
		}
	}
	function getFolioStockOrnato() 
	{
		$query = $this->db->query('SELECT MAX(id)+1 AS id FROM stock_ornato');

		if ($query->num_rows() > 0)
		{
			return $query->result();

		}
		else
		{
			return FALSE;
		}
	}
	function getFolioStockcomputo() 
	{
		$query = $this->db->query('SELECT MAX(id)+1 AS id FROM stock_computo');

		if ($query->num_rows() > 0)
		{
			return $query->result();

		}
		else
		{
			return FALSE;
		}
	}

	/********************************************************
					Modulo Salidas
	*********************************************************/


	function getSalidasPapeleria() 
	{
		$query = $this->db->get('salidas_papeleria');

		if ($query->num_rows() > 0)
		{
			return $query->result();

		}
		else
		{
			return FALSE;
		}
	}

	function getSalidasOrnato() 
	{
		$query = $this->db->get('salidas_ornato');

		if ($query->num_rows() > 0)
		{
			return $query->result();

		}
		else
		{
			return FALSE;
		}
	}

	function getSalidasComputo() 
	{
		$query = $this->db->get('salidas_computo');

		if ($query->num_rows() > 0)
		{
			return $query->result();

		}
		else
		{
			return FALSE;
		}
	}

	function getFolioSalidaPapeleria() 
	{
		$query = $this->db->query('SELECT MAX(folio)+1 AS folio FROM salidas_papeleria');

		if ($query->num_rows() > 0)
		{
			return $query->result();

		}
		else
		{
			return FALSE;
		}
	}

	function getFolioSalidaOrnato() 
	{
		$query = $this->db->query('SELECT MAX(folio)+1 AS folio FROM salidas_ornato');

		if ($query->num_rows() > 0)
		{
			return $query->result();

		}
		else
		{
			return FALSE;
		}
	}

	function getFolioSalidaComputo() 
	{
		$query = $this->db->query('SELECT MAX(folio)+1 AS folio FROM salidas_computo');

		if ($query->num_rows() > 0)
		{
			return $query->result();

		}
		else
		{
			return FALSE;
		}
	}

	function getFolioOUTPapeleria() 
	{
		$query = $this->db->query('SELECT MAX(folio) AS folio FROM salidas_papeleria');

		if ($query->num_rows() > 0)
		{
			return $query->result();

		}
		else
		{
			return FALSE;
		}
	}

	function getFolioOUTOrnato() 
	{
		$query = $this->db->query('SELECT MAX(folio) AS folio FROM salidas_ornato');

		if ($query->num_rows() > 0)
		{
			return $query->result();

		}
		else
		{
			return FALSE;
		}
	}

	function getFolioOUTComputo() 
	{
		$query = $this->db->query('SELECT MAX(folio) AS folio FROM salidas_computo');

		if ($query->num_rows() > 0)
		{
			return $query->result();

		}
		else
		{
			return FALSE;
		}
	}

	function getSalidaPapeleriaByFolio($folio) 
	{
		$query = $this->db->query("SELECT * FROM salidas_papeleria WHERE folio = '$folio' ");
		
		if ($query->num_rows() > 0)
		{
			return $query->row_array();
		}  
	}

	function getSalidaOrnatoByFolio($folio) 
	{
		$query = $this->db->query("SELECT * FROM salidas_ornato WHERE folio = '$folio' ");
		
		if ($query->num_rows() > 0)
		{
			return $query->row_array();
		}  
	}
	function getSalidaComputoByFolio($folio) 
	{
		$query = $this->db->query("SELECT * FROM salidas_computo WHERE folio = '$folio' ");
		
		if ($query->num_rows() > 0)
		{
			return $query->row_array();
		}  
	}
}	