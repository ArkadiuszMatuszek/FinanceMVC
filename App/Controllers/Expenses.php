<?php

namespace App\Controllers;

use \Core\View;
use \App\Models\Expense;
use \App\Models\Income;


/**
 * Home controller
 *
 * PHP version 7.0
 */
class Expenses extends \Core\Controller
{

    /**
     * Show the index page
     *
     * @return void
     */
    public function indexAction()
    {	
        
		
		$today = Income::todayDate();
		
		
		$user_id=$_SESSION['user_id'];
		if(!isset($user_id)){
			View::renderTemplate('/Signup/new.html');
		}else{
        View::renderTemplate('/Expenses/new.html', 
		['today' => $today]
		);
		}
    }
	
	
	public function createAction(){
		
		$expense = new Expense($_POST);
		
		
		if ($expense->saveExpenses()){
			
		View::renderTemplate('Expenses/success.html');
		
		}else{
			View::renderTemplate('Expenses/new.html');
		}
		
	}
	
	
}
