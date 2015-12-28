<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class UserModel extends CI_Model {
    /**
     * Modelo definido para interactuar con la tabla "User"
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
     * Listado de usuarios
     *
     * Obtiene un array con los registros de la tabla user
     * y en caso que no exista devuelve false
     *
     * @author Feli
     * @return Array|boolean
     */
	public function listar()
	{
		$this->db->select("id, correoElectronico, usuario, password, nombre, fechaNacimiento, direccion, telefono, admin");
		$user = $this->db->get("user")->result();
        if($user)
        {
            return $user;
        }
        else
        {
            $response["message"] = "Usuarios no pueden ser listados";
        }
		
	}



    public function deleteUser($userID)
    {
        $this->db->where("id",$userID);
        $found = $this->db->get("user")->row();

        if ($found){
            $this->db->where("id",$userID);
            $this->db->delete("user");
            return true;
        } else {
            return false;
        }
    }
}
