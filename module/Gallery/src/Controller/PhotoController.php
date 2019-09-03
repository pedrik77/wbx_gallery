<?php

namespace Gallery\Controller;

use Gallery\Form\UploadForm;
use Gallery\Model\PhotoCommandInterface;
use Gallery\Model\PhotoRepository;
use RuntimeException;
use Zend\Mvc\Controller\AbstractActionController;

class PhotoController extends AbstractActionController
{

    /**
     * @var PhotoCommandInterface
     */
    private $command;

    /**
     * @var UploadForm
     */
    private $uploadForm;

    public function __construct(PhotoCommandInterface $command, UploadForm $uploadForm)
    {
        $this->command = $command;
        $this->uploadForm = $uploadForm;
    }

    public function uploadAction()
    {
        $request = $this->getRequest();
        $return = ['form' => $this->uploadForm, 'message' => null];

        if (!$request->isPost()) {
            return $return;
        }

        $post = array_merge_recursive(
            $request->getPost()->toArray(),
            $request->getFiles()->toArray()
        );
        $this->uploadForm->setData($post);

        if (!$this->uploadForm->isValid()) {
            return $return;
        }

        $photo = $this->uploadForm->getData();
        try {
            if (!$this->command->uploadPhoto($photo['photo'])) {
                return $return;
            }
        } catch (RuntimeException $e) {
            $request['message'] = $e->getMessage();
            return $return;
        }

        return $this->redirect()->toRoute('home');
    }

    public function deleteAction()
    {
        $request = $this->getRequest();
        $path = $this->params()->fromRoute('path');
        if (!$path) {
            return $this->redirect()->toRoute('home');
        }

        $return = ['path' => PhotoRepository::PHOTO_PATH . '/' . $path];

        if (!$request->isPost()) {
            return $return;
        }

        if ($request->getPost()['confirm'] == 'Delete') {
            try {
                if ($this->command->deletePhoto($path)) {
                    return $this->redirect()->toRoute('home');
                }
            } catch (RuntimeException $e) { }
        } else {
            return $this->redirect()->toRoute('home');
        }
        return $return;
    }
}
