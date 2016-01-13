<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ProductSizeController extends CI_Controller {

    /**
     * Controlador definido para interactuar con las tallas de los productos
     * Marcos Valencia
     *
     * Se encuentra compuesto de las siguientes rutas:
     *      $route['product/size/(:num)']           = "ProductSizeController/listar/$1";
     *      $route['product/size/update']           = "ProductSizeController/update";
     *      $route['product/size/add']              = "ProductSizeController/add";
     *      $route['product/size/delete']           = "ProductSizeController/delete";
     *
     * El modelo definido por defecto para interactuar con la BD es ModelProduct.
     * Si se requiere el uso de metodos adicionales declararlos hasta abajo
     *
     */

    function __construct(){

        parent::__construct();

        // Cargamos desde el constructor el modelo, ya que todas las funciones 
        // de éste controlador lo utilizan
        $this->load->model('ProductSizeModel');

    }


    // Lista todas las entradas de un producto solicitado, por su ID
    // Por default, le pondremos 0 al idProduct si no nos lo envían, para que no regrese nada
    // ----------------------------------------------------------------------------------------
    public function listar( $idProduct = 0 )
    {
        $response["responseStatus"] = "Not OK";
        
        // llamamos el modelo
        $productSize = $this->productSizeModel->listarProductSize( $idProduct );
        
        // Si NO regresa falso... preparamos la respuesta
        if(false !== $productSize) {
            $response["responseStatus"] = "OK";
            $response["sizes"] = $productSize;
        }
        
        // Regresamos el resultado con formato
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode( $response ));
            
    }
    
    
    
    // Actualizamos la cantidad de productos disponibles, pasándole el idProduct + idSize
    // Parámetros requeridos:
    //      idProduct
    //      idSize
    //      cantidad
    // ----------------------------------------------------------------------------------------
    public function updateSizeById()
    {
        $response["responseStatus"] = "FAIL";
        $response["message"] = "Cantidad no pudo ser modificada";
        
        // Obtenemos los IDs que nos pasan
        $idProduct = $this->input->post("idProduct");
        $idSize = $this->input->post("idSize");
        $cantidad = $this->input->post("cantidad");
        
        // llamamos el modelo
        $productSize = $this->productSizeModel->updateSizeById( $idProduct, $idSize, $cantidad );
        
        // Si NO regresa falso... preparamos la respuesta
        if(false !== $productSize) {
            $response["responseStatus"] = "OK";
            $response["message"] = "Cantidad modificada correctamente";
        }
        
        // Regresamos el resultado con formato
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode( $response ));
            
    }
    
    // Adicionamos una nueva combinación de producto y talla, así como su existencia
    // Parámetros requeridos:
    //      idProduct
    //      idSize
    //      cantidad
    // ----------------------------------------------------------------------------------------
    public function sizeAdd()
    {
        $response["responseStatus"] = "FAIL";
        $response["message"] = "Talla no pudo ser insertada";
        
        // Obtenemos los IDs que nos pasan
        $idProduct = $this->input->post("idProduct");
        $idSize = $this->input->post("idSize");
        $cantidad = $this->input->post("cantidad");
        
        // llamamos el modelo
        $resultado = $this->productSizeModel->sizeAdd( $idProduct, $idSize, $cantidad );
        
        // Si NO regresa falso... preparamos la respuesta
        if(false !== $resultado) {
            $response["responseStatus"] = "OK";
            $response["message"] = "Talla insertada correctamente";
            $response["data"] = $resultado;
        }
        
        // Regresamos el resultado con formato
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode( $response ));
            
    }
    
    // Eliminamos una combinación de producto y talla, así como su existencia
    // Parámetros requeridos:
    //      idProduct
    //      idSize
    // ----------------------------------------------------------------------------------------
    public function sizeDelete()
    {
        $response["responseStatus"] = "FAIL";
        $response["message"] = "Talla no pudo ser eliminado para el producto";
        
        // Obtenemos el id del producto 
        $idProduct = $this->input->post("idProduct");
        // Si pasan idSize lo tomamos, si no le asignamos 0 que significará TODOS en código
        $idSize = $this->input->post("idSize");
        $idSize = ( trim( $idSize ) == "" ? 0 : $idSize );

        // llamamos al modelo
        $resultado = $this->productSizeModel->sizeDelete( $idProduct, $idSize );
        
        // Si NO regresa falso... preparamos la respuesta
        if(0 !== $resultado) {
            $response["responseStatus"] = "OK";
            $response["message"] = "Talla eliminada correctamente para el producto";
        }
        
        // Regresamos el resultado con formato
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode( $response ));
            
    }    

    


}

/* End of file welcome.php */
/* Location: ./application/controllers/productController.php */
