<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ProductSizeModel extends CI_Model {

    /**
     * Modelo definido para interactuar con la tabla "ProductSize"
     *
     */

    function __construct()
    {
        parent::__construct();
    }

    /**
     * Insertar en la tabla ProductSize
     *
     *
     * @author Chiunti
     * @param NewProductSize|array
     * @return ProductSizeID|integer
     */
    function productSizeInsert($newProductSize) {
        /*
        *
        * Insert new Product Size
        *
        */

        $this->db->insert("ProductSize",$newProductSize);
        $productSizeID = $this->db->insert_id();
        return $productSizeID;

    }

    /**
     * Insertar multiples Product Sizes
     *
     *
     * @author Chiunti
     */
    function productSizesInsert($newProductSizes){
        /*
        *
        * Insert multiple Product Sizes
        *
        */

        foreach($newProductSizes as $newProductSize){
            self::productSizeInsert($newProductSize);
        }

    }





    // Obtenemos todos los tamaños disponibles, de un idProduct determinado
    // ----------------------------------------------------------------------------------------
    public function listarProductSize( $idProduct ) {

        // Un SELECT ... JOIN a la tabla de tallas de productos
        $this->db->select("idSize, nombre, cantidad");
        $this->db->where("idProduct", $idProduct);
        $this->db->join("size", "productsize.idSize = size.id");
        
        // Regresamos todos los registros que encuentre 
        $products = $this->db->get("productsize")->result_array();
        
        return $products;
        
    }

    // Obtenemos todos los tamaños disponibles, de un idProduct determinado
    // ----------------------------------------------------------------------------------------
    public function updateSizeById( $idProduct, $idSize, $cantidad ) {
    
        // UPDATE a las tallas disponibles
        $data = array( 'cantidad' => $cantidad );   
        $this->db->where("idProduct", $idProduct);
        $this->db->where("idSize", $idSize);
        $this->db->update("productsize", $data);
        
        // OJO: Si el UPDATE se lleva a cabo regresa 1 línea afectada
        // sin embargo, si repito el UPDATE, como ya no modifica la cantidad porque sería la misma
        // regresa 0
        return ( $this->db->affected_rows() == 1 );
        
    }
    
    // Adicionamos una nueva combinación de producto y talla (size), más su cantidad (existencia)
    // ----------------------------------------------------------------------------------------
    public function sizeAdd( $idProduct, $idSize, $cantidad ) {
    
        // db_debug TIENE que estar a FALSE para que _error_number funcione
        // sin embargo, para no moverle a la configuración, guardaremos el valor actual,
        // lo cambiaremos, y luego lo dejamos como estaba
        $orig_db_debug = $this->db->db_debug;
        $this->db->db_debug = FALSE;    
    
        $data = array( 
            'idProduct' => $idProduct,
            'idSize' => $idSize,
            'cantidad' => $cantidad
        );  
        
        // Insertamos una nueva cantidad de un producto y talla
        $this->db->insert("productsize",$data);
        
        // Regresamos el valor como estaba
        $this->db->db_debug = $orig_db_debug;
        
        // Si se ejecutó exitosamente ...
        if ( $this->db->_error_number() == 0 ) {        
            $userID = $this->db->insert_id();
            return $userID;
        } else {
            return false;
        }
        
    }
    
    // Eliminamos una combinación de producto y talla (size)
    // size es opcional, si no lo pasan borraos todos los idProduct encontrados
    // ----------------------------------------------------------------------------------------
    public function sizeDelete( $idProduct, $idSize ) {
    
        // ejecutamos un DELETE
        $this->db->where("idProduct",$idProduct);
        if ( $idSize != 0 ) {
            $this->db->where("idSize",$idSize);
        }
        $this->db->delete("productsize");

        // Regresamos las líneas afectadas por el DELETE
        // 0 significará que no se borró nada       
        return $this->db->affected_rows();
        
    }


}
