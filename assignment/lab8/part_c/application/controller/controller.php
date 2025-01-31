<?php
include './debug/ChromePhp.php';
ChromePhp::log('controller.php: Hello World');
ChromePhp::log($_SERVER);	

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

	// New methods for Part C of Lab 7 Tutorial, which use AJAX
	// Flickr API
	function apiGetFlickrService()
	{
		$this->load->view('viewFlickrService');
	}

	// API call to read JSON data from a JSON file
	function apiGetJson()
	{
		$this->load->view('viewJson');
	}

	// API call to select 3D images
	function apiLoadImage()
	{
	   // Get the brand data from the (this) Model using the dbGetBrand() meyhod in this Model class	
	   ChromePhp::warn('controller.php: [apiLoadImage] Get the Brand data');	
	   $data = $this->model->dbGetBrand();
	   // Note, the viewDrinks.php view being loaded here calls a new model
	   // called modelDrinkDetails.php, which is not part of the Model class
	   // It is a separate model illustrating that you can have many models
	   ChromePhp::log($data);  
	   $this->load->view('viewDrinks', $data);
	}
	
	// Old test methods to test the MVC design pattern
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