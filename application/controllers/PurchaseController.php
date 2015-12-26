<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class PurchaseController extends CI_Controller {

/*
     * Funcion para solicitar una cancelación de compra, recibe el idPurchase
     * activa a valor 1 el campo  solicitudCancelacion para que el administrador
     * pueda cancelar la compra completa.
     */
    
    public function cancelrequest() {
        $idPurchase = $this->input->post("idPurchase");

        $response["responseStatus"] = false;

        $this->load->model("PurchaseModel");
        $updated = $this->PurchaseModel->cancelRequest($idPurchase);

        if($updated) {
            $response["responseStatus"] = "Ok";
            $response["message"] = "Solicitud de cancelacion exitosa";
        }
        else {
            $response["responseStatus"] = "FAIL";
            $response["message"] = "No se pudo procesar la solicitud";
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($response));
    }

    
}
