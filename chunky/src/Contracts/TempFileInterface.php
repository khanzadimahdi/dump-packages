<?php

namespace Shetabit\Chunky\Contracts;

interface TempFileInterface
{
    public function setPath($path);

    public function getPath();

    public function read($offset = null, $length = null);

    public function write($data);

    public function store($path, $offset = null, $length = null);
}
