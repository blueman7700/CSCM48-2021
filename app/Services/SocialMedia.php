<?php

namespace App\Services;

class SocialMedia 
{
    private $apiKey;

    public function __construct($apiKey)
    {
        $this->apiKey = $apiKey;
    }

    public function genShareButtons($title, $text, $id)
    {
        $shareComponent = \Share::page(
            'localhost/post/'.$id,
            nl2br($title.' , '.$text),
        )
        ->facebook()
        ->twitter()
        ->linkedin()
        ->telegram()
        ->whatsapp()        
        ->reddit();
        
        return $shareComponent;
    }

}