<?php


$googleApiUrl = "http://api.openweathermap.org/data/2.5/weather?q=Araçatuba,br&appid=ebbd6d48a3fdb07805cd34c995077c57&units=metric";

$ch = curl_init();

curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_URL, $googleApiUrl);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_VERBOSE, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

$response = curl_exec($ch);

curl_close($ch);
$data = json_decode($response);

// echo "<pre>";
// print_r($data);
// die;


$currentTime = time();
?>

<html>
<head>

<link rel="shortcut icon" href="../html/img/logocom.png" type="imag/x-icon" >
    <title>🪁Clima🪁</title>
<style>
    body{
        font-family: Arial;
        font-size:1em;
        
    }
    .report-container{
        border: #E0E0E0 1px solid;
        padding: 20px 40px 40px 40px;
        border-radius: 2px;
        width: 550px;
        margin: 0 auto;
    }
    .weather-icon{
        vertical-align : middle;
        margin-right:20px;
        
    }

    .weather-forecast{
        color: #923922;
        font-size:1.2em;
        font-weight: bold;
        margin: 20px 0px;
    }

    span.min-temperature{
        margin-left: 15px;
        color: #929292;
    }
    .time{
        line-height: 25px;
    }
    button{
    width: 100%;
    padding: 15px 20px 25px 25;
    border: none
    font-weight: bold;
    font-size: 1.1em;
    cursor: pointer;
    transition: 0.3s ease;
    margin-bottom: 10px;
    }
    </style>

</head>
<body> 
    <div class="report-container">
        <h2><?php echo $data->name; ?> 🪁Clima para passear🚨</h2>
        <div class="time">
            <div><?php echo date("l g: i a", $currentTime); ?></div>
            <div><?php echo date("jS F, Y", $currentTime); ?></div>
            <div><?php echo ucwords($data->weather[0]->description); ?></div>
</div>
    <div class="weather-forecast">
        <img
            src="http://openweathermap.org/img/w/<?php echo $data->weather[0]->icon; ?>.png"
            class="weather-icon/"><?php echo $data->main->temp_max;?>&deg;C<span></span>
</div>
<div class ="time">
    <div>Umidade: <?php echo $data->main->humidity; ?>%</div>
    <div>Vento: <?php echo $data->wind->speed; ?>km/h</div>
</div>
</div>

<button><a href="src/menu.php">Voltar</button></a>
</body>
</html>