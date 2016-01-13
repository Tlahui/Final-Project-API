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

    function productCategory($idProductCategory) {
        $this->db->select('Product.id, nombre, precio, descripcion');
        $this->db->from('Product');
        $this->db->join('ProductCategory', 'Product.id = ProductCategory.idProduct');
        $this->db->where('idCategory',$idProductCategory);
        $query = $this->db->get();
        $response["responseStatus"]= "FAIL";    //NO existen productos 
        $response["message"] = "No existen productos de esta categoria";

        if($query->num_rows()>0){
            return $query->result_array();
        }else{
            return $response;
        }
    }

}