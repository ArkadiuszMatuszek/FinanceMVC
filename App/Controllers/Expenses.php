<?php

namespace App\Controllers;

use \Core\View;
use \App\Models\Expense;
use \App\Models\Income;
use \App\Models\User;
use \App\Models\Tables;



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
		$cattegories = Expense::findAllExpensesCattegories();
		$paymentMethods = Expense::findAllPaymentMethods();
		
		
		
		
		$user_id=$_SESSION['user_id'];
		if(!isset($user_id)){
			View::renderTemplate('/Signup/new.html');
		}else{
        View::renderTemplate('/Expenses/new.html', 
		['today' => $today,
		'cattegories' => $cattegories,
		'paymentMethods' => $paymentMethods
		
		]
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

	public function getAmountOfExpenseThisMonthAction() {
		$date_start = date('Y-m').'-01';
		$date_end = date('Y-m-d');
		$this->expenses = Expense::getExpenseAssignetToUser($date_start, $date_end);
		echo json_encode($this->expenses);		
	}
	
	public function getLimitOfExpenseAction() {		
		$this->expensesCategory = Expense::getExpenseCategory();
		echo json_encode($this->expensesCategory);
	}



	
	
	
	
}
