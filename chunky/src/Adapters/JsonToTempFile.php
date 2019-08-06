<?php

namespace Shetabit\Chunky\Adapters;

use Shetabit\Chunky\Abstracts\TempFileAdapterAbstract;
use Shetabit\Chunky\Contracts\TempFileAdapterInterface;

class JsonToTempFile extends TempFileAdapterAbstract implements TempFileAdapterInterface
{
    public function decodeData()
    {
        $jsonObj = json_decode($this->getEncodedData(), false);

        $foundFlag = !empty($jsonObj);

        $mime = $jsonObj->mime ?? null;
        $meta = $jsonObj->meta ?? null;
        $data = base64_decode($jsonObj->data);

        return $foundFlag ? ['mime' => $mime, 'meta' => $meta, 'data' => $data] : null;
    }
}
