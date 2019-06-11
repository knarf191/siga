<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Agregar extends CI_Model {

	function __construct()
  	{         
		parent::__construct();     
 	}
	

	/********************************************************
				 Vale de Gasolina
	*********************************************************/		

	function setVale($data_post)
	{
		return $this->db->insert('vales_gasolina',$data_post);
	}

	function setDocumento($data_post)
	{
		return $this->db->insert('documentos_vales_gasolina',$data_post);
	}

	function updateVale($folio, $data)
	{
		$this->db->where('folio', $folio);

		return $this->db->update('vales_gasolina',$data);
	}	

	function updateDocumento($folio, $data)
	{
		$this->db->where('folio_vale', $folio);

		return $this->db->update('documentos_vales_gasolina',$data);
	}	
	/********************************************************
						Usuarios
	*********************************************************/	
	function setUsuarios($data_user)
	{
		return $this->db->insert('usuarios',$data_user);
	}

	function setPermisos($data_permisos)
	{
		return $this->db->insert('permisos',$data_permisos);
	}


	function updateUsuarios($id, $data)
	{
		$this->db->where('id', $id);

		return $this->db->update('usuarios',$data);
	}

	function updatePermisos($id, $modulo, $data)
	{
		$this->db->where('id', $id);
		$this->db->where('modulo', $modulo);

		return $this->db->update('permisos',$data);
	}

	/********************************************************
				 Orden Médica
	*********************************************************/		

	function setOrdenMedica($data_post)
	{
		return $this->db->insert('orden_medica',$data_post);
	}

	function updateOrdenMedica($folio, $data)
	{
		$this->db->where('folio', $folio);

		return $this->db->update('orden_medica',$data);
	}


	/********************************************************
				 Medicamentos
	*********************************************************/		

	function setSolicitudMedicamentos($data_post)
	{
		return $this->db->insert('solicitud_medicamentos',$data_post);
	}

	function updateSM($folio, $data)
	{
		$this->db->where('folio', $folio);

		return $this->db->update('solicitud_medicamentos',$data);
	}

	function setMedicamentos($folio,$cantidad,$medicamento,$p_unit)
	{
		for ($i=0; $i <count($cantidad); $i++) 
		{ 
			$importe = $cantidad[$i]*$p_unit[$i];
			$query = $this->db->query("INSERT INTO medicamentos VALUES('".$folio."' , '".$cantidad[$i]."' ,'".$medicamento[$i]."' , '".$p_unit[$i]."', '".$importe."')");
		}
	}

	/********************************************************
				 Refacciones
	*********************************************************/		

	function setSolicitudRefacciones($data_post)
	{
		return $this->db->insert('solicitud_refacciones',$data_post);
	}

	function setRefacciones($folio,$cantidad,$concepto,$p_unit)
	{
		for ($i=0; $i <count($cantidad); $i++) 
		{ 
			$importe = $cantidad[$i]*$p_unit[$i];
			$query = $this->db->query("INSERT INTO refacciones VALUES('".$folio."' , '".$cantidad[$i]."' ,'".$concepto[$i]."' , '".$p_unit[$i]."', '".$importe."')");
		}
		
	}

	function updateSolicitudRefacciones($folio, $data)
	{
		$this->db->where('folio', $folio);

		return $this->db->update('solicitud_refacciones',$data);
	}

	/********************************************************
				 Lubricantes
	*********************************************************/		

	function setValeLubricante($data_post)
	{
		return $this->db->insert('vales_lubricante',$data_post);
	}

	function setLubricantes($folio,$cantidad,$concepto,$p_unit)
	{
		for ($i=0; $i <count($cantidad); $i++) 
		{ 
			$importe = $cantidad[$i]*$p_unit[$i];
			$query = $this->db->query("INSERT INTO lubricantes VALUES('".$folio."' , '".$cantidad[$i]."' ,'".$concepto[$i]."', '".$p_unit[$i]."', '".$importe."')");
		}
		
	}

	function updateLubricante($folio, $data)
	{
		$this->db->where('folio', $folio);

		return $this->db->update('vales_lubricante',$data);
	}	

	/********************************************************
				 Recargas
	*********************************************************/		

	function setRecarga($fecha, $saldo_anterior,$recarga,$saldo_actual,$personal)
	{
		return $query = $this->db->query("INSERT INTO recargas_saldo VALUES(NULL, '".$fecha."', '".$saldo_anterior."', '".$recarga."', '".$saldo_actual."', '".$personal."')");	
	}

	function updateSaldo($id,$saldo_actual)
	{
		return $query = $this->db->query("UPDATE recargas_saldo SET saldo_actual = '".$saldo_actual."' WHERE id = $id");	
	}

	function updateRecarga($id, $fecha, $saldo_anterior,$recarga,$saldo_actual,$personal)
	{
		return $query = $this->db->query("UPDATE recargas_saldo SET fecha = '".$fecha."', saldo_anterior = '".$saldo_anterior."', recarga = '".$recarga."', saldo_actual = '".$saldo_actual."', personal = '".$personal."' WHERE id = $id");	
	}	

	/********************************************************
				 Entradas
	*********************************************************/		

	function setEntradaPapeleria($data_post)
	{
		return $this->db->insert('entradas_papeleria',$data_post);
	}
	function setEntradaOrnato($data_post)
	{
		return $this->db->insert('entradas_ornato',$data_post);
	}
	function setEntradaComputo($data_post)
	{
		return $this->db->insert('entradas_computo',$data_post);
	}

	function updateEntradaPapeleria($folio, $data)
	{
		$this->db->where('folio', $folio);

		return $this->db->update('entradas_papeleria',$data);
	}	

	function updateEntradaOrnato($folio, $data)
	{
		$this->db->where('folio', $folio);

		return $this->db->update('entradas_ornato',$data);
	}

	function updateEntradaComputo($folio, $data)
	{
		$this->db->where('folio', $folio);

		return $this->db->update('entradas_computo',$data);
	}

	function updateStockPapeleriaByCode($id_stock,$codigo_stock,$descripcion_stock,$unidad_stock,$cant_actual,$departamento_stock)
	{
		return $query = $this->db->query("UPDATE stock_papeleria SET id = '".$id_stock."', codigo = '".$codigo_stock."', descripcion = '".$descripcion_stock."', unidad = '".$unidad_stock."', cantidad = '".$cant_actual."', departamento = '".$departamento_stock."' WHERE codigo = '".$codigo_stock."'");	
	}
	function updateStockOrnatoByCode($id_stock,$codigo_stock,$descripcion_stock,$unidad_stock,$cant_actual,$departamento_stock)
	{
		return $query = $this->db->query("UPDATE stock_ornato SET id = '".$id_stock."', codigo = '".$codigo_stock."', descripcion = '".$descripcion_stock."', unidad = '".$unidad_stock."', cantidad = '".$cant_actual."', departamento = '".$departamento_stock."' WHERE codigo = '".$codigo_stock."'");	
	}
	function updateStockComputoByCode($id_stock,$codigo_stock,$descripcion_stock,$unidad_stock,$cant_actual,$departamento_stock)
	{
		return $query = $this->db->query("UPDATE stock_computo SET id = '".$id_stock."', codigo = '".$codigo_stock."', descripcion = '".$descripcion_stock."', unidad = '".$unidad_stock."', cantidad = '".$cant_actual."', departamento = '".$departamento_stock."' WHERE codigo = '".$codigo_stock."'");	
	}	

	function updateCantPapeleriaStock($codigo,$cantidad)
	{
		return $query = $this->db->query("UPDATE stock_papeleria SET cantidad = '".$cantidad."' WHERE codigo = '".$codigo."'");	
	}

	function updateCantOrnatoStock($codigo,$cantidad)
	{
		return $query = $this->db->query("UPDATE stock_ornato SET cantidad = '".$cantidad."' WHERE codigo = '".$codigo."'");	
	}

	function updateCantComputoStock($codigo,$cantidad)
	{
		return $query = $this->db->query("UPDATE stock_computo SET cantidad = '".$cantidad."' WHERE codigo = '".$codigo."'");	
	}

	/*function updateLubricante($folio, $data)
	{
		$this->db->where('folio', $folio);

		return $this->db->update('vales_lubricante',$data);
	}*/	

	/********************************************************
				 Salida de Stock
	*********************************************************/	
	function setStockPapeleria($data)
	{
		return $this->db->insert('stock_papeleria',$data);
	}

	function setStockOrnato($data)
	{
		return $this->db->insert('stock_ornato',$data);
	}
		
	function setStockComputo($data)
	{
		return $this->db->insert('stock_computo',$data);
	}



	function setSalidaPapeleria($data)
	{
		return $this->db->insert('salidas_papeleria',$data);
	}

	function setSalidaOrnato($data)
	{
		return $this->db->insert('salidas_ornato',$data);
	}

	function setSalidaComputo($data)
	{
		return $this->db->insert('salidas_computo',$data);
	}

	function updateSalidaPapeleria($folio,$fecha,$solicita,$departamento)
	{
		return $query = $this->db->query("UPDATE salidas_papeleria SET folio = '".$folio."', fecha = '".$fecha."', solicita = '".$solicita."', departamento = '".$departamento."' WHERE folio = '".$folio."'");	
	}

	function updateSalidaOrnato($folio,$fecha,$solicita,$departamento)
	{
		return $query = $this->db->query("UPDATE salidas_ornato SET folio = '".$folio."', fecha = '".$fecha."', solicita = '".$solicita."', departamento = '".$departamento."' WHERE folio = '".$folio."'");	
	}

	function updateSalidaComputo($folio,$fecha,$solicita,$departamento)
	{
		return $query = $this->db->query("UPDATE salidas_computo SET folio = '".$folio."', fecha = '".$fecha."', solicita = '".$solicita."', departamento = '".$departamento."' WHERE folio = '".$folio."'");	
	}

	function setSalidaMaterialPapeleria($folio,$codigo,$descripcion,$cantidad)
	{
		for ($i=0; $i <count($codigo); $i++) 
		{ 
			$query = $this->db->query("INSERT INTO material_salida_papeleria VALUES('".$folio."' , '".$codigo[$i]."' ,'".$descripcion[$i]."', '".$cantidad[$i]."')");
		}
	}

	function setSalidaMaterialOrnato($folio,$codigo,$descripcion,$cantidad)
	{
		for ($i=0; $i <count($codigo); $i++) 
		{ 
			$query = $this->db->query("INSERT INTO material_salida_ornato VALUES('".$folio."' , '".$codigo[$i]."' ,'".$descripcion[$i]."', '".$cantidad[$i]."')");
		}
	}

	function setSalidaMaterialComputo($folio,$codigo,$descripcion,$cantidad)
	{
		for ($i=0; $i <count($codigo); $i++) 
		{ 
			$query = $this->db->query("INSERT INTO material_salida_computo VALUES('".$folio."' , '".$codigo[$i]."' ,'".$descripcion[$i]."', '".$cantidad[$i]."')");
		}
	}

	function updateStockPapeleria($codigo,$cantidad)
	{
		return $query = $this->db->query("UPDATE stock_papeleria SET cantidad = '".$cantidad."' WHERE codigo = '".$codigo."'");	
	}

	function updateStockOrnato($codigo,$cantidad)
	{
		return $query = $this->db->query("UPDATE stock_ornato SET cantidad = '".$cantidad."' WHERE codigo = '".$codigo."'");	
	}

	function updateStockComputo($codigo,$cantidad)
	{
		return $query = $this->db->query("UPDATE stock_computo SET cantidad = '".$cantidad."' WHERE codigo = '".$codigo."'");	
	}
}