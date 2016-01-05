<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class PurchaseController extends CI_Controller {


  /*
   * Función para obtener información de compra, esta recibe el idPurchase
   * Devuelve un array con informacón y detalles de compra.
  */
    public function get($idPurchase) {
      $response["responseStatus"] = "FAIL";
      $response["message"] = "No existe";
      if(is_numeric($idPurchase) && $idPurchase != 0 ){
          $this->load->model("PurchaseModel");
          $purchaseGet = $this->PurchaseModel->getInfo($idPurchase);
          if($purchaseGet["idPurchase"] != null){
              $this->output->set_content_type('application/json')->set_output(json_encode( $purchaseGet ));
          }
          else {
              $this->output->set_content_type('application/json')->set_output(json_encode( $response ));
          }
      }
      else {
          $this->output->set_content_type('application/json')->set_output(json_encode( $response ));
      }

    }

    /*
     * Funcion para eliminar una compra, recibe idPurchase
     * y elimina el registro validando que solicitudCancelacion=1
     * esta funcion es usada por un usuario administrador
     */
    public function cancel() {
    }

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
    

    /*
     * Funcion para solicitar el listado de compra
     */
    public function user()
      {

        $response["responseStatus"] = "Not OK";

        $this->load->model("purchasemodel");

        $userID = $this->input->post("idUser",TRUE);
        $purchaseID = $this->input->post("idPurchase",TRUE);

        $result = $this->purchasemodel->purchaseUser($purchaseID, $userID);

      if ($result)
        {
          $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode( $result ));
        }
      else
        {
          $response["responseStatus"] = "El usuario no ha realizado ninguna compra";
          $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode( $response ));
        }

    } //función
}
