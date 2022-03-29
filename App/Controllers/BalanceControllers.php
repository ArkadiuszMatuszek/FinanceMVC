<?php

namespace App\Controllers;

use \Core\View;
use \App\Models\Balance;
use \App\Models\Expense;
use \App\Models\Income;

/**
 * AddIncome controller
 *
 * PHP version 7.0
 */
class BalanceControllers extends \Core\Controller
{

    /**
     * Show the AddIncome page
     *
     * @return void
     */
    public function newAction()
    {
		$this-> showBalance(2, date('Y'), date('m'));

    }

	public function decide(){
		
		$period = $_POST['periodOfTime'];
		
		if($period == 2){
			$this-> showBalance(2, date('Y'), date('m'));
		}
		else if($period == 3){
			if(date('m') == 1){
				$this-> showBalance(3, date('Y')-1, 12);
			}else{
				$this-> showBalance(3, date('Y'), (date('m')-1));
			}	
		}
		else if($period == 4){
			$this-> showBalance(4, date('Y'));
		}
		else if($_POST['periodOfTime'] == 5){
			View::renderTemplate('/Balance/new.html', ['option' => 5]);
		}
	}
	
	public function showBalance($option, $year, $month=''){
		
		$showNameOfExpensesCattegories = Expense::findAllExpensesCattegories();
		$showNameOfIncomesCattegories = Income::findAllIncomesCattegories();
		
		$balance = new Balance( );
		$balance->setBalance($year, $month);
		View::renderTemplate('/Balance/new.html',
			array('incomes' => $balance->getIncomes(), 'incomesCategory' => $balance->getIncomesCategory(), 
			'expensesCategory' =>$balance->getExpensesCategory(), 'expenses' => $balance->getExpenses(), 
			'saldoIncomes' => $balance->getIncomesAmount(), 'saldoExpenses' =>$balance->getExpensesAmount(), 'option' => $option,
			'showNameOfExpensesCattegories' => $showNameOfExpensesCattegories, 
			'showNameOfIncomesCattegories' => $showNameOfIncomesCattegories
			)
			);
		
	}
	
	public function showBalanceForPeriodOfTime(){
		
		$showNameOfExpensesCattegories = Expense::findAllExpensesCattegories();
		$showNameOfIncomesCattegories = Income::findAllIncomesCattegories();
		
		if(isset($_POST['date1']) && isset($_POST['date2']) ){

			$balance = new Balance();
			if($balance->setBalanceByPeriodOfTime($_POST['date1'], $_POST['date2'])){
				
				View::renderTemplate('/Balance/new.html',
				array('incomes' => $balance->getIncomes(), 'incomesCategory' => $balance->getIncomesCategory(), 
				'expensesCategory' =>$balance->getExpensesCategory(), 'expenses' => $balance->getExpenses(), 
				'saldoIncomes' => $balance->getIncomesAmount(), 'saldoExpenses' =>$balance->getExpensesAmount(),  'option' => 2,
				'showNameOfExpensesCattegories' => $showNameOfExpensesCattegories,
				'showNameOfIncomesCattegories' => $showNameOfIncomesCattegories
				)
				);
			}
			else{
				View::renderTemplate('/Balance/balance.html', ['option' => 5, 'balance' => $balance]);
			}	
		}
	}

	

	
}
