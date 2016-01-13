<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Product extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	

	public function getAll()
	{
		$response["responseStatus"] = "Not OK";

		// load model
		$this->load->model("productmodel");

		$response["products"] = $this->productmodel->getAll();
		$response["responseStatus"] = "OK";

		echo json_encode($response);
	}

	public function getAvailability()
	{
		$response["responseStatus"] = "Not OK";
		$productID = $this->input->post("idProduct");
		$this->load->model("productmodel");
		$productAvailability = $this->productmodel->getAvailability(productID);
		if (false !== $productAvailability)
		{
			$response["responseStatus"] = "OK";
			$response["availability"] = true;
			$response["qty"] = $productAvailability->qty;
		}
		echo json_encode($response);

	}


	public function ProductImgDelete()
	{
		$response["responseStatus"] = " FAIL";
		$response["message"] = "Imagen no pudo ser eliminada";

		$idProduct = $this->input->post("idProduct");
		$idimg = $this->input->post("id");
		
		$this->load->model("productmodel");
		$resultado = $this->input->productmodel->ProductImgDelete($idProduct,$id);

		if(false!== $resultado)
		{
			$response["responseStatus"] = "OK";
			$response["message"] = "Imagen eliminada correctamente";
		
		}
		$this->output->set_content_type ('application/json')->set_output(json_encode($response));
	}



}

/* End of file product.php */
/* Location: ./application/controllers/product.php */