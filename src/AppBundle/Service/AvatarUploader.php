<?php

namespace AppBundle\Service;

use Symfony\Component\HttpFoundation\File\UploadedFile;

class AvatarUploader {

    private $UPLOAD_DIR = 'avatars';
    private $file;
    private $filename;
    private $uploaded = false;

    public function upload(UploadedFile $file = null) {
        $this->file = $file;

        if ($this->isValid()) {
            $this->filename = $this->generateUniqueName($this->file);

            $this->file->move(
                $this->getUploadDir(),
                $this->filename
            );

            $this->uploaded = true;
        }
    }

    private function isValid() {
        return $this->file !== null && $this->file->isValid();
    }

    private function generateUniqueName(UploadedFile $file) {
        return md5(uniqid()).'.'.$file->guessExtension();
    }

    public function getFileName() {
        return $this->filename;
    }

    public function getUploadDir() {
        return $this->UPLOAD_DIR;
    }

    public function isUploaded() {
        return $this->uploaded;
    }
}