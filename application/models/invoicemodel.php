<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class InvoiceModel extends CI_Model {

    public function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        //Connect to database
        $this->load->database();
    }

    public function getInvoice($idPurchase) {
      $this->db->select("id,idPurchase,idAddress,nombre,rfc,numFactura,fechaEmision,fechaPago,tipoPago");
      $invoice = $this->db->get_where("Invoice",array("id"=>$idPurchase))->row();

      $data["idInvoice"] = $idPurchase; //Paametro que recibe del controlador

      $idPurchase = $invoice->idPurchase;
      $this->db->select("id as idPurchase, pagoProcesado, referenciaPago as referencia, montoTotal, montoEnvio, idAddress, tipoPago");
      $purchase = $this->db->get_where("Purchase",array("id"=>$idPurchase))->row();

      $idAddress = $invoice->idAddress;
      $this->db->select("id,idUser,calle,colonia,exterior,sinNumero,interior,entreCalles,codigoPostal,municipio");
      $address = $this->db->get_where("Address",array("id" =>$idAddress))->row();

      $idUser = $address->idUser;
      $this->db->select("id,usuario");
      $user = $this->db->get_where("User",array("id"=>$idUser))->row();

      $purchasea["idPurchase"]    = $purchase->idPurchase;
      $purchasea["pagoProcesado"] = $purchase->pagoProcesado;
      $purchasea["referencia"]    = $purchase->referencia;
      $purchasea["montoTotal"] = $purchase->montoTotal;
      $purchasea["montoEnvio"] = $purchase->montoEnvio;
      $purchasea["entreCalles"] = $address->entreCalles;
      $purchasea["idAdd"] = $idAddress;
      $purchasea["tipoPago"] = $purchase->tipoPago;

      $addressa["idAddress"] = $address->id;
      $addressa["calle"] = $address->calle;
      $addressa["colonia"] = $address->colonia;
      $addressa["exterior"] = $address->exterior;
      $addressa["sinNumero"] = $address->sinNumero;
      $addressa["interior"] = $address->interior;
      $addressa["entreCalles"] = $address->entreCalles;
      $addressa["codigoPostal"] = $address->codigoPostal;
      $addressa["municipio"] = $address->municipio;

      $usera["id"] = $user->id;
      $usera["usuario"] = $user->usuario;
      $usera["rfc"] = $invoice->rfc;

      $data["purchase"] = $purchasea;
      $data["address"] = $addressa;
      $data["user"] = $usera;

      return $data;

    }

}
