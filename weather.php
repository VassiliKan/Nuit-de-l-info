<?php

require_once(__DIR__."/inc/meteo.inc.php");

$weather = new Weather("Bordeau");
print_r($weather);


$lien = 'https://api.stormglass.io/v2/weather/point?lat=44.833&lon=-0.567&params=waterTemperature';


$ch = curl_init();


curl_setopt($ch, CURLOPT_URL, $lien);



curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Authorization: d53acdfc-35cb-11eb-a5a9-0242ac130002-d53acece-35cb-11eb-a5a9-0242ac130002'
));


$return = curl_exec($ch);

curl_close($ch);
print_r($return);

/*echo "Température : ".$weather->weather->current->temperature."°<img src=\"".$weather->weather->current->weather_icons[0]."\"><br>";
echo "Pression : ".$weather->weather->current->pressure."<br>";
echo "Taux humidité : ".$weather->weather->current->humidity."¨%<br>";
if($weather->weather->current->cloudcover == 1){
   echo  "Nuageux : Oui<br>";
}
else {
    echo "Nuageux : Non<br>";

}*/
?>

<!DOCTYPE html>
<html>
  <head>
    <style>
        

        .page{
            border-radius:8px;
            width: 50%;

            background: linear-gradient(-300deg,#546EB9, #53CEAD);
            padding-top:2%
        }  
        .sky{
            
            border-radius:8px;
            width: 96%;
            margin-left:2%;
            text-align: center;
            
            background: rgba(72,167,214,0.5);
            color:white;
            font-family: sans-serif
        }
        .sky hr {
            width: 80%;
            color:white;
            
            
        }
        .sky div {
            text-align: left;
            margin-left: 20px
        }
                
        .sky img {
            float:right;
            position:relative;
            margin-right: 30px;
            border-radius:25px;
        }
        .wind{
            
            border-radius:8px;
            width: 96%;
            margin-left:2%;
            text-align: center;
            background: rgba(72,167,214,0.5);
            color:white;
            font-family: sans-serif
        }
        .wind hr {
            width: 80%;
            color:white;
            
            
        }
        .wind div {
            text-align: left;
            margin-left: 20px
        }
                

        
        

            
        h2
    </style>
    <title>Météo</title>
  </head>
  <body>
      <div class="page">    
          <div class="sky"> 
              <br>
              <p><h2>Météo locale</h2></p>
                
              <hr>
               <div><br>
                   <span>Temperature :  <?php echo $weather->weather->current->temperature."°"?><img src="<?php echo $weather->weather->current->weather_icons[0]?>"></span><br><br>
                   <span>Pression :  <?php echo $weather->weather->current->pressure."hPa"?></span><br><br>
                   <span> Humidité : <?php echo $weather->weather->current->humidity."%"?> </span><br><br>
            
                   
            
               </div>
          </div> <br>
      
                <div class="wind"> 
              <br>
              <p><h2>Informations sur le vent</h2></p>
                
              <hr>
               <div>
                   <span>Vitesse :  <?php echo $weather->weather->current->temperature."km/h"?></span><br><br>
                   <span>Degré :  <?php echo $weather->weather->current->wind_degree."°"?></span><br><br>
                   <span> Direction : <?php echo $weather->weather->current->wind_dir.""?>
                   </span><br><br>
                   
            
               </div>
          </div> 
         <div class="wave"> 
              <br>
              <p><h2>Informations sur l'eau</h2></p>
                
              <hr>
               <div>
                   <span>Vitesse :  <?php echo $weather->weather->current->temperature."km/h"?></span><br><br>
                   <span>Degré :  <?php echo $weather->weather->current->wind_degree."°"?></span><br><br>
                   <span> Direction : <?php echo $weather->weather->current->wind_dir.""?>
                   </span><br><br>
                   
            
               </div>
          </div> 
      </div>
  </body>
</html>





<?php

?>