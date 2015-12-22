<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CategoryModel extends CI_Model {

    /**
     * Modelo definido para interactuar con la tabla "Category"
     *
     */

    function __construct()
    {
        parent::__construct();
    }

    /**
     * Listado de categorias por producto
     *
     * Obtiene basado en el idProduct un array con los registros de la tabla Category,
     * utilizando su tabla intermedia ProductCategory
     * y en caso que no exista revuelve cero
     *
     * @param id $id ID del producto
     * @author Gosh
     * @return Array|0
     */
    function CategoryFromProduct($id){
        $this->db->select('Category.id, Category.nombre');
        $this->db->from('ProductCategory');
        $this->db->where('ProductCategory.idProduct', $id);
        $this->db->join('Category', 'Category.id = ProductCategory.idCategory');
        $query = $this->db->get();
        if($query->num_rows()>0){
            return $query->result_array();
        }else{
            return 0;
        }
    }
}