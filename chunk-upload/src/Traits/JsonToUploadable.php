<?php

trait JsonToUploadable
{
    public function getUploadable($json)
    {
        return ($json->mime && $json->data) ? ['mime' => $json->mime, 'data'=> $json->data] : null;
    }
}
