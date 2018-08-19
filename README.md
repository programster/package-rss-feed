RSS Feed Package
================

A package to make generating an RSS 2.0 feed easy and straightforward.

## Installation

```
composer require programster/rss-feed
```

## Example Usage

```php
<?php

require_once(__DIR__ . '/vendor/autoload.php');

use Programster\RssFeed;

$items = array();

$pubDate = new DateTime();
$pubDate->setTimestamp(1534698676);

$items[] = new RssFeed\RssItem(
    "Article Title", 
    "https://blog.mydomain.org/path/to/article",
    "A description of the article goes here.", 
    $pubDate, 
    "my-article-category"
);

// .. add another item, and another, and another...

$channel = new RssFeed\RssChannel(
    "My Awesome Blog", 
    "https://blog.mydomain.com", 
    "Tutorials on This and That", 
    "en", 
    new RssFeed\NullRssImage(), 
    ...$items
);

$rss = new RssFeed\RssFeed($channel);

header('Content-type: application/xml');
echo $rss;
```

## Useful Links

* [Online RSS Validator](https://validator.w3.org/feed/check.cgi)
* [RSS 2.0 specification](https://validator.w3.org/feed/docs/rss2.html)
