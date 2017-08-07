<?php
	class Post 
	{ 
		var $post_id;
		var $first_name;
		var $last_name; 
		var $post_text;
		var $date; 
		
		function __construct($post_id, $first_name, $last_name, $post_text, $date)
		{
			$this->post_id = $post_id;
			$this->first_name = $first_name;
			$this->last_name = $last_name;
			$this->post_text = $post_text;
			$this->date = $date;
		}
	}
?>