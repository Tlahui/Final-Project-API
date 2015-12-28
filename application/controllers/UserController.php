<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class UserController extends CI_Controller {
	    /**
     * Controlador definido para interactuar con usuarios
     *
     * Se encuentra compuesto de las siguientes rutas:
     * 		
     *      /user/listar
     *    
     *
     * El modelo definido por defecto para interactuar con la BD es UserModel.
     * Si se requiere el uso de metodos adicionales declararlos hasta abajo
     *
     */
	public function listar()
	{
		$response["responseStatus"] = "False";
		$response["message"] = "Usuarios no pueden ser listados";
		// load model
		$this->load->model("usermodel");
		$response["user"] = $this->usermodel->listar();
		
		echo json_encode($response);
	}

}
