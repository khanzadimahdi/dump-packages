<?php

namespace Shetabit\Chunky\Adapters;

use Shetabit\Chunky\Abstracts\TempFileAdapterAbstract;
use Shetabit\Chunky\Contracts\TempFileAdapterInterface;

class Base64ToTempFile extends TempFileAdapterAbstract implements TempFileAdapterInterface
{
    public function decodeData()
    {
        $encodedData = $this->getEncodedData();
        $pattern = '/^data:((?:(?!\;).)*)((?:\;[\w=]*[^;])*)\,(.+)$/iu';

        $foundFlag = (bool) preg_match($pattern, $encodedData, $matches);

        $mime = $matches[1];
        $meta = $matches[2] ? $this->extractMetas($matches[2]) : [];
        $data = base64_decode($matches[3]);

        return $foundFlag ? ['mime' => $mime, 'meta' => $meta, 'data' => $data] : null;
    }

    private function extractMetas($meta)
    {
        $pattern = '/\;(\w+)[=:]?(\w+)/iu';
        $foundFlag = preg_match_all($pattern,$meta,$matches);

        dd($matches,$meta);

        return $foundFlag ?? $matches;
    }
}
