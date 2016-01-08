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

    public function buscar($idAddress)
    {
        $this->db->where("id",$idAddress);
        $this->db->select("id,idUser,idState,identificadorDireccion,calle,exterior,interior,sinNumero,colonia,municipio,codigoPostal,entreCalles");
        $found = $this->db->get("address")->row();
        $busqueda = false;
        if($found)
            {
                $busqueda = $found->id;
            }
        if ($busqueda !== false)
            {
                unset($found->password);
                return $found;
            }
        return false;
    }

    public function delete($idAdress)
    {
        $this->db->where("id",$idAdress);
        $found = $this->db->get("address")->row();

        if ($found){
            $this->db->where("id",$idAdress);
            $this->db->delete("address");
            return true;
        } else {
            return false;
        }   
    }
}
