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
}