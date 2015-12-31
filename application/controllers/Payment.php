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

            public function confirm_payment()
            {
                        $body = @file_get_contents('php://input');

                        $event_json = json_decode($body);

                        if($event_json->type == 'charge.paid')
                        {
                               $response['id'] = $event_json->data->object->id;
                               $response['reference_id'] = $event_json->data->object->reference_id;
                               echo json_encode($response);
                        }



            }

            public function register_card()
            {

                        Conekta::setApiKey('key_Fq5U8GUU28hTqgxy4md4TQ');
                       try{
                              $customer = Conekta_Customer::create(array(
                                        "name"=> $this->input->post("name"), //"Lews Therin",
                                        "email"=> $this->input->post("email"), //"lews.therin@gmail.com",
                                        "phone"=> $this->input->post("phone"), //"55-5555-5555",
                                        "cards"=>  array()   //"tok_a4Ff0dD2xYZZq82d9"
                              ));

                            $card = $customer->createCard(array('token' => $this->input->post('token')));


                            echo $card->id;
                        }catch (Conekta_Error $e){
                                  echo $e->getMessage();
                                 //el cliente no pudo ser creado
                        }


            }


            public function subscribe()
            {
                Conekta::setApiKey("key_Fq5U8GUU28hTqgxy4md4TQ");
                try{
                    $plan = Conekta_Plan::create(array(
                        'id' => "tlahui-plan".time(),
                        'name' => "Tlahui Plan",
                        'amount' => 100000,
                        'currency' => "MXN",
                        'interval' => "month",
                        'frequency' => 1,
                        'trial_period_days' => 30,
                        'expiry_count' => 12
                    ));
                    $customer = Conekta_Customer::create(array(
                        "name"=> "Lews Therin",
                        "email"=> "lews.therin@gmail.com",
                        "phone"=> "55-5555-5555",
                        "cards"=>  array()
                    ));
                    $card = $customer->createCard(array('token' => $this->input->post("token")));
                    $subscription = $customer->createSubscription(
                      array(
                        'plan' => 'tlahui-plan'
                      )
                    );
                    var_dump($subscription);
                }
                catch (Conekta_Error $e)
                {
                    echo $e->getMessage();
                }
            }
}

/* End of file payment.php */
/* Location: ./application/controllers/payment.php */