<?php
$name = $_GET['name'] == null ? 'RAY' : strtoupper($_GET['name']);
$ch = curl_init();  
 
if (getenv('PERSON_API')) {
	$baseUrl='http://' . getenv("PERSON_API");
} else {
	$baseUrl='localhost:8080';
}

curl_setopt($ch,CURLOPT_URL,'http://localhost:8080?name=' . $name);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);  
$response=curl_exec($ch); 
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
	  	<dt>Job</dt>
	  	<dd><?php echo $person->job?></dd>
	  	<dt>Bio</dt>
	  	<dd><?php echo $person->description?></dd>
	  </dl>
    </div>   
  </body>
</body>
</html>
