<?php

namespace Programster\RssFeed;

class RssImage
{
    private $m_title;
    private $m_imageLink;
    private $m_imageUrl;
    
    
    public function __construct(string $title, string $imageLink, string $imageUrl)
    {
        $this->m_title = $title;
        $this->m_imageLink = $imageLink;
        $this->m_imageUrl = $imageUrl;
    }
    
    public function __toString()
    {
        $xml = 
            '<image>' . PHP_EOL .
            '<title>' . $this->m_title . '</title>' . PHP_EOL .
            '<link>' . $this->m_imageLink . '</link>' . PHP_EOL .
            '<url>' . $this->m_imageUrl . '</url>' . PHP_EOL .
            '</image>' . PHP_EOL;
            
        return $xml;
    }
}