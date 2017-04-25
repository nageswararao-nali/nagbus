<?php
/**
 @ Laabus Helper functions
 @ By Manikanta
 */
defined('BASEPATH') OR exit('No direct script access allowed');

function load_instance(){
	$CI=get_instance();
	$CI->load->model('site/Site_model');
	return $CI->Site_model;
}

function company_name(){
	$m=load_instance();
	return $m->get_name();		
}

function page_title(){
	$m=load_instance();
	return $m->get_title();
}

function favicon(){
	$m=load_instance();
	return $m->get_favicon();
}

function logo(){
	$m=load_instance();
	return $m->get_logo();	
}

function keywords(){
	$m=load_instance();
	return $m->get_keywords();	
}

function description(){
	$m=load_instance();
	return $m->get_description();	
}

?>
