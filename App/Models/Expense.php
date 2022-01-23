<?php

namespace App\Models;

use PDO;
use \App\Token;

/**
 * Remembered login model
 *
 * PHP version 7.0
 */
class Expense extends \Core\Model
{
	public function __construct($data = [])
    {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        };
    }
	
	public function saveExpenses()
    {
   
		$user_id=$_SESSION['user_id'];
			
		$this->validate_of_expense();

        if (empty($this->errors)) {

         $sql = 'INSERT INTO expenses (user_id, expense_category_assigned_to_user_id, payment_method_assigned_to_user_id,
										amount, date_of_expense, expense_comment)
                    VALUES (:user_id, :expense_category_assigned_to_user_id, :payment_method_assigned_to_user_id, :amount,
							:date_of_expense, :expense_comment)';
		
		$db = static::getDB();
           $stmt = $db->prepare($sql);

            $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
            $stmt->bindValue(':expense_category_assigned_to_user_id', $this->expense_category_assigned_to_user_id, PDO::PARAM_INT);
			$stmt->bindValue(':payment_method_assigned_to_user_id', $this->payment_method_assigned_to_user_id, PDO::PARAM_INT);
			$stmt->bindValue(':amount', $this->amount, PDO::PARAM_STR);
            $stmt->bindValue(':date_of_expense', $this->date_of_expense, PDO::PARAM_STR);
            $stmt->bindValue(':expense_comment', $this->expense_comment, PDO::PARAM_STR);
           

            return $stmt->execute();
		}
		return false;
     
    }
	
	public function validate_of_expense()
    {
        // Amount
        if ($this->amount == '') {
            $this->errors[] = 'Amount cannot be empty!';
        }

        // date_of_expense
        if ($this->date_of_expense == '') {
            $this->errors[] = 'You didnt write any date_of_expense';
        }	

    }
	
	 public static function findByDateOrCategory($year, $month='', $expense_category_assigned_to_user_id ='')
    {
		if($month =='' && $expense_category_assigned_to_user_id == true)
			$sql = 'SELECT SUM(amount) as sum, expense_category_assigned_to_user_id, 
		expense_comment FROM expenses WHERE user_id = :user_id && year(date_of_expense)
		= :year GROUP BY expense_category_assigned_to_user_id';
		else if($month =='')
			$sql = 'SELECT date_of_expense, amount, expense_category_assigned_to_user_id, 
		expense_comment FROM expenses WHERE user_id = :user_id && year(date_of_expense) = :year';
		else if($expense_category_assigned_to_user_id == '')
			$sql = 'SELECT date_of_expense, amount, expense_category_assigned_to_user_id, 
		expense_comment FROM expenses WHERE user_id = :user_id && month(date_of_expense)
		= :month && year(date_of_expense) = :year';
		else
			$sql = 'SELECT SUM(amount) as sum, expense_category_assigned_to_user_id, 
		expense_comment FROM expenses WHERE user_id = :user_id && month(date_of_expense)
		= :month && year(date_of_expense) = :year GROUP BY expense_category_assigned_to_user_id' ;
		
        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':user_id', $_SESSION['user_id'], PDO::PARAM_INT);
        if($month !==''){
			$stmt->bindValue(':month', $month, PDO::PARAM_STR);
		}

       $stmt->bindValue(':year', $year, PDO::PARAM_STR);


       $stmt->setFetchMode(PDO::FETCH_CLASS, get_called_class());

        $stmt->execute();

        return $stmt->fetchAll();
    }
	
	public static function findByPeriodOfTimeOrCategory($date_of_expense1, $date_of_expense2, $expense_category_assigned_to_user_id='')
    {

		if($expense_category_assigned_to_user_id == '')
			$sql = 'SELECT date_of_expense, amount, expense_category_assigned_to_user_id, expense_comment FROM expenses WHERE user_id = :user_id && date_of_expense>= :date_of_expense1 && date_of_expense<= :date_of_expense2';
		else
			$sql = 'SELECT SUM(amount) as sum, expense_category_assigned_to_user_id, expense_comment FROM expenses WHERE user_id = :user_id && date_of_expense>= :date_of_expense1 && date_of_expense<= :date_of_expense2 GROUP BY expense_category_assigned_to_user_id' ;
		
        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':user_id', $_SESSION['user_id'], PDO::PARAM_INT);
        $stmt->bindValue(':date_of_expense1', $date_of_expense1, PDO::PARAM_STR);
        $stmt->bindValue(':date_of_expense2', $date_of_expense2, PDO::PARAM_STR);

        $stmt->setFetchMode(PDO::FETCH_CLASS, get_called_class());

        $stmt->execute();

        return $stmt->fetchAll();
    }
	
	public static function expensesAmount($year, $month=''){
		
		if($month !=''){
			$sql = 'SELECT SUM(amount) as sum FROM expenses WHERE user_id = :user_id && month(date_of_expense) = :month && year(date_of_expense) = :year';
		}
		else{
			$sql = 'SELECT SUM(amount) as sum FROM expenses WHERE user_id = :user_id && year(date_of_expense) = :year';
		}
		
		$db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':user_id', $_SESSION['user_id'], PDO::PARAM_INT);
        if($month !=='') $stmt->bindValue(':month', $month, PDO::PARAM_STR);
        $stmt->bindValue(':year', $year, PDO::PARAM_STR);


        $stmt->setFetchMode(PDO::FETCH_CLASS, get_called_class());

        $stmt->execute();

        return $stmt->fetchAll();
		
	}
	
	public static function expensesAmountByPeriodOfTime($date_of_expense1, $date_of_expense2)
    { 
			$sql = 'SELECT SUM(amount) as sum FROM expenses WHERE user_id = :user_id && date_of_expense>= :date_of_expense1 && date_of_expense<= :date_of_expense2' ;
			
			$db = static::getDB();
			$stmt = $db->prepare($sql);
			$stmt->bindValue(':user_id', $_SESSION['user_id'], PDO::PARAM_INT);
			$stmt->bindValue(':date_of_expense1', $date_of_expense1, PDO::PARAM_STR);
			$stmt->bindValue(':date_of_expense2', $date_of_expense2, PDO::PARAM_STR);

			$stmt->setFetchMode(PDO::FETCH_CLASS, get_called_class());

			$stmt->execute();

			return $stmt->fetchAll();
    }
	
  
}
