<?php

	require_once('db_connect.php');
	require_once('post.php');
	
	$first_name = $last_name = $post_text = null;
	$pressed = 0;
	
	$dataBase = new DataBase("localhost", "main_db", "hectic", "p");
	//$result = $dataBase->query("SELECT * FROM blogposts");
	$missingData = array();
	
	if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["post_text"]))
	{
	   /*if(empty($_POST['first_name'])
	   {
		 $first_name = trim($_POST["first_name"]
		 echo '<br>' . "Name is " . $first_name);
	   }
	
	   if(isset($_POST["last_name"]))
	   {
		  $last_name = trim($_POST["last_name"]
		  echo '<br>' . "Name is " . $last_name);
	   }
		
	   if(empty($_POST["post_text"]))
	   {
		  $post_text = trim($_POST["post_text"];
		  echo '<br>' . "Name is " . $post_text);
	   }*/
	   checkSet($_POST['first_name'], $first_name);
	   checkSet($_POST['last_name'], $last_name);
	   checkSet($_POST['post_text'], $post_text);
	   $dataBase->insert("blogposts", $first_name, $last_name, $post_text);
	   //$dataBase->insert("blogposts", "bill", "bob", "eat eggs all day");
	}
	
	if($_SERVER["REQUEST_METHOD"] == "GET")
	{
		showTableData();
	}	
	
	if(isset($_POST['action']))
	{
		$action = $_POST['action'];
		switch($action) 
		{
			case 'deleteRow' : $dataBase->deleteRow("blogposts", $_POST["post_id"]); break;
		}
	}
	
	function showTableData()
	{
		global $dataBase;
		$result = $dataBase->query("SELECT * FROM blogposts");
		$post = array();
		foreach($result as $row)
		{
			array_push($post, new Post($row['post_id'], $row['first_name'], $row['last_name'], $row['post_text'], $row['date'])); 
		}
		echo json_encode($post);
		
		/*echo '<table>';
			 foreach($result as $row)
			 {
				 echo '<tr><td>' . $row['post_id'] . 
				      '</td><td>' . $row['first_name'] . 
				      '</td><td>' . $row['last_name'] . 
					  '</td><td>' . $row['post_text'] . 
					  '</td><td><button onclick="">delete</button></td></tr>';
			 }
		echo '</table>';*/
	}
	
	function checkSet(&$postVal, &$setVal)
	{
		if(empty($postVal))
	    { 
	    }
		else
		{
		  $setVal = trim($postVal);
		  echo $setVal . " ";
		}
	}
?>