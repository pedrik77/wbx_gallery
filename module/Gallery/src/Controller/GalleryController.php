<?php

namespace Gallery\Controller;

use Gallery\Model\PhotoRepositoryInterface;
use Zend\Mvc\Controller\AbstractActionController;

class GalleryController extends AbstractActionController
{

    /**
     * @var PhotoRepositoryInterface
     */
    private $repository;

    public function __construct(PhotoRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function indexAction()
    {
        return ['photos' => $this->repository->getAllPhotos()];
    }
}
