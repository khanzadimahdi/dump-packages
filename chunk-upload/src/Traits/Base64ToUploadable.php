<?php

trait Base64ToUploadable
{
    private function getPattern()
    {
        return '/^data:(.*?);base64,(.*)/iu';
    }

    public function getUploadable($uri)
    {
        return preg_match($this->getPattern(), $uri, $matches) ? ['mime' => $matches[1], 'data' => $matches[2]] : null
    }
}
