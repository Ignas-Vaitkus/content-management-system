<?php

namespace Models;

use Doctrine\ORM\Mapping as ORM;
use LengthException;

/**
 * @ORM\Entity
 * @ORM\Table(name="pages")
 */
class Page
{
    /** 
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    protected $id;

    /** 
     * @ORM\Column(type="string")
     */
    protected string $title;

    /** 
     * @ORM\Column(type="text")
     */
    protected string $content;

    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    function getTitle()
    {
        return $this->title;
    }
    /**
     * @param string $name 
     * @return Page
     */
    function setTitle(string $title): self
    {
        if (strlen($title) <= 255) {
            $this->title = $title;
            return $this;
        } else {
            throw new LengthException('String value must not be larger than 255');
        }
    }
    /**
     * @return string
     */
    function getContent(): string
    {
        return $this->content;
    }

    /**
     * @param string $content 
     * @return Page
     */
    function setContent(string $content): self
    {
        $this->content = $content;
        return $this;
    }
}
