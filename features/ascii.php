<?php

class ascii {

    public static function process($body) {
        switch ($body['feature']) {
            case "bunny":
                return ascii::getBunny();
            case "friends":
                return ascii::getFriends();
            default:
                return "Feature not found!";
                break;
        }
    }
    
    private static function getBunny() {
        return  "(\___/)\n".
                "(=’.'=)\n".
                "(”)_(”)";
    }
    
    private static function getFriends() {
         return  ".....(...)____ ____(...)......\n".
                "..../.|...................|.\.....\n".
                ".../..|...................|..\....\n".
                "...../.\................/.\.......\n".
                "..../...\............./.....\.....";
    }

}

?>