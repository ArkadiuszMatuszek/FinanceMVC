<?php

namespace App\Controllers;

use \Core\View;
use \App\Models\User;
use \App\Auth;
use \App\Flash;

/**
 * Login controller
 *
 * PHP version 7.0
 */
class Login extends \Core\Controller
{

    /**
     * Show the login page
     *
     * @return void
     */
    public function newAction()
    {
        View::renderTemplate('Login/new.html');
    }

    /**
     * Log in a user
     *
     * @return void
     */
    public function createAction()
    {
        $user = User::authenticate($_POST['username'], $_POST['password']);

		$remember_me = isset($_POST['remember_me']);

        if ($user) {
			
			Auth::login($user, $remember_me);
			
			$user_id2 = User::IsUserIdExists();
			
			if($user_id2 == false){
				User::transferPaymentMethods();
				User::transferIncomesCattegory();
				User::transferExpensesCattegory();
			}

			Flash::addMessage('Login successful');
			
			View::renderTemplate('Home/index.html');
			
			
         

        } else {
			
			Flash::addMessage('Login unsuccessful, please try again', Flash::WARNING);

            View::renderTemplate('Login/new.html', [
			'username' => $_POST['username'],
			]);
        }
    }
	
	public function destroyAction(){
			

		Auth::logout();
		
		$this->redirect('/login/show-logout-message');
		
		
	}
	
	public function showLogoutMessageAction(){
		Flash::addMessage('Logout successful');

		$this->redirect('/');
	}
	
	
	
}
