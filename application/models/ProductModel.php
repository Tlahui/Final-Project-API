<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ProductModel extends CI_Model {

    /**
     * Modelo definido para interactuar con la tabla "Product"
     *
     */

    function __construct()
    {
        parent::__construct();
    }

    /**
     * Listado de productos
     *
     * Obtiene un array con los registros de la tabla ProductImage
     * y en caso que no exista revuelve false
     *
     * @author Gosh
     * @return Array|boolean
     */
    function ProductList(){
        $query = $this->db->get('Product');
        if($query->num_rows()>0){
            return $query->result_array();
        }else{
            return false;
        }
    }

    /**
     * Listado de productos en Oferta
     *
     * Obtiene un array con los registros de la tabla ProductImage
     * y en caso que no exista revuelve false
     *
     * @author Chiunti
     * @return Array|boolean
     */
    function ProductListFeatured(){
        $query = $this->db->get_where('Product', array('oferta' => 1));
        if($query->num_rows()>0){
            return $query->result_array();
        }else{
            return false;
        }
    }

    /**
    *
    * Insert new Product
    *
    * @author Chiunti
    * @param  NewProduct|Array 
    * @return Product Id |Integer
    */
    function productInsert($newProduct){

        $this->db->insert("Product",$newProduct);
        $productID = $this->db->insert_id();
        return $productID;
    }


    function productEdit($editProducto)
    {


        echo "holll:".$editProducto["id"];
        echo "helellll".$editProducto["id"];

        //$this->db->where("id",$editProducto["id"]);
/*        $this->db->select("id");
        $found = $this->db->get("Product")->row();
        if($found)
        {

            $this->db->where("idProduct",$idProduct);
            $this->db->select("idProduct");
            $foundProdCat = $this->db->get("ProductCategory")->row();
            if($foundProdCat)
            {
                $this->db->where('idProduct', $idProduct);
                $this->db->delete('ProductCategory');
            }

            $this->db->where("idProduct",$idProduct);
            $this->db->select("idProduct");
            $foundProdIma = $this->db->get("ProductImage")->row();
            if($foundProdIma)
            {
                $this->db->where('idProduct', $idProduct);
                $this->db->delete('ProductImage');
            }

            $this->db->where("idProduct",$idProduct);
            $this->db->select("idProduct");
            $foundProdSize = $this->db->get("ProductSize")->row();
            if($foundProdSize)
            {
                $this->db->where('idProduct', $idProduct);
                $this->db->delete('ProductSize');
            }

            $this->db->where("idProduct",$idProduct);
            $this->db->select("idProduct");
            $foundProdLike = $this->db->get("ProductLike")->row();
            if($foundProdLike)
            {
                $this->db->where('idProduct', $idProduct);
                $this->db->delete('ProductLike');
            }

            $this->db->where('id', $idProduct);
            $this->db->delete('Product');
            return true;
           
        }*/
        return false;

    }

}