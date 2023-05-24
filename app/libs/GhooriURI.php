<?php

class GhooriURI {
    public static function shopurl($subdomain, $url) {
        switch (App::environment()):
            case "local":
                return $url;
            break;
            case "production":
                return 'https://'.$subdomain.'.ghoori.com.bd';
                break;
            default:
                return $url;
                break;

        endswitch;
    }

    public static function producturl($subdomain, $url, $id) {
        switch (App::environment()):
            case "local":
                return $url;
            break;
            case "production":
                return 'https://'.$subdomain.'.ghoori.com.bd/products/'.$id;
                break;
            default:
                return $url;
                break;

        endswitch;
    }
}