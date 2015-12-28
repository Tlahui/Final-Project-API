<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class AddressModel extends CI_Model {
    /**
     * Modelo definido para interactuar con la tabla "Address"
     *
     */
	public function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        //Connect to database
        $this->load->database();
    }
 /**
     * Listado de direcciones de un usuario
     *
     * Obtiene un array con los registros de la tabla address
     * y en caso que no exista devuelve false
     *
     * @author Feli
     * @return Array|boolean
     */
	public function allAddress($userID)
	{
       
        $this->db->select("id, calle, colonia, exterior, sinNumero, interior, entreCalles, codigoPostal, municipio");
		$this->db->where("idUser",$userID);
        $availability = $this->db->get("address")->result();
        if($availability)
        {
            return $availability;
        }
        $response["message"] = "Usuario no tiene dirección";
        $response["responseStatus"] = "Fail";
        return $response;
	}
}
