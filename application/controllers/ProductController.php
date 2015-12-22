<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ProductController extends CI_Controller {

    /**
     * Controlador definido para interactuar con productos
     *
     * Se encuentra compuesto de las siguientes rutas:
     * 		/product
     *      /product/add
     *      /product/edit
     *      /product/delete
     *      /product/get/:id
     *      /product/featured
     *      /product/category/:id
     *      /product/like
     *      /product/unlike
     *
     * El modelo definido por defecto para interactuar con la BD es ModelProduct.
     * Si se requiere el uso de metodos adicionales declararlos hasta abajo
     *
     */

    function __construct(){
        parent::__construct();
        $this->load->model('ProductModel');
    }

    public function listar(){

    }

    public function add(){

    }

    public function edit(){

    }

    public function delete(){

    }

    public function get($id){

    }

    public function featured(){

    }

    public function category($idCategory){

    }

    public function like(){

    }

    public function unlike(){

    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/productController.php */