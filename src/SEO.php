<?php

namespace Lodeb\SEO;

use Illuminate\Support\Collection;

class SEO {
    protected $title;
    protected $description;
    protected $keywords = [];

    public function __construct() {
        $this->title = config('seo.default_title', 'Default Title');
        $this->description = config('seo.default_description', 'Default Description');
        $this->keywords = config('seo.default_keywords', []);
    }

    public function generate()
    {
        $html = [];
        $title = $this->getTitle();
        $description = $this->getDescription();
        $keywords = $this->keywords;
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

    public function getTitle()
    {
        return $this->title;
    }

    private function getDescription()
    {
        return $this->description;
    }

    public function getKeywords()
    {
        return $this->keywords;
    }
}
