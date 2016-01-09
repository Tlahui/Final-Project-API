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
        $idPurchase = $this->input->post("idPurchase");
        $response["statusResponse"] = "NOTOK";
        $this->load->model("PurchaseModel");
        $canceled = $this->PurchaseModel->cancel($idPurchase);
        if($canceled) {
            $response["statusResponse"] = "Ok";
            $response["message"] = "Compra cancelada correctamente";
        }
        else {
            $response["statusResponse"] = "Not Ok";
            $response["message"] = "La compra no pudo ser cancelada";
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($response));
    }
    
     /*
     * Funcion que agrega
     */
     public function add(){

     $newPurchase["idAddress"]=$this->input->post("idAddress");
     $newPurchase["tipoPago"]=$this->input->post("tipoPago");
     $newPurchase["montoTotal"]=$this->input->post("montoTotal");
     $newPurchase["montoEnvio"]=$this->input->post("montoEnvio");
     $newPurchase["referenciaPago"]=$this->input->post("referenciaPago");
     $newPurchase["pagoProcesado"]=$this->input->post("pagoProcesado");
     $newPurchase["solicitudCancelacion"]=$this->input->post("solicitudCancelacion");
             $this->load->model("PurchaseModel");
      



       if($this->input->post("montoTotal")!=0){
           $id=$this->PurchaseModel->insertPurchase($newPurchase);
             $response["responseStatus"]="OK";
             $response["message"]="Compra Exitosa";
             $response['id']=$id;
         
        }else{
            
            $response["responseStatus"]= "FAIL";
            $response["message"]="No se pudo realizar compra";

        }
         
      
     echo json_encode($response);

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
