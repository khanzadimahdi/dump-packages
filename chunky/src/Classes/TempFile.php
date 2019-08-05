<?php

namespace Shetabit\Chunky\Classes;

use Shetabit\Chunky\Contracts\TempFileInterface;

class TempFile implements TempFileInterface
{
    protected $path;
    protected $handle;

    public function __construct($path = null, $data = null)
    {
        $this->setPath($path);

        if($data) {
            $this->write($data);
        }
    }

    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }

    public function getPath()
    {
        return $this->path;
    }

    public function read($offset = null, $length = null)
    {
        $offset = $offset ?? 0;
        $length = $length ?? filesize($this->getPath());

        $handle = $this->openHandle($this->getPath(), 'r+');

        if ($offset) {
           fseek($handle, $offset);
        }

        return fread($handle, $length);
    }

    public function write($data)
    {
        $handle = $this->openHandle($this->getPath(), 'w+', true);

        fwrite($handle, $data);

        return $this;
    }

    public function store($path, $offset = null, $length = null)
    {
        $data = $this->read($offset, $length);

        $handle = $this->openHandle($path, 'w+');

        fwrite($handle, $data);

        return $this;
    }

    protected function openHandle($path, $mode, $isTemporary = false)
    {
        $this->handle = $isTemporary ? tmpfile() : fopen($path, $mode);

        if ($isTemporary) {
            $metaDatas = stream_get_meta_data($this->handle);

            $this->setPath($metaDatas['uri']);
        }

        return $this->handle;
    }

    protected function closeHandle()
    {
        if ($this->handle) {
            fclose($this->handle);
        }

        return $this;
    }

    public function __destruct()
    {
        $this->closeHandle();
    }
}
