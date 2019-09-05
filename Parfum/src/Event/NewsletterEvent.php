<?php

namespace App\Event;

use App\Entity\NewsLetter;
use Symfony\Component\EventDispatcher\Event;


final class NewsletterEvent extends Event
{
    public const SENDER= 'user.newsletter';

    private $news;

    public function __construct(NewsLetter $news)
    {
        $this->news = $news;
    }

    public function getNews()
    {
        return $this->news;
    }
}