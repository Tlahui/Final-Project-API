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

    }

    public function get($id){

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

    }


}

/* End of file welcome.php */
/* Location: ./application/controllers/productController.php */