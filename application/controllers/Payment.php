<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Payment extends CI_Controller {

	public function checkout()
            {

                        $response['responseStatus'] = "Not OK";

                        // private key of conekta dashboard
                        Conekta::setApiKey('key_Fq5U8GUU28hTqgxy4md4TQ');
                        try {
                                    $charge = Conekta_Charge::create(array(
                                            "amount"=> $this->input->post("amount"),
                                            "currency"=> "MXN",
                                            "description"=> $this->input->post("description"), //"Galileo Tlahui",
                                            "reference_id"=> $this->input->post("reference_id"), //"Tlahui001 Galileo",
                                            "card"=> $this->input->post("token")
                                    ));
                                    
                                    var_dump($charge);
                                    //echo json_encode($charge);


                        } catch (Conekta_Error $e) {
                                    echo $e->getMessage();
                                    //El pago no pudo ser procesado
                        }

            }
}

/* End of file payment.php */
/* Location: ./application/controllers/payment.php */