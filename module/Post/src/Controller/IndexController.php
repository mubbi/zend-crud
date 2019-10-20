<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Post\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Post\Form\PostForm;
use Post\Model\Post;

class IndexController extends AbstractActionController
{
    protected $table;

    public function __construct($table) {
        $this->table = $table;
    }

    public function indexAction()
    {
        $posts = $this->table->getTable();
        return new ViewModel([
          'posts' => $posts
       ]);
    }

    public function addAction()
    {
        $form = new PostForm;

        $request = $this->getRequest();

        if(!$request->isPost()) {
            return new ViewModel([
                'form' => $form
            ]);
        }

        $post = new Post;

        $postData = $this->getRequest()->getPost()->toArray();

        $form->setData($postData);

        if(!$form->isValid()) {
            exit('id is not valid');
        }

        $post->exchangeArray($form->getData());
        $this->table->insert($post);

        return $this->redirect()->toRoute('post', [
            'controller' => 'index',
            'action' => 'index'
        ]);
    }

    public function editAction()
    {
        $id = $this->params()->fromRoute('id', 0);

        $where = ['id' => $id];

        $post = $this->table->select($where)->current();

        if(empty($post)) {
            return $this->redirect()->toRoute('post', [
                'controller' => 'index',
                'action' => 'index'
            ]);
        }

        $form = new PostForm;
        $form->bind($post);

        $request = $this->getRequest();

        if(!$request->isPost()) {
            return new ViewModel([
                'form' => $form,
                'id' => $id
            ]);
        }

        if(!$form->isValid()) {
            exit('id is not valid');
        }

        $postData = $this->getRequest()->getPost()->toArray();

        $this->table->update($postData, $where);

        return $this->redirect()->toRoute('post', [
            'controller' => 'index',
            'action' => 'index'
        ]);
    }

    public function viewAction()
    {
        $id = $this->params()->fromRoute('id', 0);

        $where = ['id' => $id];

        $post = $this->table->select($where)->current();

        if(empty($post)) {
            return $this->redirect()->toRoute('post', [
                'controller' => 'index',
                'action' => 'index'
            ]);
        }

        return new ViewModel([
            'post' => $post
        ]);
    }

    public function deleteAction()
    {
        $id = $this->params()->fromRoute('id', 0);

        $where = ['id' => $id];

        $post = $this->table->select($where)->current();

        if(empty($post)) {
            return $this->redirect()->toRoute('post', [
                'controller' => 'index',
                'action' => 'index'
            ]);
        }

        $request = $this->getRequest();

        if(!$request->isPost()) {
            return new ViewModel([
                'id' => $id,
                'post' => $post
            ]);
        }

        $this->table->delete($where);

        return $this->redirect()->toRoute('post', [
            'controller' => 'index',
            'action' => 'index'
        ]);
    }
}
