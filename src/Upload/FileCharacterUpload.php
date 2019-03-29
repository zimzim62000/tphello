<?php
/**
 * Created by PhpStorm.
 * User: amaury.beauchamp
 * Date: 29/03/19
 * Time: 13:28
 */

namespace App\Upload;

use App\Entity\Characters;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileCharacterUpload
{
    private $targetDirectory;

    public function __construct($character_dir)
    {
        $this->targetDirectory = $character_dir;
    }

    public function upload(Characters $character)
    {
        if ($character->getPictureFile() !== null) {
            $fileName = md5(uniqid()).'.'.$character->getPictureFile()->guessExtension();
            try {
                $character->getPictureFile()->move($this->getTargetDirectory().Characters::DIR_UPLOAD, $fileName);
                $character->setPicture($fileName);
            } catch (FileException $e) {
                // ... handle exception if something happens during file upload
                throw new \Exception('Error when upload picture');
            }
        }
    }
    public function removeFile(Characters $character)
    {
        if ($character->getPicture() !== null) {
            return \unlink($this->getTargetDirectory().Characters::DIR_UPLOAD.'/'.$character->getPicture());
        }
        return true;
    }
    public function getTargetDirectory()
    {
        return $this->targetDirectory;
    }
}