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
	public function delete()
	{
		$idAdress = $this->input->post("id");
		// load model
		$this->load->model("AddressModel");
		$resultado = $this->AddressModel->delete($idAdress);
		//echo $resultado;
		if(0==$resultado){
			$response["responseStatus"] = "No existe";		
		}
		else{
			$response["responseStatus"] = "dirección eliminada correctamente";
		}
		$this->output
		    ->set_content_type('application/json')
		    ->set_output(json_encode( $response ));
	}
	public function add() {
		$response["responseStatus"] = "Not OK";
		// Las variables que obtenemos del post las ponemos en un array
		$newUser["calle"] = $this->input->post("calle");
		$newUser["colonia"] = $this->input->post("colonia");
		$newUser["exterior"] = $this->input->post("exterior");
		$newUser["sinNumero"] = $this->input->post("sinNumero");
		$newUser["interior"] = $this->input->post("interior");
		$newUser["entrecalles"] = $this->input->post("entreCalles");
		$newUser["codigoPostal"] = $this->input->post("codigoPostal");
		$newUser["municipio"] = $this->input->post("municipio");
		// Activamos el model (archivo php) que contiene las funciones
		// que usaremos adelante
		$this->load->model("usermodel");
		// Insertamos siempre debido a que se pueden enviar los productos de diferentes usarios a una misma dirección.
		
		$response["userID"] = $this->usermodel->insertuser($newUser);
		$response["responseStatus"] = "OK";
		$response["responseStatus"] = "Dirección Insertado Correctamente";
		// Regresamos la respuesta en formato JSON
		//echo json_encode($response);
		// Según la documentación, ésta es la manera en que debemos
		// regresar el json... y con ésta función me respeta el UTF8
		// a diferencia del echo...
		$this->output
		    ->set_content_type('application/json')
		    ->set_output(json_encode( $response ));		
	}

		public function edit()
	{
		$response["responseStatus"] = "Not OK";
		// Las variables que obtenemos del post las ponemos en un array
		$userID = $this->input->post("id");
		$newUser["calle"] = $this->input->post("calle");
		$newUser["colonia"] = $this->input->post("colonia");
		$newUser["exterior"] = $this->input->post("exterior");
		$newUser["sinNumero"] = $this->input->post("sinNumero");
		$newUser["interior"] = $this->input->post("interior");
		$newUser["entrecalles"] = $this->input->post("entrecalles");
		$newUser["codigoPostal"] = $this->input->post("codigoPostal");
		$newUser["municipio"] = $this->input->post("municipio");
		// Activamos el model (archivo php) que contiene las funciones
		// que usaremos adelante
		$this->load->model("usermodel");
		
		// Insertamos 
						
		// ACTUALIZAMOS el usuario a través de una llamada al modelo
		$resultado = $this->usermodel->update($userID,$newUser);
		if($resultado == true)
		{
			$this->output
				->set_content_type('application/json')
				->set_output(json_encode( $response ));
			$response["responseStatus"] = "OK - Dirección modificada exitosamente";
		}
		else
		{
			$response["responseStatus"] = "Dirección no pudo ser modificada";
		}
				
		// Regresamos la respuesta en formato JSON
		//echo json_encode($response);
		// Según la documentación, ésta es la manera en que debemos
		// regresar el json... y con ésta función me respeta el UTF8
		// a diferencia del echo...
		$this->output
		    ->set_content_type('application/json')
		    ->set_output(json_encode( $response ));
	}
}