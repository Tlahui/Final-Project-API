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

    function productDelete($idProduct)
    {
        $this->db->where("id",$idProduct);
        $this->db->select("id");
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
           
        }
        return false;
    }


 function ProductLike($idProduct, $idUser){  
        $dataProductLike = array(
            'idProduct' => $idProduct,
            'idUser' => $idUser);

        $this->db->where('idProduct', $idProduct);
        $this->db->where('idUser', $idUser);
        $query = $this->db->get('ProductLike');
        $response["responseStatus"]= "NOT OK";    //ya existe un like en el mismo producto 
        if($query->num_rows()==0){ //no existe relación usuario y producto, entonces agrego
             $response["responseStatus"]= "ok";
            if( $this->db->insert('ProductLike', $dataProductLike)){
                $count = $this->db->get_where('ProductLike', array('idProduct' => $idProduct))->num_rows;
                
                $response["responseStatus"]= 'OK';
                $response["idProduct"]= $idProduct;
                $response["idUser"]= $idUser;
                $response["likes"]= $count;
                return $response;
            }
            else{
                return false;
            }
        }
        echo json_encode($response);             
    }
}