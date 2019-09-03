<?php

namespace Gallery\Form;

use Zend\Form\Element;
use Zend\Form\Form;

class UploadForm extends Form
{
    public function init()
    {
        $photo = new Element\File('photo');
        $photo->setLabel('Photo to upload');
        $this->add($photo);
        
        $this->add([
            'name' => 'submit',
            'type' => 'submit',
            'attributes' => [
                'value' => 'Upload',
                'id'    => 'submitbutton',
            ],
        ]);
    }
}
