<?php

namespace Gallery\Factory;

use Gallery\Controller\GalleryController;
use Gallery\Model\PhotoRepositoryInterface;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class GalleryControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    { 
        return new GalleryController(
            $container->get(PhotoRepositoryInterface::class)
        );
    }
}
