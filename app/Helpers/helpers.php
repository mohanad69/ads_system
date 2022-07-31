<?php

use Jenssegers\Agent\Agent;

    function detectDevice()
    {
        $user_agent = $_SERVER["HTTP_USER_AGENT"];

        if(preg_match("/(android|webos|avantgo|iphone|ipod|ipad|bolt|boost|cricket|docomo|fone|hiptop|opera mini|mini|kitkat|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i",$user_agent ))
        {
            return 'mobile';
        }
        else{
            return 'desktop';
        }
    }

    function deviceDetection(){
        $agent = new Agent;

        $mobileResult = $agent->isMobile();
        if ($mobileResult) {
        $result = 'Mobile Device';
        }

        $desktopResult= $agent->isDesktop();
        if ($desktopResult) {
        $result = 'Desktop Device';
        }

        $tabletResult= $agent->isTablet();
        if ($tabletResult) {
        $result = 'Desktop Device "Tablet"';
        }

        $tabletResult= $agent->isPhone();
        if ($tabletResult) {
        $result = 'Phone Device';
        }

        return $result;
    }
