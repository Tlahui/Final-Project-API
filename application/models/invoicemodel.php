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
    }

}
