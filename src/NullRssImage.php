<?php

namespace Programster\RssFeed;

class NullRssImage extends RssImage
{
    private $m_title;
    private $m_imageLink;
    private $m_imageUrl;
    
    
    public function __construct()
    {
    }
    
    public function __toString()
    {
        return "";
    }
}