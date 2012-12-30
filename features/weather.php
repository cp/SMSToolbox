<?php

class weather {


	public static function process($body) {
        switch($body['feature']) {
            case "condition":
                return weather::condition($body['command']);
				break;
			case "temperature":
                return weather::temperature($body['command']);
				break;
            default:
                return "Feature not found!";
                break;
        }
    }

    //Gets weather condition
    public static function condition($command) {
		switch($command) {
			case 'current':
				  $FromCity = $_REQUEST['FromCity'];
				  $FromState = $_REQUEST['FromState'];
				  $FromZip = $_REQUEST['FromZip'];
				  
				  $json_string = file_get_contents("http://api.wunderground.com/api/3ec99dbc9c7f8d6a/geolookup/conditions/q/{$FromState}/{$FromCity}.json");
				  $parsed_json = json_decode($json_string);
				  $location = $parsed_json->{'location'}->{'city'};
				  $weather = $parsed_json->{'current_observation'}->{'weather'};
				  $text =  "Current condition in {$FromCity} is: {$weather}";
				  return $text;
				break;
			default:
				return "Please select a time";
				break;
		}
    }
    //Gets weather condition
    public static function temperature($command) {
		switch($command) {
			case 'current':
				  $FromCity = $_REQUEST['FromCity'];
				  $FromState = $_REQUEST['FromState'];
				  $FromZip = $_REQUEST['FromZip'];
				  
				  $json_string = file_get_contents("http://api.wunderground.com/api/3ec99dbc9c7f8d6a/geolookup/conditions/q/{$FromState}/{$FromCity}.json");
				  $parsed_json = json_decode($json_string);
				  $location = $parsed_json->{'location'}->{'city'};
				  $temp_f = $parsed_json->{'current_observation'}->{'temp_f'};
				  $text =  "Current condition in {$FromCity} is: {$temp_f}";
				  return $text;
				break;
			default:
				return "Please select a time";
				break;
		}
    }
	

}
?>