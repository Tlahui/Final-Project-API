<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class PurchaseController extends CI_Controller {


  /*
   * Función para obtener información de compra, esta recibe el idPurchase
   * Devuelve un array con informacón y detalles de compra.
  */
    public function get($idPurchase) {
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
    }

    /*
     * Funcion para solicitar el listado de compra
     */
    public function user($idPurchase){
    }
}
