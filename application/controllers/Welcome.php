<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		$__data_model 				= array(
			array('dish' => 'Veg Biryani','available' => 5,'price'=> 70),
			array('dish' => 'Chicken Biryani','available' => 15,'price'=> 100),
			array('dish' => 'Meal','available' => 5,'price'=> 70),
			array('dish' => 'Special Meal','available' => 15,'price'=> 100),
			array('dish' => 'Tea','available' => 100,'price'=> 10)
		);
	}

	public function index()
	{
		$this->load->view('404');
	}
	public function order()
	{
		$dish_name 	= $this->input->post('dish_name');
		$quantity 	= $this->input->post('quantity');
		$response 	= array();
		if(!empty($dish_name))
		{
			try
			{
				foreach($__data_model as $key => $data_items)
				{
					if($data_items['dish'] == $dish_name)
					{
						if($data_items['available'] > $quantity)
						{
							$response['message'] 	= "quantity not availble";
							$response['available'] 	= $data_items['available'];
							throw new Exception();
						}
						else
						{
							$response['message'] 	= "items fetched";
							$__data_model[$key]['available'] = $data_items['available'] - $quantity;
							$response['available'] 	= $__data_model[$key]['available'];
							throw new Exception();
						}
					}
				}
			}
			catch(Exception $e) 
			{
				echo json_encode($response);
			}
			
		}
	}
}
