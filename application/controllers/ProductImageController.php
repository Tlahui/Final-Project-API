<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ProductImageController extends CI_Controller {

    /**
     * Controlador definido para interactuar con Imagenes de productos
     *
     * Se encuentra compuesto de las siguientes rutas:
     * 		/product/image/add
     *      /product/image/get/:id
     *      /product/image/all/:id
     *      /product/image/delete
     *
     * El modelo definido por defecto para interactuar con la BD es ModelProduct.
     * Si se requiere el uso de metodos adicionales declararlos hasta abajo
     *
     */

    function __construct(){
        parent::__construct();
        $this->load->model('ProductImageModel');
    }

    
       public function add(){

        $config['upload_path'] = 'uploads/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '100';
        $config['max_width']  = '1024';
        $config['max_height']  = '768';
     
        $this->load->model("ProductImageModel");
        $this->load->helper(array('url'));
        $this->load->library('upload', $config);
    
        $response["responseStatus"] = "Error";
        $productID = $this->input->post("idProduct");
     

   if (!$this->upload->do_upload('url')){
            $response['responseStatus'] = "NOT OK";
             $response["message"] = "Imagen no pudo ser insertada";
        }
        else
        {
               $dataImage = array('upload_data' => $this->upload->data());
                $addProductImage = $this->ProductImageModel->AddProductImage($productID, $dataImage["upload_data"]["file_name"]);
                if($addProductImage){
                  $response["responseStatus"] = "OK";
                    $response["message"] = "Imagen insertada correctamente";
                    $response["url"] = $dataImage["upload_data"]["file_name"];
                }
                else{
                    $response["responseStatus"] = "Error";
                }               
        }      
       $this->output->set_content_type('application/json')->set_output(json_encode($response));
}

    public function get($id){
         $imagen = $this->ProductImageModel->ImageFromProduct($id);
        if($imagen){
          $this->output->set_content_type('application/json')->set_output(json_encode( $imagen ));  
        }
        else{
          $this->output->set_content_type('application/json')->set_output(json_encode( array('responseStatus'=>'FAIL', 'message'=>'El producto no tiene imagenes.') ));  
        }
    }

    public function all($idProduct){
        $imagenes = $this->ProductImageModel->ImageListFromProduct($idProduct);
        if($imagenes != 0){
            $this->output->set_content_type('application/json')->set_output(json_encode( $imagenes ));
        }
        else{
            $this->output->set_content_type('application/json')->set_output(json_encode( array('responseStatus'=>'FAIL', 'message'=>'El producto no tiene imagenes.') ));
        }
    }

    public function delete(){
        $idImage = $this->input->post("idImage");
        if ($idImage !== false )
        {
            $estatusAccion = $this->ProductImageModel->imageDelete($idImage);
            if ($estatusAccion==true) {
                $response[ "responseStatus" ] = "OK";
                $response[ "message" ]        = "Imagen eliminada correctamente";
            }
            else
            {
                $response[ "responseStatus" ] = "FAIL";
                $response[ "message" ]        = "Imagen no pudo ser eliminada";
            }
        }
        echo json_encode($response);
    }


}

/* End of file welcome.php */
/* Location: ./application/controllers/productController.php */
