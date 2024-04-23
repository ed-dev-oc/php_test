<?php
	$classes = glob($_SERVER['DOCUMENT_ROOT']."/models/*.php");
	
	foreach($classes as $class){
		require_once $class;
	}