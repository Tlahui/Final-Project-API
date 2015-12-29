<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class AddressController extends CI_Controller {
	/**
	 * Listado de direcciones de un usuario
	 */
		public function all()
	{
		$userID = $this->input->post("idUser");
		$this->load->model("AddressModel");
		$response["idUser"] = $userID;
		$response["direccion"] = $this->AddressModel->allAddress($userID);
		echo json_encode($response);
	}

	public function get()
	{
		// Obtenemos los datos que envío el post
		$idAddress = $this->input->post("idAddress");
		// Ahora creamos el modelo
		$this->load->model("addressmodel");
		// Llamamos a la función que debe retornarnos los datos del usuario
		// o false si ocurrió un error o es inválido
		$addressRegister = $this->addressmodel->buscar($idAddress);
		
		// Le asignamos por default que no fué exitoso
		$response ["responseStatus"] = "La dirección no existe";
		
		// Si no ocurrió un error ...
		if ($addressRegister !== false ) {
			$response["responseStatus"] = "OK, dirección existente";
			$response["Direccion"] = $addressRegister;
		}
		// Regresamos el JSON
		$this->output
		    ->set_content_type('application/json')
		    ->set_output(json_encode( $response ));	
	}
}