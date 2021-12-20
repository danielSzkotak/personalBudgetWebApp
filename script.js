
function checkItem(){
   var listOfInputs = document.querySelectorAll('input[type="password"], input[type="text"], input[name="expenseDate"], .select select');
   for(var i=0; i<listOfInputs.length; i++){
      if(listOfInputs[i] && listOfInputs[i].value) {
         if (listOfInputs[i].value.length < 5) listOfInputs[i].style.border ="2px solid red";
         else listOfInputs[i].style.border ="2px solid #86af54";
      }
      else listOfInputs[i].style.border = "1px solid #b3b3b3";
   }

   if(document.getElementById("expenseAmount1") && document.getElementById("expenseAmount1").value) {
      listOfInputs[i].style.border ="2px solid #86af54";
   }
   else listOfInputs[i].style.border = "1px solid #b3b3b3";

}

function enforceNumberValidation(ele) {
   if ($(ele).data('decimal') != null) {
       // found valid rule for decimal
       var decimal = parseInt($(ele).data('decimal')) || 0;
      console.log('decimal');
       var val = $(ele).val();
       if (decimal > 0) {
           var splitVal = val.split('.');
           if (splitVal.length == 2 && splitVal[1].length > decimal) {
               // user entered invalid input
               $(ele).val(splitVal[0] + '.' + splitVal[1].substr(0, decimal));
           }
       } else if (decimal == 0) {
           // do not allow decimal place
           var splitVal = val.split('.');
           if (splitVal.length > 1) {
               // user entered invalid input
               $(ele).val(splitVal[0]); // always trim everything after '.'
           }
       }
   }

   if(ele && ele.value) ele.style.border ="2px solid #86af54";
   else ele.style.border = "1px solid #b3b3b3";
}

function validateEmail(input) {

   var validRegex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;

      if (input.value.match(validRegex)) {
         input.style.border = "2px solid #86af54";
         return true;
      } else {
         if (input.value == "") input.style.border = "1px solid #b3b3b3";
         else input.style.border = "2px solid red";   
         return false
      }
}


function addExpense(){

   var listOfInputs = document.querySelectorAll('input[type="number"], input[name="expenseDate"], .select select');
   var expenceConfirmation = document.getElementById("addExpenseParagraph");
   var inputConfirmationFlag = false;

   for(var i=0; i<listOfInputs.length; i++){
      if ((listOfInputs[i] && listOfInputs[i].value)){ 
         listOfInputs[i].style.border ="2px solid #86af54";
      }
      else {
         inputConfirmationFlag = true;
         listOfInputs[i].style.border ="2px solid red";
         expenceConfirmation.innerHTML = "Uzupełnij czerwone pola";
         expenceConfirmation.style.color = "red";
         expenceConfirmation.style.display = "grid";
      }
   }
   if(inputConfirmationFlag == false){
      expenceConfirmation.innerHTML = "Dodano wydatek";
      expenceConfirmation.style.color = "#86af54";
      expenceConfirmation.style.display = "grid";
   }
}

function validateForm(){
   var listOfInputs = document.querySelectorAll('input[type="text"], input[type="email"], input[type="password"]');
   var inputConfirmationFlag = false;

   for(var i=0; i<listOfInputs.length; i++){
      if ((listOfInputs[i] && listOfInputs[i].value)){ 
         if (listOfInputs[i].value.length < 5) listOfInputs[i].style.border ="2px solid red";
         else listOfInputs[i].style.border ="2px solid #86af54";
      }
      else {   
         inputConfirmationFlag = true;   
         listOfInputs[i].style.border ="2px solid red";
         
      }
   }
   if(inputConfirmationFlag == false && validateEmail()==true){
      document.getElementByClass("theForm").submit();
   } else return false;
}

function clearInputs(){
   let listOfInputs = document.querySelectorAll('input[type="number"], input[name="expenseDate"], .select select');
   var expenceConfirmation = document.getElementById("addExpenseParagraph");
   for(var i=0; i<listOfInputs.length; i++){
      listOfInputs[i].value = "";
      listOfInputs[i].style.border ="1px solid #b3b3b3";
   }
   expenceConfirmation.style.display ="none"; 
}

function loadCurrentDate(){
   var currentDate = new Date();
   var today = currentDate.getFullYear() + '-' + (currentDate.getMonth() + 1) + '-' + currentDate.getDate();
   document.getElementById('expenseDate1').value = today;
}

function showDateInputs(){
   const myValue = document.getElementById("payment").value;
  
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

function checkDates(){
   const startDate = document.getElementById("startDate1");
   const endDate = document.getElementById("endDate1");
   const myValue = document.getElementById("payment").value;
   const selectedPeriodHeader ="wskazany okres";
   const currentDate = new Date();
   const today = currentDate.getFullYear() + '-' + (currentDate.getMonth() + 1) + '-' + currentDate.getDate();
   var standardPeriodInputFlag = false;
  
   
   if (myValue != "non-standardPeriod") {
      standardPeriodInputFlag = true;
      document.getElementById("incomesParagraph").innerHTML = "Przychody za " + myValue;
      document.getElementById("expensesParagraph").innerHTML = "Wydatki za " + myValue;
      document.getElementById("bilansParagraph").innerHTML = "Bilans za " + myValue;
      document.getElementById("incomesChart").innerHTML = "Wykres przychodów za " + myValue;
      document.getElementById("expensesChart").innerHTML = "Wykres wydatków za " + myValue;
   }
   else {
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
      } else if (startDate.value == endDate.value) {
            startDate.style.border = "2px solid red";
            endDate.style.border = "2px solid red";
            document.getElementById("wrongDates").innerHTML = "Daty nie mogą być takie same"; 
      } else {
         document.getElementById("incomesParagraph").innerHTML = "Przychody od " + startDate.value + " do " + endDate.value;
         document.getElementById("expensesParagraph").innerHTML = "Wydatki od " + startDate.value + " do " + endDate.value;
         document.getElementById("bilansParagraph").innerHTML = "Bilans od " + startDate.value + " do " + endDate.value;
         document.getElementById("incomesChart").innerHTML = "Wykres przychodów od " + startDate.value + " do " + endDate.value;
         document.getElementById("expensesChart").innerHTML = "Wykres wydatków od " + startDate.value + " do " + endDate.value;
         standardPeriodInputFlag = true;
      }
   }
   if(standardPeriodInputFlag == true){
     startDate.style.border = "2px solid #8db856";
     endDate.style.border = "2px solid #8db856";
     document.getElementById("wrongDates").style.display = "none";
     document.getElementById("showBalanceContainer").style.display = "grid";
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