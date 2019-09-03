<?php

namespace Gallery\Factory;

use Gallery\Controller\PhotoController;
use Gallery\Form\UploadForm;
use Gallery\Model\PhotoCommandInterface;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class PhotoControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $formManager = $container->get('FormElementManager');
        return new PhotoController(
            $container->get(PhotoCommandInterface::class),
            $formManager->get(UploadForm::class)
        );
    }
}
