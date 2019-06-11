<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Eliminar extends CI_Model {

	function __construct()
  	{         
		parent::__construct();     
 	}
	

	/********************************************************
						Usuarios
	*********************************************************/		

	function deleteUser($user)
	{
		$this->db->where('user', $user);

		return $this->db->delete('usuarios');
	}

	function deletePermisos($user)
	{
		$this->db->where('user', $user);

		return $this->db->delete('permisos');
	}	

	/********************************************************
						Refacciones
	*********************************************************/		

	function deleteRefacciones($folio)
	{
		$this->db->where('folio', $folio);

		return $this->db->delete('refacciones');
	}	

	/********************************************************
						Lubricantes
	*********************************************************/		

	function deleteLubricantes($folio)
	{
		$this->db->where('folio', $folio);

		return $this->db->delete('lubricantes');
	}	

	/********************************************************
						Refacciones
	*********************************************************/		

	function deleteMedicamentos($folio)
	{
		$this->db->where('folio', $folio);

		return $this->db->delete('medicamentos');
	}	

	/********************************************************
						Refacciones
	*********************************************************/		

	function deleteMaterialPapeleria($folio)
	{
		$this->db->where('id', $folio);

		return $this->db->delete('material_salida_papeleria');
	}	

	function deleteMaterialOrnato($folio)
	{
		$this->db->where('id', $folio);

		return $this->db->delete('material_salida_ornato');
	}

	function deleteMaterialComputo($folio)
	{
		$this->db->where('id', $folio);

		return $this->db->delete('material_salida_computo');
	}
}