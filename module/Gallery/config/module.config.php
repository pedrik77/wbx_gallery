<?php

namespace Gallery;

use Gallery\Controller\PhotoController;
use Gallery\Factory\GalleryControllerFactory;
use Gallery\Factory\PhotoControllerFactory;
use Zend\Router\Http\Segment;
use Zend\ServiceManager\Factory\InvokableFactory;

return [

    'router' => [
        'routes' => [
            'photo' => [
                'options' => [
                    'route' => '/photo/:action[/:path]',
                    'constraints' => [
                        'action' => 'upload|delete',
                        'path' => '[a-zA-Z0-9\._-]+'
                    ],
                    'defaults' => [
                        'controller' => PhotoController::class
                    ]
                ],
                'type' => Segment::class,
            ]
        ]
    ],

    'controllers' => [
        'factories' => [
            Controller\GalleryController::class => GalleryControllerFactory::class,
            Controller\PhotoController::class => PhotoControllerFactory::class,
        ],
    ],

    'service_manager' => [
        'aliases' => [
            Model\PhotoRepositoryInterface::class => Model\PhotoRepository::class,
            Model\PhotoCommandInterface::class => Model\PhotoCommand::class,
        ],
        'factories' => [
            Model\PhotoRepository::class => InvokableFactory::class,
            Model\PhotoCommand::class => InvokableFactory::class,
        ],
    ],

    'view_manager' => [
        'template_path_stack' => [
            'album' => __DIR__ . '/../view',
        ],
    ],
];
