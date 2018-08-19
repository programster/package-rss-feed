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
        DateTime $pubDate, 
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


/**
 * rss_feed (simple rss 2.0 feed creator php class)
 *
 * @author     Christos Pontikis http://pontikis.net
 * @copyright  Christos Pontikis
 * @license    MIT http://opensource.org/licenses/MIT
 * @version    0.1.0 (28 July 2013)
 *
 */
class RssFeed  
{
    private $m_channels;
    
    
    /**
     * Create an RSS feed.
     */
    public function __construct(RssChannel ...$channels) 
    {
        // initialize
        $this->m_channels = $channels;
    }
    
    /**
     * Generate RSS 2.0 feed
     *
     * @return string RSS 2.0 xml
     */
    public function __toString() 
    {
        $xml = 
            '<?xml version="1.0" encoding="utf-8"?>' . PHP_EOL .
            '<rss version="2.0">' . PHP_EOL . 
            implode(PHP_EOL, $this->m_channels) . PHP_EOL .
            '</rss>';
        
        return $xml;
    }
}


//header('Content-type: application/xml');

$site_url = 'http://www.pontikis.net'; // configure appropriately
$site_name = 'Tech blog & web labs'; // configure appropriately


$items = array();

$pubDate = new DateTime();
$pubDate->setTimestamp(1534698676);

$items[] = new RssItem(
    "Cookies in PHP", 
    "https://blog.programster.org/cookies-in-php",
    "A tutorial on using PHP to set and read cookies in the user's browser.", 
    $pubDate, 
    "PHP"
);

$channel = new RssChannel(
    "Programster's Blog", 
    "https://blog.programster.org", 
    "Tutorials on Linux and Open Source", 
    "en", 
    new NullRssImage, 
    ...$items
);


$rss = new RssFeed($channel);
echo $rss;