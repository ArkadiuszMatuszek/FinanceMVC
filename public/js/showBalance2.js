function ShowIncomeMenager() {
  var text = document.getElementById("demo1");
  var IncomesMenager = document.getElementById("IncomesMenager");
  var BackToMainMenu = document.getElementById("BackToMainMenu");
  var ExpensesMenager = document.getElementById("ExpensesMenager");
  var PaymentMenager = document.getElementById("PaymentMenager");

  if (text.style.display === "none") {
    text.style.display = "block";
    IncomesMenager.style.display = "none";
    BackToMainMenu.style.visibility = "visible";
    ExpensesMenager.style.display ="none";
    PaymentMenager.style.display ="none";
  } else {
    text.style.display = "none";
  }
}



function ShowExpenseMenager() {
  var text = document.getElementById("demo2");
  var ExpensesMenager = document.getElementById("ExpensesMenager");
  var BackToMainMenu = document.getElementById("BackToMainMenu");
  var IncomesMenager = document.getElementById("IncomesMenager");
  var PaymentMenager = document.getElementById("PaymentMenager");


  if (text.style.display === "none") {
    text.style.display = "block";
    ExpensesMenager.style.display = "none";
    BackToMainMenu.style.visibility = "visible";
    IncomesMenager.style.display ="none";
    PaymentMenager.style.display ="none";

  } else {
    text.style.display = "none";
  }
}



function ShowPaymentMenager() {
  var text = document.getElementById("demo3");
  var ExpensesMenager = document.getElementById("ExpensesMenager");
  var BackToMainMenu = document.getElementById("BackToMainMenu");
  var IncomesMenager = document.getElementById("IncomesMenager");
  var PaymentMenager = document.getElementById("PaymentMenager");

  if (text.style.display === "none") {
    text.style.display = "block";
    PaymentMenager.style.display = "none";
    BackToMainMenu.style.visibility = "visible";
    IncomesMenager.style.display ="none";
    ExpensesMenager.style.display = "none";

  } else {
    text.style.display = "none";
  }
}

function BackToMainMenu() {
  
  var text1 = document.getElementById("demo1");
  var text2 = document.getElementById("demo2");
  var text3 = document.getElementById("demo3");
  var ExpensesMenager = document.getElementById("ExpensesMenager");
  var IncomesMenager = document.getElementById("IncomesMenager");
  var PaymentMenager = document.getElementById("PaymentMenager");

  



  if (text1.style.display === "block" || text2.style.display === "block" || text3.style.display === "block") {
    
    
    text1.style.display = "none";
    text2.style.display = "none";
    text3.style.display = "none";
    IncomesMenager.style.display = "block";
    ExpensesMenager.style.display = "block";
    PaymentMenager.style.display = "block";
  } else {
    text1.style.display = "block";
    
  }

}

