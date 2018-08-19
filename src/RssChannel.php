<?php

namespace Programster\RssFeed;

class RssChannel
{
    private $m_title;
    private $m_link;
    private $m_description;
    private $m_language;
    private $m_image;
    private $m_items;
    
    
    public function __construct(
        string $title, 
        string $link, 
        string $description, 
        string $language, 
        RssImage $image, 
        RssItem ...$items
    )
    {
        $this->m_title = $title;
        $this->m_link = $link;
        $this->m_description = $description;
        $this->m_language = $language;
        $this->m_image = $image;
        $this->m_items = $items;
    }
    
    
    public function __toString()
    {
        $xml = 
            '<channel>' . PHP_EOL . 
                '<title>' . $this->m_title . '</title>' . PHP_EOL .
                '<link>' . $this->m_link . '</link>' . PHP_EOL .
                '<description>' . $this->m_description . '</description>' . PHP_EOL .
                '<language>' . $this->m_language . '</language>' . PHP_EOL . 
                $this->m_image . PHP_EOL . 
                implode(PHP_EOL, $this->m_items) . PHP_EOL . 
            '</channel>';
            
        return $xml;
    }
}