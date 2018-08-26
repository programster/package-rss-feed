<?php

namespace Programster\RssFeed;

class RssItem
{
    private $m_title;
    private $m_link;
    private $m_description;
    private $m_pubDate;
    private $m_category;  
    private $m_coverImageUrl;
    private $m_iconImageUrl;
    
    
    /**
     * 
     * @param string $title
     * @param string $link
     * @param string $description
     * @param \DateTime $pubDate
     * @param string $category
     * @param string $coverImageUrl - optionally provide the url for a cover image for Feedly.
     * @param string $iconImageUrl - optionally provide a url for an icon image for Feedly
     */
    public function __construct(
        string $title, 
        string $link, // url to specific post. E.g. blog.programster.org/my-post
        string $description, 
        \DateTime $pubDate, 
        string $category,
        string $coverImageUrl = "",
        string $iconImageUrl = ""
    )
    {
        $this->m_title = $title;
        $this->m_link = $link;
        $this->m_description = $description;
        $this->m_pubDate = $pubDate;
        $this->m_category = $category;
        $this->m_coverImageUrl = $coverImageUrl;
        $this->m_iconImageUrl = $iconImageUrl;
    }
    
    public function __toString()
    {
        $iconImageXml = "";
        $coverImageXml = "";
        
        if ($this->m_iconImageUrl != "")
        {
            $iconImageXml = "<webfeeds:icon>{$this->m_iconImageUrl}</webfeeds:icon>" . PHP_EOL;
        }
        
        if ($this->m_coverImageUrl != "")
        {
            $coverImageXml = '<webfeeds:cover image="' . $this->m_coverImageUrl . '" />' . PHP_EOL;
        }
        
        $xml = 
            '<item>' . PHP_EOL .
                '<title>' . $this->m_title . '</title>' . PHP_EOL .
                '<link>' . $this->m_link . '</link>' . PHP_EOL .
                '<description>' . $this->m_description . '</description>' . PHP_EOL .
                '<pubDate>' . $this->m_pubDate->format("D, d M Y H:i:s O") . '</pubDate>' . PHP_EOL .
                '<category>' . $this->m_category . '</category>' . PHP_EOL .
                $coverImageXml . 
                $iconImageXml .
            '</item>' . PHP_EOL;
        
        return $xml;
    }
}