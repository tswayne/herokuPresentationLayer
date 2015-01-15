<?php
$name = $_GET['name'] == null ? 'RAY' : strtoupper($_GET['name']);


if (getenv('NUMBER_API')) {
	$numberUrl='http://' . getenv("NUMBER_API");	
} else {
	$numberUrl='localhost:8081';
}


$ch = curl_init();  

$baseUrl='http://heroku-php-demo-api.herokuapp.com';

curl_setopt($ch,CURLOPT_URL,$baseUrl . '?name=' . $name);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);  
$response=curl_exec($ch);
curl_setopt($ch,CURLOPT_URL, $numberUrl);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
$numbers=json_decode(curl_exec($ch), true);
curl_close($ch);
$person = json_decode($response)->person;
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
<link href="sticky-footer.css" rel="stylesheet">
<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap-theme.min.css">

<script src="https://code.jquery.com/jquery-1.11.2.min.js"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
<title>People</title>
</head>
<body>
 <!-- Begin page content -->
    <div class="container">
      <div class="page-header">
        <h1><?php echo $person->name?>'s page</h1>
      </div>
      <dl>
	  	<dt>Age</dt>
	  	<dd><?php echo $person->age?></dd>
	  	<dt style="padding-top: 10px">Job</dt>
	  	<dd><?php echo $person->job?></dd>
	  	<dt style="padding-top: 10px">Bio</dt>
	  	<dd><?php echo $person->description?></dd>
	  	<dt style="padding-top: 10px">Lucky Numbers</dt>
	  	<dd><?php foreach($numbers as $number)
	  	echo "$number  "; 
	  	?>
	  	</dd>
	  </dl>
    </div>   
  </body>
</body>
</html>
