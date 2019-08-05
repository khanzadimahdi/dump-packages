<?php

namespace khanzadimahdi\UploadManager\Contracts;

interface UploaderInterface
{
    public function store(UploadableInterface $uploadable);
}
