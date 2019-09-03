<?php

namespace Gallery\Model;

class PhotoRepository implements PhotoRepositoryInterface
{
    const PHOTO_PATH = '/photos';
    const PHOTO_FULLPATH = ROOT_PATH . '/public' .  self::PHOTO_PATH;

    /**
     * {@inheritDoc}
     */
    public function getAllPhotos()
    {
        return array_map(function ($path) {
            return [
                'path' => $path,
                'fullpath' => self::PHOTO_PATH . '/' . $path
            ];
        }, array_slice(scandir(self::PHOTO_FULLPATH), 2));
    }
}
