//Bootstrap validation
(function () {
   'use strict'
   // Fetch all the forms we want to apply custom Bootstrap validation styles to
   var forms = document.querySelectorAll('.needs-validation')
 
   // Loop over them and prevent submission
   Array.prototype.slice.call(forms)
     .forEach(function (form) {
       form.addEventListener('submit', function (event) {
         if (!form.checkValidity()) {
           
           event.preventDefault()
           event.stopPropagation()   
         }
         form.classList.add('was-validated')
       }, false)
     })
 })()


 function loadCurrentDate(){
  var today = new Date();
  var dd = ("0" + (today.getDate())).slice(-2);
  var mm = ("0" + (today.getMonth() +　1)).slice(-2);
  var yyyy = today.getFullYear();
   today = yyyy + '-' + mm + '-' + dd ;
   return today;
}

function showTodayIncomeDate(){
  document.getElementById('inputDateIncome').value = loadCurrentDate();
}

function showTodayExpenseDate(){
  document.getElementById('inputDateExpense').value = loadCurrentDate();
}

function clearInputs(){
  let listOfInputs = document.querySelectorAll('input[type="number"], input[type="date"], .select select');
  for(var i=0; i<listOfInputs.length; i++){
     listOfInputs[i].value = "";
  }
}

function showDateInputs(){
  const myValue = document.getElementById("selectedBalancePeriod").value;

  if(myValue == "non-standardPeriod"){
      document.getElementById("selectPeriodId").style.display = "grid";
      document.getElementById("startDate1").style.border = "1px solid #b3b3b3";
      document.getElementById("endDate1").style.border = "1px solid #b3b3b3";
  } else {
     if(document.getElementById("selectPeriodId").style.display == "grid"){
        document.getElementById("selectPeriodId").style.display = "none";
     }
  }
}

function showBalance(){

  var myValue = document.getElementById("selectedBalancePeriod").value;
  var wrongDates = document.getElementById("wrongDates");
  var standardPeriodInputFlag = false;

  if (myValue != "non-standardPeriod") {
     standardPeriodInputFlag = true;
     document.getElementById("selectedPeriodParagraph").innerHTML = "Bilans za " + myValue;
  }
  else {
    var startDate = document.getElementById("startDate1");
    var endDate = document.getElementById("endDate1");
    wrongDates.style.display = "grid";  
      if(startDate.value == "" && endDate.value == ""){
        document.getElementById("wrongDates").innerHTML = "Pola z datmi nie mogą być puste";
        startDate.style.border = "2px solid red";
        endDate.style.border = "2px solid red";
    } else if (startDate.value == "") {
        document.getElementById("wrongDates").innerHTML = "Pole z pierwszą datą nie może być puste";
        startDate.style.border = "2px solid red";
        endDate.style.border = "2px solid #8db856";
    } else if (endDate.value == "") {
        document.getElementById("wrongDates").innerHTML = "Pole z drugą datą nie może być puste";
        startDate.style.border = "2px solid #8db856";
        endDate.style.border = "2px solid red";
    } else if((startDate.value > endDate.value) && (startDate.value != "" || endDate.value != "")) {
        startDate.style.border = "2px solid red";
        document.getElementById("wrongDates").innerHTML = "Pierwsza data nie może być większa od drugiej";    
    } else {      

      standardPeriodInputFlag = true;
       const reversedStartDate = (startDate.value).split("-").reverse().join("-");
       const reversedEndDate = (endDate.value).split("-").reverse().join("-");
       startDate.style.border = "2px solid #8db856";
       endDate.style.border = "2px solid #8db856";
       document.getElementById("selectedPeriodParagraph").innerHTML = "Bilans od " + reversedStartDate + " do " + reversedEndDate;
    }
  }
 
  if(standardPeriodInputFlag == true){
    wrongDates.style.display = "none";
    document.getElementById("showBalanceContainer").style.display = "grid";
   // document.getElementById("chart_wrap").style.display = "grid";
  }
}


function limitDateInput(){
  var today = new Date();
  var dd = today.getDate();
  var mm = today.getMonth() + 1; //January is 0!
  var yyyy = today.getFullYear();

  if (dd < 10) {
     dd = '0' + dd;
  } if (mm < 10) {
     mm = '0' + mm;
  } 
     
  today = yyyy + '-' + mm + '-' + dd;
  var dateFields = document.querySelectorAll('input[type="date"]');
  for(var i=0; i < dateFields.length; i++){
     dateFields[i].setAttribute("max", today);
  }
}

