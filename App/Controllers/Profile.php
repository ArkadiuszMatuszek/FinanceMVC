<?php

namespace App\Controllers;

use \Core\View;
use \App\Auth;


/**
 * Login controller
 *
 * PHP version 7.0
 */
class Profile extends \Core\Controller
{

   
    public function newAction()
    {
        View::renderTemplate('Profile/new.html', [
			'user' => Auth::getUser()
		]);
    }

	
	
}
