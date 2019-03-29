<?php

namespace App\Upload;

use App\Entity\Characters;
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

    public function upload(Characters $characters)
    {

        if ($characters->getPictureFile() !== null) {
            $fileName = md5(uniqid()).'.'.$characters->getPictureFile()->guessExtension();
            try {
                $characters->getPictureFile()->move($this->getTargetDirectory().Characters::DIR_UPLOAD, $fileName);
                $characters->setPicture($fileName);
            } catch (FileException $e) {
                // ... handle exception if something happens during file upload
                throw new \Exception('Error when upload picture');
            }
        }
    }

    public function removeFile(Characters $characters)
    {
        if ($characters->getPicture() !== null) {
            return \unlink($this->getTargetDirectory().ItemType::DIR_UPLOAD.'/'.$characters->getPicture());
        }

        return true;
    }

    public function getTargetDirectory()
    {
        return $this->targetDirectory;
    }
}