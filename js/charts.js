 // Load google charts
 google.charts.load('current', {'packages':['corechart']});
 google.charts.setOnLoadCallback(drawChart);
 
 // Draw the chart and set the chart values
 function drawChart() {
   var data1 = google.visualization.arrayToDataTable([
   ['Wydatki', 'suma'],
   ['Mieszkanie', 500],
   ['Jedzenie', 300],
   ['Opieka zdrowotna', 250],
   ['Ubranie', 150],
   ['Książki', 50],
   ['Inne wydatki', 10],
   ['Rozrywka', 1]
 ]);
 var data2 = google.visualization.arrayToDataTable([
   ['Przychody', 'suma'],
   ['Wynagrodzenie', 500],
   ['Odsetki bankowe', 50],
   ['Sprzedaż na allegro', 200],
   ['Inne', 300],
 ]);
 
   // Optional; add a title and set the width and height of the chart
   var options1 = {width: '500', height: '500', backgroundColor: 'transparent',
   title: 'Wydatki'
  };

  var options2 = {width: '500', height: '500', backgroundColor: 'transparent',
  title: 'Przychody'
 };
 
   // Display the chart inside the <div> element with id="piechart"
   var chart1 = new google.visualization.PieChart(document.getElementById('piechart1'));
   var chart2 = new google.visualization.PieChart(document.getElementById('piechart2'));
   chart1.draw(data1, options1);
   chart2.draw(data2, options2);
 }