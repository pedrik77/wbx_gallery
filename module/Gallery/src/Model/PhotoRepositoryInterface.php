<?php

namespace Gallery\Model;

interface PhotoRepositoryInterface
{
    /**
     * get paths for all photos in gallery
     * @return string[]
     */
    public function getAllPhotos();
}
