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

        $this->db->select("id as idPurchase, pagoProcesado, referenciaPago as referencia, montoTotal, montoEnvio, idAddress, tipoPago");
        $result = $this->db->get_where("Purchase",array("id"=>$id))->row();
        //if ($result->idPurchase === null) return false;////
        $this->db->select("entreCalles");
        $idAdd= $result->idAddress;
        $address = $this->db->get_where("Address",array("id"=>$idAdd))->row();
        $purchase["idPurchase"]    = $result->idPurchase;
        $purchase["pagoProcesado"] = $result->pagoProcesado;
        $purchase["referencia"]    = $result->referencia;
        $purchase["montoTotal"] = $result->montoTotal;
        $purchase["montoEnvio"] = $result->montoEnvio;
        $purchase["entreCalles"] = $address->entreCalles;
        $purchase["idAdd"] = $idAdd;
        $purchase["tipoPago"] = $result->tipoPago;
        return $purchase;

    }
      function insertPurchase($Purchase){

        $this->db->insert("Purchase",$Purchase);
        $PurchaseID=$this->db->insert_id();
        return $PurchaseID;
    }

    public function cancel($id) {
        $this->db->where("id", $id);
        $this->db->where("solicitudCancelacion", 1);
        $this->db->delete("Purchase");
        if($this->db->affected_rows() >1 ){
            return true;
        }
        else {
            return false;
        }
    }

    public function cancelRequest($id) {

        $data = array(
            "solicitudCancelacion"=>1
        );

        $this->db->where("id", $id);
        $this->db->update("Purchase",$data);

        if ($this->db->affected_rows() >0) {
            return true;
        }
        else {
            return false;
        }
        
    }

    public function get($idPurchase){
    }

    public function purchaseUser($purchaseID, $userID)
    {

        $this->db->select("purchase.id as idPurchase, idAddress, tipoPago, montoTotal, montoEnvio, referenciaPago, pagoProcesado, idUser, entreCalles");
        $this->db->from("Purchase");
        $this->db->join("address", "address.id = purchase.idAddress");
        $this->db->where("Purchase.id",$purchaseID);
        $this->db->where("idUser",$userID);
        $result=$this->db->get("User")->row();

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
