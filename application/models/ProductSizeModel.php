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
    
}
