<?php

namespace App\Models;

use PDO;

/**
 * User model
 *
 * PHP version 7.0
 */
class Setting extends \Core\Model
{
	public $errors = [];
	
	public function __construct($data = [])
    {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        };
    }
	
	public function AddNewExpenseCategorie(){
		
		$user_id=$_SESSION['user_id'];

		

		$sql = 'INSERT INTO expenses_category_assigned_to_users (user_id, name)
                    VALUES (:user_id, :nameOfExpenseCattegory)';
		
		$db = static::getDB();
           $stmt = $db->prepare($sql);

            $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
            $stmt->bindValue(':nameOfExpenseCattegory', $_POST['nameOfExpenseCattegory'], PDO::PARAM_STR);

            return $stmt->execute();
		
	}
	
	public function AddNewIncomeCategorie(){
		
		$user_id=$_SESSION['user_id'];
		

		$sql = 'INSERT INTO incomes_category_assigned_to_users (user_id, name)
                    VALUES (:user_id, :nameOfIncomeCattegory)';
		
		$db = static::getDB();
           $stmt = $db->prepare($sql);

            $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
            $stmt->bindValue(':nameOfIncomeCattegory', $_POST['nameOfIncomeCattegory'], PDO::PARAM_STR);

            return $stmt->execute();
	
	}
	
	public function AddNewPaymentMethod(){
		
		$user_id=$_SESSION['user_id'];
		

		$sql = 'INSERT INTO payment_methods_assigned_to_users (user_id, name)
                    VALUES (:user_id, :nameOfPaymentMethod)';
		
		$db = static::getDB();
           $stmt = $db->prepare($sql);

            $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
            $stmt->bindValue(':nameOfPaymentMethod', $_POST['nameOfPaymentMethod'], PDO::PARAM_STR);

            return $stmt->execute();
	
	}
	
	public function deleteIncomesCattegory(){
		
		
		$id = $_POST['id'];
		$user_id=$_SESSION['user_id'];
		
		$sql = 'DELETE FROM incomes_category_assigned_to_users
		WHERE id=:id 
		AND user_id=:user_id';
		
		
		
		$db = static::getDB();
           $stmt = $db->prepare($sql);

     
            $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
			$stmt->bindValue(':id', $id, PDO::PARAM_INT);

			return $stmt->execute();
		
	}
	
	public function editIncomesCattegory(){
		
		$name=$_POST['name'];
		$id=$_POST['id'];
		$user_id=$_SESSION['user_id'];
		
		
		$sql = 'UPDATE incomes_category_assigned_to_users
		SET name=:name
		WHERE 
		user_id=:user_id
		AND id=:id';
		
		
		$db = static::getDB();
           $stmt = $db->prepare($sql);

            $stmt->bindValue(':name', $name, PDO::PARAM_STR);
            $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
			$stmt->bindValue(':id', $id, PDO::PARAM_INT);
           
			
			return $stmt->execute();
		
	}
	
	public function deleteExpensesCattegory(){
		
		
		$id = $_POST['id'];
		$user_id=$_SESSION['user_id'];
		
		$sql = 'DELETE FROM expenses_category_assigned_to_users
		WHERE id=:id 
		AND user_id=:user_id';
		
		
		
		$db = static::getDB();
           $stmt = $db->prepare($sql);

     
            $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
			$stmt->bindValue(':id', $id, PDO::PARAM_INT);

			return $stmt->execute();
		
	}
	
	public function editExpensesCattegory(){
		
		$name=$_POST['name'];
		$id=$_POST['id'];
		$user_id=$_SESSION['user_id'];
		
		
		$sql = 'UPDATE expenses_category_assigned_to_users
		SET name=:name
		WHERE user_id=:user_id
		AND id=:id';
		
		
		$db = static::getDB();
           $stmt = $db->prepare($sql);

            $stmt->bindValue(':name', $name, PDO::PARAM_STR);
            $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
			$stmt->bindValue(':id', $id, PDO::PARAM_INT);
			
			return $stmt->execute();
		
	}

	public function deletePaymentMethods(){
		
		
		$id = $_POST['id'];
		$user_id=$_SESSION['user_id'];
		
		$sql = 'DELETE FROM payment_methods_assigned_to_users
		WHERE id=:id 
		AND user_id=:user_id';
		
		
		
		$db = static::getDB();
           $stmt = $db->prepare($sql);

     
            $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
			$stmt->bindValue(':id', $id, PDO::PARAM_INT);

			return $stmt->execute();
		
	}
	
	public function editPaymentMethod(){
		
		$name=$_POST['name'];
		$id=$_POST['id'];
		$user_id=$_SESSION['user_id'];
		
		
		$sql = 'UPDATE payment_methods_assigned_to_users
		SET name=:name
		WHERE user_id=:user_id
		AND id=:id';
		
		
		$db = static::getDB();
           $stmt = $db->prepare($sql);

            $stmt->bindValue(':name', $name, PDO::PARAM_STR);
            $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
			$stmt->bindValue(':id', $id, PDO::PARAM_INT);
			
			return $stmt->execute();
		
	}

	public function setLimitForExpenses(){
		
		$expensesLimit=$_POST['expensesLimit'];
		$id=$_POST['id'];
		$user_id=$_SESSION['user_id'];
		
		
		$sql = 'UPDATE expenses_category_assigned_to_users
		SET expensesLimit=:expensesLimit
		WHERE user_id=:user_id
		AND id=:id';
		
		
		$db = static::getDB();
           $stmt = $db->prepare($sql);

            $stmt->bindValue(':expensesLimit', $expensesLimit, PDO::PARAM_INT);
            $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
			$stmt->bindValue(':id', $id, PDO::PARAM_INT);
			
			return $stmt->execute();
		
	}

}
