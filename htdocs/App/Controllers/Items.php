<?php

namespace App\Controllers;

use \Core\View;
use \App\Auth;

class Items extends Authenticated{
	
	
	
	public function indexAction(){

		view::renderTemplate('Items/index.html');
	}
	
}