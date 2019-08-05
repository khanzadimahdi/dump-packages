<?php

namespace khanzadimahdi\UploadManager\Contracts;

interface UploadableInterface
{
    public function getName();

    public function getExtension();

    public function getSize();

    public function read();
}
