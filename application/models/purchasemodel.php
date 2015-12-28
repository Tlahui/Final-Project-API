<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class PurchaseModel extends CI_Model {

    public function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        //Connect to database
        $this->load->database();
    }
    
    
    public function getInfo($id) {
    }
    
    public function cancel($id) {
    }
    
    public function cancelRequest($id) {
    }
    
    public function get($idPurchase){
    }

    public function purchaseUser($purchaseID, $userID)
    {

        $this->db->select("purchase.id as idPurchase, idAddress, tipoPago, montoTotal, montoEnvio, referenciaPago, pagoProcesado, idUser, entreCalles");
        $this->db->from("purchase");
        $this->db->join("address", "address.id = purchase.idAddress");
        $this->db->where("purchase.id",$purchaseID);
        $this->db->where("idUser",$userID);
        $result=$this->db->get("user")->row();

        if($result)
        {
             $dato["idUser"]        = $result->idUser;
             $dato["idPurchase"]    = $result->idPurchase;
             $dato["idAddress"]     = $result->idAddress;
             $dato["tipoPago"]      = $result->tipoPago;
             $dato["montoTotal"]    = $result->montoTotal;
             $dato["montoEnvio"]    = $result->montoEnvio;
             $dato["referenciaPago"]= $result->referenciaPago;
             $dato["pagoProcesado"] = $result->pagoProcesado;
             $dato["entreCalles"]   = $result->entreCalles;
             return $dato;
        }
        else
        {
            return false;
        }

    } //función
}
