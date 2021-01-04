<html>
<h1>Results Search</h1>
<head>
<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script>


  $( document ).ready(function() {


    $("#btn").click(function() {

    var selcrop = document.getElementById('main');
    var selreg = document.getElementById('sort');
    var crop = selcrop.options[selcrop.selectedIndex].value;
    var region = selreg.options[selreg.selectedIndex].value;
    var date = document.getElementById("myDate").value;
    var name = document.getElementById("name").value;
      $("#loadLogs").load("results.php",{
        main: crop,
        sort: region,
        date: date,
        name: name
      });
    });
  });


</script>

</head>
<body>
	<div>

  Test Name: <input type="Text" id="name"><br>
  Main Ingredient: <select id="main">
  	<option value='ALL' selected>ALL</option>
  	<option value='Chicken'>Chicken</option>
  	<option value='Beef'>Beef</option>
  	<option value='Pork'>Pork</option>
  	<option value='Fish'>Fish</option>
  	<option value='Vegetable'>Vegetable</option>

  </select><br>

  Sort By: <select id="sort">
    <option value='recent'>Most Recent</option>
    <option value='rated'>Top Rated</option>
  </select><br>

  Month and Year Calendar: <input type="date" id="myDate"><br>
  <input id="btn" type="button" value="Filter" onclick="loadFilter()">
	</div>
	<div id="loadLogs">
	</div>


</body>
</html>