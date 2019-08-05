<?php

namespace khanzadimahdi\UploadManager\Abstracts;

use khanzadimahdi\UploadManager\Contracts\UploadableInterface;

abstract class UploadableAbstract implements UploadableInterface
{
    protected $fullName;

    protected $size;

    public function setFullName($fullName)
    {
        return $this->fullName = $fullName;
    }

    public function getFullName()
    {
        return $this->fullName;
    }

    public function getName()
    {
        return pathinfo($this->getFullName(), PATHINFO_FILENAME);
    }

    public function getExtension()
    {
        return pathinfo($this->getFullName(), PATHINFO_EXTENSION);
    }

    public function setSize($size)
    {
        return $this->size = $size;
    }

    public function getSize()
    {
        return $this->size;
    }

    abstract public function read();
}
