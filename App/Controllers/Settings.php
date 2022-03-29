<?php

namespace App\Controllers;

use \Core\View;
use \App\Auth;
use \App\Models\User;
use \App\Models\Setting;
use \App\Models\Income;
use \App\Models\Expense;




/**
 * Login controller
 *
 * PHP version 7.0
 */
class Settings extends \Core\Controller
{

   
    public function newAction()
    {	
		$IncomesCattegories = Income::findAllIncomesCattegories();
		$ExpensesCattegories = Expense::findAllExpensesCattegories();
		$PaymentMethodsCattegories = Expense::findAllPaymentMethods();
		
		$user_id = $_SESSION['user_id'];
		
	
        View::renderTemplate('Settings/new.html',[
		'IncomesCattegories' => $IncomesCattegories,
		'user_id' => $user_id,
		'ExpensesCattegories' => $ExpensesCattegories,
		'PaymentMethodsCattegories' => $PaymentMethodsCattegories
		]);
    }
	
	public function addExpense(){

		$settings = new Setting($_POST);
		
		

		if ($settings->AddNewExpenseCategorie()){
		View::renderTemplate('Settings/success.html');
			
			}else{
				View::renderTemplate('Settings/new.html');
			}
		
	}
	
	public function addIncome(){

		$settings = new Setting($_POST);
		
		


		if ($settings->AddNewIncomeCategorie()){
			
			View::renderTemplate('Settings/success.html');
			
			}else{
				View::renderTemplate('Settings/new.html');
			}
		
	}
	
	public function addPaymentMethod(){

		$settings = new Setting($_POST);
		
		

		if ($settings->AddNewPaymentMethod()){
			
			View::renderTemplate('Settings/success.html');
			
			}else{
				View::renderTemplate('Settings/new.html');
			}
		
	}
	
	public function deleteIncomesCattegory(){

		$settings = new Setting($_POST);
		
		
		

		if ($settings->deleteIncomesCattegory()){
			
			View::renderTemplate('Settings/success.html');
			
			}else{
				View::renderTemplate('Settings/new.html');
			}
		
	}
	
	public function changeIncomesName(){

		$settings = new Setting($_POST);
		
		
		

		if ($settings->editIncomesCattegory()){
			
			View::renderTemplate('Settings/success.html');
			
			}else{
				View::renderTemplate('Settings/new.html');
			}
		
	}
	
	public function deleteExpensesCattegory(){

		$settings = new Setting($_POST);
		
		
		

		if ($settings->deleteExpensesCattegory()){
			
			View::renderTemplate('Settings/success.html');
			
			}else{
				View::renderTemplate('Settings/new.html');
			}
		
	}
	
	public function changeExpensesName(){

		$settings = new Setting($_POST);
		
		
	

		if ($settings->editExpensesCattegory()){
			
			View::renderTemplate('Settings/success.html');
			
			}else{
				View::renderTemplate('Settings/new.html');
			}
		
	}
	
	public function deletePaymentsMethods(){

		$settings = new Setting($_POST);
		
		
		

		if ($settings->deletePaymentMethods()){
			
			View::renderTemplate('Settings/success.html');
			
			}else{
				View::renderTemplate('Settings/new.html');
			}
		
	}
	
	public function changePaymentsMethods(){

		$settings = new Setting($_POST);
		
		


		if ($settings->editPaymentMethod()){
			
			View::renderTemplate('Settings/success.html');
			
			}else{
				View::renderTemplate('Settings/new.html');
			}
		
	}

	public function setLimitsForExpenses(){

		$settings = new Setting($_POST);
		
		
		

		if ($settings->setLimitForExpenses()){
			
			View::renderTemplate('Settings/success.html');
			
			}else{
				View::renderTemplate('Settings/new.html');
			}
		
	}
	
}
