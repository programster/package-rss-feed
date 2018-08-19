<?php

namespace Programster\RssFeed;

class RssItem
{
    private $m_title;
    private $m_link;
    private $m_description;
    private $m_pubDate;
    private $m_category;    
    
    public function __construct(
        string $title, 
        string $link, // url to specific post. E.g. blog.programster.org/my-post
        string $description, 
        \DateTime $pubDate, 
        string $category,
        string $content
    )
    {
        $this->m_title = $title;
        $this->m_link = $link;
        $this->m_description = $description;
        $this->m_pubDate = $pubDate;
        $this->m_category = $category;
        $this->m_content = $content;
    }
    
    public function __toString()
    {
        $xml = 
            '<item>' . PHP_EOL .
                '<title>' . $this->m_title . '</title>' . PHP_EOL .
                '<link>' . $this->m_link . '</link>' . PHP_EOL .
                '<description>' . $this->m_description . '</description>' . PHP_EOL .
                '<pubDate>' . $this->m_pubDate->format("D, d M Y H:i:s O") . '</pubDate>' . PHP_EOL .
                '<category>' . $this->m_category . '</category>' . PHP_EOL .
            '</item>' . PHP_EOL;
        
        return $xml;
    }
}