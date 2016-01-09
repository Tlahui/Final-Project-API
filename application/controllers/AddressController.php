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

	public function edit()
	{
		$response["responseStatus"] = "Not OK";
		// Las variables que obtenemos del post las ponemos en un array
		$userID = $this->input->post("id");
		$newUser["correoElectronico"] = $this->input->post("correoElectronico");
		$newUser["usuario"] = $this->input->post("usuario");
		$newUser["password"] = $this->input->post("password");
		$newUser["nombre"] = $this->input->post("nombre");
		$newUser["fechaNacimiento"] = $this->input->post("fechaNacimiento");
		$newUser["direccion"] = $this->input->post("direccion");
		$newUser["telefono"] = $this->input->post("telefono");
		// Activamos el model (archivo php) que contiene las funciones
		// que usaremos adelante
		$this->load->model("usermodel");
		// Insertamos siempre y cuando no exista
		// y pase las validaciones...
		// Si ocurre un error regresa 0 ... así que aquí checamos si la fecha
		// viene mal
		if( 0 === preg_match("/^\d{4}[\-\/\s]?((((0[13578])|(1[02]))[\-\/\s]?(([0-2][0-9])|(3[01])))|(((0[469])|(11))[\-\/\s]?(([0-2][0-9])|(30)))|(02[\-\/\s]?[0-2][0-9]))$/",$newUser["fechaNacimiento"]))
		{
			$response["responseStatus"]  = "Invalid Date Format. yyyy-mm-dd, yyyy mm dd, or yyyy/mm/dd Expected";
		}
		else
		{
			// Validamos el correo electrónico...
			if (!filter_var($newUser["correoElectronico"], FILTER_VALIDATE_EMAIL) === false)
			{
				// Validamos que aún no existan en la base de datos
				if($this->usermodel->usernameIsUnique($newUser["usuario"]) && 
				 $this->usermodel->emailIsUnique($newUser["correoElectronico"]))
				{	
					// Validamos que el password cumpla con ciertos criterios (al menos 6 posiciones, al menos una letra...)
					if(0 === preg_match("/^(?![0-9]{6,})[0-9a-zA-Z]{6,}$/",$newUser["password"]))
					{
						$response["responseStatus"] = "Password must contain at least one leter, minimum length 6, alphanumeric";
					}
					else
					{
						// Validamos el teléfono ...
						if(0 === preg_match("/^\D?(\d{3})\D?\D?(\d{3})\D?(\d{4})$/",$newUser["telefono"]))
						{
							$response["responseStatus"] = "Invalid phone number. Valid formats: 111-222-3333, or 111.222.3333, or (111) 222-3333, or 1112223333";
						}
						else
						{
							// Si llegamos hasta aquí, es que los datos accesados son correctos
							$newUser["password"] = password_hash($newUser["password"], PASSWORD_DEFAULT);
							// Le ponemos la "marca" de que éste usuario es de tipo Administrador
							//$newUser["type"] = 1;							
							// ACTUALIZAMOS el usuario a través de una llamada al modelo
							$resultado = $this->usermodel->update($userID,$newUser);
							if($resultado == true)
							{
								$this->output
		    						->set_content_type('application/json')
		    						->set_output(json_encode( $response ));
								$response["responseStatus"] = "OK - Modificacion realizada exitosamente";
							}
							else
							{
								$response["responseStatus"] = "Actualizacion no realizada";
							}
							//$response["userID"] = $this->usermodel->insertuser($newUser);
							//$response["responseStatus"] = "OK";
						}
					}
				}
				else
				{
					$response["responseStatus"] = "Email or Username Exists Already";
				}
			}
			else
			{
				$response["responseStatus"] = "Invalid Email Format";
			}
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