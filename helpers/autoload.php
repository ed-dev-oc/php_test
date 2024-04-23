<?php
	$classes = glob($_SERVER['DOCUMENT_ROOT']."/helpers/*.php");
	
	foreach($classes as $class){
		require_once $class;
	}