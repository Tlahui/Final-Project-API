<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class InvoiceController extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
  }

  /*
   * Funcion para obtener la información de facturación
   * obtiene el idPurchase y obtiene toda la información de facturación
   * en tres elementos: purchase,address,user
   * en caso de no encontrarse emite un mensaje de error.
   */
  public function get($id) {
  }

}

?>
