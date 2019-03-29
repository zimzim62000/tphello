<?php

namespace App\Service;

use App\Entity\Characters;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class CharacterImageUploader
{
    private $targetDirectory;

    public function __construct($targetDirectory)
    {
        $this->targetDirectory = $targetDirectory;
    }

    public function upload(Characters $char)
    {
        if ($char->getPicture() !== null) {
            $fileName = md5(uniqid()) . '.' . $char->getPicture()->guessExtension();
            try {
                $char->getPicture()->move($this->getTargetDirectory() . Characters::DIR_UPLOAD, $fileName);
                $char->setPicture($fileName);
            } catch (FileException $e) {
                // ... handle exception if something happens during file upload
                throw new \Exception('Error when upload picture');
            }
        }
    }

    public function removeFile(Characters $char)
    {
        if ($char->getPicture() !== null) {
            return \unlink($this->getTargetDirectory() . Characters::DIR_UPLOAD . '/' . $char->getPicture());
        }
        return true;
    }

    public function getTargetDirectory()
    {
        return $this->targetDirectory;
    }
}