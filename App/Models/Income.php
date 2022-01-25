<?php

namespace App\Models;

use PDO;


class Income extends \Core\Model
{
	 public $errors = [];
	
	
	public function __construct($data = [])
    {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        };
    }
	
	public function saveIncomes()
    {
		
		$user_id=$_SESSION['user_id'];
		
		echo $user_id;
		
		$this->validateIncomes();

        if (empty($this->errors)) {

         $sql = 'INSERT INTO incomes (user_id, income_category_assigned_to_user_id, amount, date_of_income, income_comment)
                    VALUES (:user_id, :income_category_assigned_to_user_id, :amount, :date_of_income, :income_comment)';
		$db = static::getDB();
            $stmt = $db->prepare($sql);

            $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
            $stmt->bindValue(':income_category_assigned_to_user_id', $this->income_category_assigned_to_user_id, PDO::PARAM_INT);
            $stmt->bindValue(':amount', $this->amount, PDO::PARAM_STR);
            $stmt->bindValue(':date_of_income', $this->date_of_income, PDO::PARAM_STR);
            $stmt->bindValue(':income_comment', $this->income_comment, PDO::PARAM_STR);

            return $stmt->execute();
		}
		return false;
     
    }
	
	public function validateIncomes()
    {
        // Amount
        if ($this->amount == '') {
            $this->errors[] = 'Amount cannot be empty!';
        }

        // Date
        if ($this->date_of_income == '') {
            $this->errors[] = 'You didnt write any date';
        }	

       
    }
	
	public static function findByDateOrCategory($year, $month='', $income_category_assigned_to_user_id ='')
    {
		if($month =='' && $income_category_assigned_to_user_id == true){
			$sql = 'SELECT SUM(amount) as sum, income_category_assigned_to_user_id, 
			income_comment FROM incomes WHERE user_id = :user_id && year(date_of_income) = 
			:year GROUP BY income_category_assigned_to_user_id';
		}else if($month ==''){
			$sql = 'SELECT date_of_income, amount, income_category_assigned_to_user_id,
			income_comment FROM incomes WHERE user_id = :user_id && year(date_of_income) = :year';
		}else if($income_category_assigned_to_user_id == ''){
			$sql = 'SELECT date_of_income, amount, income_category_assigned_to_user_id,
			income_comment FROM incomes WHERE user_id = :user_id && month(date_of_income) = 
			:month && year(date_of_income) = :year';
		}else{
			$sql = 'SELECT SUM(amount) as sum, income_category_assigned_to_user_id, 
			income_comment FROM incomes WHERE user_id = :user_id && month(date_of_income) = :month && year(date_of_income)
			= :year GROUP BY income_category_assigned_to_user_id' ;
		}
		
		$db = static::getDB();
		$stmt = $db->prepare($sql);

        
        $stmt->bindValue(':user_id', $_SESSION['user_id'], PDO::PARAM_INT);
        if($month !=''){
		$stmt->bindValue(':month', $month, PDO::PARAM_STR);
		}
        $stmt->bindValue(':year', $year, PDO::PARAM_STR);
		
		
        $stmt->setFetchMode(PDO::FETCH_CLASS, get_called_class());
		
        $stmt->execute();
		

        return $stmt->fetchAll();
    }
	
	 public static function findByPeriodOfTimeOrCategory($date_of_income1, $date_of_income2, $income_category_assigned_to_user_id='')
    { 
			if($income_category_assigned_to_user_id == '')
				$sql = 'SELECT date_of_income, amount, income_category_assigned_to_user_id FROM incomes WHERE user_id = :user_id && date_of_income>= :date_of_income1 && date_of_income<= :date_of_income2';
			else
				$sql = 'SELECT SUM(amount) as sum, income_category_assigned_to_user_id FROM incomes WHERE user_id = :user_id && date_of_income>= :date_of_income1 && date_of_income<= :date_of_income2 GROUP BY income_category_assigned_to_user_id' ;
			
			$db = static::getDB();
			$stmt = $db->prepare($sql);
			$stmt->bindValue(':user_id', $_SESSION['user_id'], PDO::PARAM_INT);
			$stmt->bindValue(':date_of_income1', $date_of_income1, PDO::PARAM_STR);
			$stmt->bindValue(':date_of_income2', $date_of_income2, PDO::PARAM_STR);

			$stmt->setFetchMode(PDO::FETCH_CLASS, get_called_class());

			$stmt->execute();

			return $stmt->fetchAll();
    }
	
	public static function incomesAmount($year, $month=''){
		
		if($month !=''){
			$sql = 'SELECT SUM(amount) as sum FROM incomes WHERE user_id = :user_id && month(date_of_income) = :month && year(date_of_income) = :year';
		}
		else{
			$sql = 'SELECT SUM(amount) as sum FROM incomes WHERE user_id = :user_id && year(date_of_income) = :year';
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
	
	public static function incomesAmountByPeriodOfTime($date_of_income1, $date_of_income2)
    { 
			$sql = 'SELECT SUM(amount) as sum FROM incomes WHERE user_id = :user_id && date_of_income>= :date_of_income1 && date_of_income<= :date_of_income2' ;
			
			$db = static::getDB();
			$stmt = $db->prepare($sql);
			$stmt->bindValue(':user_id', $_SESSION['user_id'], PDO::PARAM_INT);
			$stmt->bindValue(':date_of_income1', $date_of_income1, PDO::PARAM_STR);
			$stmt->bindValue(':date_of_income2', $date_of_income2, PDO::PARAM_STR);

			$stmt->setFetchMode(PDO::FETCH_CLASS, get_called_class());

			$stmt->execute();

		return $stmt->fetchAll();
    }
	
	public static function todayDate(){
		$month = date('m');
		$day = date('d');
		$year = date('Y');

		$today = $year . '-' . $month . '-' . $day;
			
		
		return $today;
	}
	
	
	
	
  
}
