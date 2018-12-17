<?php

namespace App\Upload;

use App\Entity\ItemType;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileItemTypeUpload
{
    private $targetDirectory;

    public function __construct($targetDirectory)
    {
        $this->targetDirectory = $targetDirectory;
    }

    public function upload(ItemType $itemType)
    {

        if ($itemType->getPictureFile() !== null) {
            $fileName = md5(uniqid()).'.'.$itemType->getPictureFile()->guessExtension();
            try {
                $itemType->getPictureFile()->move($this->getTargetDirectory().ItemType::DIR_UPLOAD, $fileName);
                $itemType->setPicture($fileName);
            } catch (FileException $e) {
                // ... handle exception if something happens during file upload
                throw new \Exception('Error when upload picture');
            }
        }
    }

    public function removeFile(ItemType $itemType)
    {
        if ($itemType->getPicture() !== null) {
            return \unlink($this->getTargetDirectory().ItemType::DIR_UPLOAD.'/'.$itemType->getPicture());
        }

        return true;
    }

    public function getTargetDirectory()
    {
        return $this->targetDirectory;
    }
}