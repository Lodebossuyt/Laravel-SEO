<?php

namespace Lodeb\SEO\Services;

use Illuminate\Support\Collection;

class SEO {
    protected $title;
    protected $description;
    protected $keywords = [];
    protected $author;
    protected $robots;
    protected $setCanonicalUrl;
    protected $setOgTags;
    protected $setTwitterCards;
    protected $image;

    public function __construct() {
        $this->title = config('seo.default_title', 'Default Title');
        $this->description = config('seo.default_description', 'Default Description');
        $this->keywords = config('seo.default_keywords', []);
        $this->author = config('seo.default_author', 'Default Author');
        $this->robots = config('seo.default_robots', 'index, follow');
        $this->setCanonicalUrl = config('seo.set_canonical_url', true);
        $this->setOgTags = config('seo.set_og_tags', true);
        $this->setTwitterCards = config('seo.set_twitter_cards', true);
    }

    public function generate()
    {
        $html = [];
        $title = $this->title;
        $description = $this->description;
        $keywords = $this->keywords;
        $author = $this->author;
        $robots = $this->robots;

        if ($title) {
            $html[] = "<title>{$title}</title>";
        }
        if ($description) {
            $html[] = "<meta name='description' content='{$description}'>";
        }
        if (! empty($keywords)) {
            if ($keywords instanceof Collection) {
                $keywords = $keywords->toArray();
            }

            $keywords = implode(', ', $keywords);
            $html[] = "<meta name=\"keywords\" content=\"{$keywords}\">";
        }

        if ($author) {
            $html[] = "<meta name='author' content='{$author}'>";
        }

        if ($robots) {
            $html[] = "<meta name='robots' content='{$robots}'>";
        }

        if ($this->setCanonicalUrl) {
            $currentUrl = url()->current();
            $html[] = "<link rel='canonical' href='{$currentUrl}'>";
        }

        if ($this->setOgTags) {
            $html[] = "<meta property='og:title' content='{$title}'>";
            $html[] = "<meta property='og:description' content='{$description}'>";
            $html[] = "<meta property='og:url' content='" . url()->current() . "'>";
            if ($this->image) {
                $html[] = "<meta property='og:image' content='{$this->image}'>";
            }
        }

        if ($this->setTwitterCards) {
            $html[] = "<meta name='twitter:card' content='summary_large_image'>";
            $html[] = "<meta name='twitter:title' content='{$title}'>";
            $html[] = "<meta name='twitter:description' content='{$description}'>";
            if ($this->image) {
                $html[] = "<meta name='twitter:image' content='{$this->image}'>";
            }
        }

        return implode(PHP_EOL, $html);
    }

    public function setTitle($title)
    {
        // open redirect vulnerability fix
        $title = str_replace(['http-equiv=', 'url='], '', $title);
        $title = strip_tags($title);
        $this->title = $title;

        return $this;
    }

    public function setDescription($description)
    {
        $this->description = ! $description ? $description : htmlspecialchars($description, ENT_QUOTES, 'UTF-8', false);

        return $this;
    }

    public function setKeywords(array $keywords)
    {
        // clean keywords
        $keywords = array_map('strip_tags', $keywords);
        // store keywords
        $this->keywords = $keywords;

        return $this;
    }

    public function setAuthor($author)
    {
        $this->author = ! $author ? $author : htmlspecialchars($author, ENT_QUOTES, 'UTF-8', false);

        return $this;
    }

    public function setRobots($robots)
    {
        $this->robots = ! $robots ? $robots : htmlspecialchars($robots, ENT_QUOTES, 'UTF-8', false);

        return $this;
    }

    public function setCanonicalUrl($setCanonical)
    {
        $this->setCanonicalUrl = (bool) $setCanonical;

        return $this;
    }

    public function setImage($imageUrl)
    {
        $this->image = $imageUrl;

        return $this;
    }

    public function setOgTags($setOgTags)
    {
        $this->setOgTags = (bool) $setOgTags;

        return $this;
    }

    public function setTwitterCards($setTwitterCards)
    {
        $this->setTwitterCards = (bool) $setTwitterCards;

        return $this;
    }
}