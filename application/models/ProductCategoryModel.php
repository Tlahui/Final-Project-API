<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ProductCategoryModel extends CI_Model {

    /**
     * Modelo definido para interactuar con la tabla "ProductCategory"
     *
     */

    function __construct()
    {
        parent::__construct();
    }

    /**
     * Agregar Product Category
     *
     *
     * @author Chiunti
     * @param  NewProductCategory|Array
     * @return ProductCategoryId|integer
     */
    function productCategoryInsert($newProductCategory) {
        $this->db->insert("ProductCategory",$newProductCategory);
        $productCategoryID = $this->db->insert_id();
        return $productCategoryID;
    }

}