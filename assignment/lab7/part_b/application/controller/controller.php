<?php
// Create the controller class for the MVC design pattern
class Controller {

	// Declare public variables for the controller class
	public $load;
	public $model;
	
	// Create functions for the controller class
	function __construct($pageURI = null) // constructor of the class
	{
		$this->load = new Load(); 
		$this->model = new Model();
		// determine what page you are on
		
    // Parse the URI to get the controller action
    $action = $this->parseURI($pageURI);

    // Call the corresponding controller action
    if ($action) {

        $this->$action();

    } else {

        $this->home(); // Default action if URI doesn't specify one
    }


}


function parseURI($uri) {
	
    // Example parsing logic, modify as needed
    $parts = explode('/', $uri);
    $action = end($parts); // Last part of URI usually represents the action
    return $action;
}

    // home page function
	function home()
	{
		$data = $this->model->model3D_info();
		$this->load->view('view3DAppTest_2', $data);
	}

	function apiCreateTable()
	{
	  	// echo "Create table function";
		$data = $this->model->dbCreateTable();
		$this->load->view('viewMessage', $data);
	}
	function apiInsertData()
	{
		$data = $this->model->dbInsertData();
	   	$this->load->view('viewMessage', $data);
	}  
	function apiGetData()
	{
		$data = $this->model->dbGetData();
		$this->load->view('view3DAppData', $data);
	}  
	
	function dbCreateTable()
	{
		echo "Create Table Function";
	}

	function dbInsertData()
	{
		echo "Data Insert Function";
	}

	function dbGetData()
	{
		echo "Data Read Function";
	}

}
?>    