<?php

namespace Shetabit\Chunky\Traits;

use Shetabit\Chunky\Classes\TempFile;
use Shetabit\Chunky\Contracts\TempFileInterface;

trait CollectNormalFile
{
    public function collectFiles()
    {
        $inputFiles = empty($_FILES[$this->getInputName()]) ? null : $_FILES[$this->getInputName()];
        $collectedFiles = [];

        if (empty($inputFiles)) { // there is no file
            // do nothing
        } else if (is_array($inputFiles['tmp_name'])) { // there is an array of files
            foreach ($inputFiles['tmp_name'] as $index => $tmpName) {
                if ($inputFiles['error'][$index] === UPLOAD_ERR_OK) {
                    array_push($collectedFiles, $this->generateTempFile($inputFiles['tmp_name'][$index]));
                }
            }
        } else { // there is a single file
            if ($inputFiles['error'] === UPLOAD_ERR_OK) {
                $tempFile = $this->generateTempFile($inputFiles['tmp_name']);
                array_push($collectedFiles, $tempFile);
            }
        }

        return $collectedFiles;
    }

    public function generateTempFile($name) : TempFileInterface
    {
        return new TempFile($name);
    }
}
