<?php

namespace App\Upload;

use App\Entity\Characters;
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

        if ($characters->getPhoto() !== null) {
            $fileName = md5(uniqid()).'.'.$characters->getPhoto()->guessExtension();
            try {
                $characters->getPhoto()->move($this->getTargetDirectory(), $fileName);
                $characters->setPhoto($fileName);
            } catch (FileException $e) {
                // ... handle exception if something happens during file upload
                throw new \Exception('Error when upload picture');
            }
        }
    }

    public function removeFile(Characters $characters)
    {
        if ($characters->getPhoto() !== null) {
            return \unlink($this->getTargetDirectory().Characters::UPLOAD_DIRECTORY.'/'.$characters->getPhoto());
        }

        return true;
    }

    public function getTargetDirectory()
    {
        return $this->targetDirectory;
    }
}