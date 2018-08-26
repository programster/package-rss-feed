<?php

namespace Programster\RssFeed;

class RssFeed  
{
    private $m_channels;
    
    
    public function __construct(RssChannel ...$channels) 
    {
        // initialize
        $this->m_channels = $channels;
    }
    
    
    public function __toString() 
    {
        $xml = 
            '<?xml version="1.0" encoding="utf-8"?>' . PHP_EOL .
            '<rss xmlns:webfeeds="http://webfeeds.org/rss/1.0" version="2.0">' . PHP_EOL . 
            implode(PHP_EOL, $this->m_channels) . PHP_EOL .
            '</rss>';
        
        return $xml;
    }
}