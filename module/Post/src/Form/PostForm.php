<?php

namespace Post\Form;

use Zend\Form\Form;

/**
 * Post Form
 */
class PostForm extends Form
{
    function __construct($name=null) {
        parent::__construct('post');
        $this->setAttribute('method', 'POST');

        $this->add([
            'name' => 'id',
            'type' => 'hidden'
        ]);

        $this->add([
            'name' => 'title',
            'type' => 'text',
            'options' => [
                'label'=> 'Title'
            ],
            'attributes' => [
                'class' => 'form-control'
            ]
        ]);

        $this->add([
            'name' => 'description',
            'type' => 'textarea',
            'options' => [
                'label'=> 'Description'
            ],
            'attributes' => [
                'class' => 'form-control',
                'rows' => 5
            ]
        ]);

        $this->add([
            'name' => 'category',
            'type' => 'text',
            'options' => [
                'label'=> 'Category'
            ],
            'attributes' => [
                'class' => 'form-control'
            ]
        ]);

        $this->add([
            'name' => 'submit',
            'type' => 'submit',
            'attributes' => [
                'value' => 'Save',
                'id' => 'btnSave',
                'class' => 'btn btn-primary'
            ]
        ]);
    }
}