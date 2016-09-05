<?php
/**
 * 
 */
 class mainpage extends CI_controller
 {
 	
 	function index()
 	{
 		$this->load->view('main');


 	}
 	function email()
 	{
 		$this->load->view('emailerror');
 	}
 	function password()
 	{
 		$this->load->view('passworderror');
 	}
 	function home()
 	{
 		$this->load->view('homepage');
 	}

 	function login()
 	{


 		$user['email']=$this->input->post('email');
 		$user['password']=$this->input->post('password');
 		#print_r($user);
 		$url='http://api.baabtra.com/LoginService/login.php';
 		$options=array('http'=>array(
 									'header'=>"Content-type: application/x-www-form-urlencoded\r\n",
 									'method'=>'POST',
 									'content'=>http_build_query($user),
 									),
 		                            );
 		$context=stream_context_create($options);
 		$result=file_get_contents($url,false,$context);

 		$json=json_decode($result,true);
 		print_r($json);

 		if ($json[0]['ResponseCode']==200)
 		{

            $this->load->view('homepage');
        }	

        if ($json[0]['ResponseCode']==404)
        {
              $this->load->view('emailerror');
        }
        if ($json[0]['ResponseCode']==500)
        {
        	$this->load->view('passworderror');
        }
 							
 	}

 } 	
 ?>
