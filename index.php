
<!DOCTYPE html>
<html>
<head>
<style>
            body{
                font-family: "Lucida Console", "Courier New", monospace;
                font-size: 0.8em;
                color:black;
                background-color: #E6E6FA !important;
            }
            .c{
                border:gray 1px solid;
                border-radius:2px;
                padding:10px ;
                width:600px;
                margin:auto;
            }
         
            .b
            {
color:blue;
font-size :1em;

margin:10px 0px;
            }
            
            .t{
                line-height: 20px;
                color:green;
            }
        </style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<link rel="stylesheet" href="assets/css/bootstrap.min.css">
</head>
<body>

<p id="demo"></p>
<button class="btn btn-primary " onclick="getLocation()">Try It</button>
<script>
    var x = document.getElementById("demo");
function getLocation() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(successFunction);
  } else { 
    x.innerHTML = "Geolocation is not supported by this browser.";
  }
}

function successFunction(position) {
  var lat = position.coords.latitude;
  var long = position.coords.longitude;
  console.log(lat);
  var latlong = {"lat" : lat , "long" : long};
  var latlong_encoded = JSON.stringify(latlong);
  x.innerHTML = "Latitude: " + position.coords.latitude + 
  "<br>Longitude: " + position.coords.longitude;
  var jsonData;
  $.ajax({
   url: 'weather.php',
   type: 'POST',
 dataType:'text',
   data: { 
     lat: lat,
 long: long},
 cache: false,

 success: function(data) {
    console.log("yes");
  console.log(data);
  c=JSON.parse(data);
  console.log(c);
  console.log(c.data.list[0].weather[0].icon);
 var u = document.getElementById("city_name");
 u.innerHTML=c.data.city.name;
 var r=document.getElementById("max_temp");
 r.innerHTML=c.data.list[0].main.temp_max;
 var v=document.getElementById("min_temp");
 v.innerHTML=c.data.list[0].main.temp_min;
 var o=document.getElementById("pressure");
 o.innerHTML=c.data.list[0].main.pressure;  
 var p=document.getElementById("humidity");
 p.innerHTML=c.data.list[0].main.humidity;
 var m=document.getElementById("sea_level");
 m.innerHTML=c.data.list[0].main.sea_level;
 },
 error: function (error) {
    alert('error; ' + eval(error));
}
 });
   
};



function errorFunction(position) {
  alert('Error!');
}
</script>
<div class="c">
<h2 id="city_name">CITY_NAME: </h2><!--print the name of city have the user location -->
<div class="b">
<h4 id="max_temp">MAX_TEMP: </h4>  <!--print max tempreture-->
<h4 id="min_temp"> MIN_TEMP: </h4> <!--print min tempreture--></div>
<div class="t">
<div><h4 id="pressure">PRESSURE:</h4></div> <!--print pressure-->
        <div><h4 id="humidity">HUMIDITY:</h4></div> <!--print humidity-->
        <div><h4 id="sea_level">SEA_LEVEL:</h4></div> <!--print sea_level--></div></div>
</body>
</html>