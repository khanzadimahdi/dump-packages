<?php

namespace Shetabit\Chunky\Contracts;

interface TempFileAdapterInterface
{
    public function toTempFile() : TempFileInterface;
}
