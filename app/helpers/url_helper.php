<?php 
// Simple page redirect
function redirect($page)
{
	header("Location: ".ROOTURL.'/'.$page);   
} 
 