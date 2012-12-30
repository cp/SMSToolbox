<?php

class instagram {


	public static function process($body) {
        switch($body['feature']) {
            case "hashtag":
                return instagram::hashtag($body['command']);
				break;
            default:
                return "Feature not found!";
                break;
        }
    }

    //Gets weather condition
    public static function hashtag($command) {
				  $json_string = file_get_contents("https://api.instagram.com/v1/tags/{$command}/media/recent?client_id=b7408e17a14c479397b951738dafc963");
				  $parsed_json = json_decode($json_string);
				  $url = $parsed_json->{'standard_resolution'}->{'url'};
				  $text =  "Here's an Instagram photo tagged {$command} - {$url}.";
				  return $text;
				break;
		}
    }

	

}
?>