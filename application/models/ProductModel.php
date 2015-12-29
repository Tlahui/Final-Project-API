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
        echo 'Holl:::'.$editProducto["id"];
        $this->db->where("id",$editProducto["id"]);
        $this->db->select("id");
        $found = $this->db->get("Product")->row();
          
        if($found)
        {
            //echo '<br>Busca:'.$found->id;
            $this->db->where("idProduct",$editProducto["id"]);
            $this->db->select("id");
            $foundProdCat = $this->db->get("ProductCategory")->row();
            var_dump($foundProdCat->id);

            if($foundProdCat)
            {
                $idCategoria=$foundProdCat->id;
                $this->db->set('idCategory', $editProducto["idProductCategory"]);
                $this->db->where('id', $idCategoria);
                $this->db->update('ProductCategory');
            }

            $this->db->set('nombre', $editProducto["nombre"]);
            $this->db->set('precio', $editProducto["precio"]);
            $this->db->set('oferta', $editProducto["oferta"]);
            $this->db->set('descripcion', $editProducto["descripcion"]);
            $this->db->where('id', $editProducto["id"]);
            $this->db->update('Product');
            return $editProducto["id"];
           
        }
        return 0;
    }
}