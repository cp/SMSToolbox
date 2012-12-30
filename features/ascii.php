<?php

class ascii {

    public static function process($body) {
        switch ($body['feature']) {
            case "bunny":
                return ascii::getBunny();
            case "friends":
                return ascii::getFriends();
            case "middle":
                return ascii::getMiddle();
            case "love":
                return ascii::getLove();
            case "lol":
                return ascii::getLol();
            case "help":
                return ascii::getHelp();
            case "welcome":
                return ascii::getWelcome();
            case "superman":
                return ascii::getSuperman();
            default:
                return "Feature not found!";
                break;
        }
    }
    private static function getHelp() {
        return "bunny, friends, middle, love, lol, welcome, superman";
    }
    
    private static function getWelcome() {
        return "\n".
               "╔╦╦╦═╦╗╔═╦═╦══╦═╗\n".
               "║║║║╩╣╚╣═╣║║║║║╩╣\n".
               "╚══╩═╩═╩═╩═╩╩╩╩═╝\n";
    }
    private static function getLol() {
        return "\n".
                "╔╗╔═╦╗ \n".
                "║╚╣║║╚╗ \n".
                "╚═╩═╩═╝\n";
    }
    
    private static function getLove() {
        return "\n".
               "╔╗╔═╦╦╦═╗\n".
               "║╚╣║║║║╩╣\n".
               "╚═╩═╩═╩═╩\n";
    }
    
    private static function getSuperman() {
        return "\n".
               "╔═╗\n".
               "║═╬╦╦═╦═╦═╦══╦═╦═╗\n".
               "╠═║║║╬║╩╣╔╣║║║╬║║║\n".
               "╚═╩═╣╔╩═╩╝╚╩╩╩╩╩╩╝\n";
    }
    private static function getMiddle() {
        return "\n".
                "-------(◠ ◠ )\n".
                "--╭∩╮⌣╭∩╮\n";
    }
    
    private static function getBunny() {
        return  "\n".
                "(\___/)\n".
                "(=’.'=)\n".
                "(”)_(”)";
    }
    
    private static function getFriends() {
         return "\n".
                ".....(...)____ ____(...)......\n".
                "..../.|...................|.\.....\n".
                ".../..|...................|..\....\n".
                "...../.\................/.\.......\n".
                "..../...\............./.....\.....";
    }

}

?>