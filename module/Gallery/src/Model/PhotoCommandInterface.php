<?php

namespace Gallery\Model;

interface PhotoCommandInterface
{
    /**
     * @return string
     */
    public function uploadPhoto($file);

    /**
     * @return boolean
     */
    public function deletePhoto($path);
}
