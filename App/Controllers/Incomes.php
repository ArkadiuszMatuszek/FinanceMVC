<?php

namespace App\Controllers;

use \Core\View;
use \App\Models\Income;


/**
 * Home controller
 *
 * PHP version 7.0
 */
class Incomes extends \Core\Controller
{

    /**
     * Show the index page
     *
     * @return void
     */
    public function indexAction()
    {	
		$today = Income::todayDate();
		$cattegories = Income::findAllIncomesCattegories();
		
		$user_id=$_SESSION['user_id'];
		
		if(!isset($user_id)){
			View::renderTemplate('/Signup/new.html');
		}else{
			 View::renderTemplate('/Incomes/new.html', 
		['today' => $today,
		'cattegories' => $cattegories
		]
		);
		}
		
       
		
		
		
		
    }
	
	public function createAction(){
		
		$income = new Income($_POST);
		
		
		if ($income->saveIncomes()){
			
		View::renderTemplate('Incomes/success.html');
		
		}else{
			View::renderTemplate('Incomes/new.html');
		}
		
	}
	
	
}
