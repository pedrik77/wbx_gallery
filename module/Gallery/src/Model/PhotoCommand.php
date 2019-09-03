<?php

namespace Gallery\Model;

use RuntimeException;

class PhotoCommand implements PhotoCommandInterface
{
    /**
     * {@inheritDoc}
     */
    public function uploadPhoto($file)
    {
        $path = PhotoRepository::PHOTO_FULLPATH . '/' . preg_replace('/\s/', '_', $file['name']);
        if (file_exists($path)) {
            throw new RuntimeException('File with this name already exists!');
        }
        return copy($file['tmp_name'], $path);
    }
    /**
     * {@inheritDoc}
     */
    public function deletePhoto($path)
    {
        $path = PhotoRepository::PHOTO_FULLPATH . '/' . $path;
        if (!file_exists($path)) {
            throw new RuntimeException('File with this name doesn\'t exists!');
        }
        return unlink($path);
    }
}
