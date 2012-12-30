<?php

class weather {


	public static function process($body) {
        switch($body) {
            case "condition":
                return weather::condition($body['command']);
				break;
            default:
                echo "Feature not found!";
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
				  
				  $json_string = file_get_contents("http://api.wunderground.com/api/3b6f07179e6e0f97/geolookup/conditions/q/{$FromState}/{$FromCity}.json");
				  $parsed_json = json_decode($json_string);
				  $location = $parsed_json->{'location'}->{'city'};
				  $temp_f = $parsed_json->{'current_observation'}->{'temp_f'};
				  $text =  "Current temperature in {$FromCity} is: {$temp_f}";
				  return $text;
				break;
			default:
				echo "Please select a time";
				break;
		}
    }
	

}
?>