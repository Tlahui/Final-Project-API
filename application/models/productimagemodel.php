<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ProductImageModel extends CI_Model {

    /**
     * Modelo definido para interactuar con la tabla "ProductImage"
     *
     */

    function __construct()
    {
        parent::__construct();
    }

    /**
     * Listado de imagenes por producto
     *
     * Obtiene basado en el idProduct un array con los registros de la tabla ProductImage
     * y en caso que no exista revuelve cero
     *
     * @param id $id ID del producto
     * @author Gosh
     * @return Array|0
     */
    function ImageListFromProduct($id){
        $query = $this->db->get_where('ProductImage', array('idProduct' => $id));
        if($query->num_rows()>0){
            return $query->result_array();
        }else{
            return 0;
        }
    }

    public function  AddProductImage($productID, $url){
        $dataProductImage = array(
            'idProduct' => $productID,
            'url' => $url
        );
        $query = $this->db->insert('ProductImage', $dataProductImage);
           return true; 
        if($query){
            return $response; 
        }
        else{
            return false;
        }

    }

    function ImageFromProduct($id){    
        $query = $this->db->get_where('ProductImage', array('id' => $id));
        if ($query->num_rows() > 0)
            {
               return $query->row_array(); 
            }
        else
            {
                return false;
            }
    }

    function imageDelete($id){
        $this->db->where('id', $id);
        $this->db->delete('ProductImage');
        return true;
    }

}
