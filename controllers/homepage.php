<?php
	require_once $_SERVER['DOCUMENT_ROOT']."/models/autoload.php";

	$users = User::all();

	require "views/homepage.views.php";