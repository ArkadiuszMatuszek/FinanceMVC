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
		
        View::renderTemplate('/Incomes/new.html', 
		['today' => $today]
		);
		
		
		
		
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
