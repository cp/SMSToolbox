<?php

class Weather {

    public static function process($feature, $command) {
        switch($feature) {
            case "weather":
                return Weather::getAvgPrice($command);
            default:
                echo "Feature not found!";
                break;
        }
    }
    public static function getCurrentTemp($keywords) {
    
	    $FromCity=$_REQUEST['FromCity'];
        $FromState=$_REQUEST['FromState'];
        $FromZip=$_REQUEST['FromZip'];
    
	  $json_string = file_get_contents("http://api.wunderground.com/api/3ec99dbc9c7f8d6a/geolookup/conditions/q/IA/Cedar_Rapids.json");
	  $parsed_json = json_decode($json_string);
	  $location = $parsed_json->{'location'}->{'city'};
	  $temp_f = $parsed_json->{'current_observation'}->{'temp_f'};
	  return "Current temperature in Portland is: {$FromCity}";
    }
    
?>