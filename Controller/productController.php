<?php

namespace Controller;

use Model\productModel;

require_once './Model/productModel.php';

class productController
{
    private $model;

    public function __construct()
    {
        $this->model = new productModel();
    }

    public function brieflyAFew($page)
    {
        return $this->model->getSeveral(($page - 1) * 3);
    }

    public function deployment($productId)
    {
        return  $this->model->getOne($productId);
    }

    public function settingsTransfer() {
        return  $this->model->getSettings();
    }

    public function takeSettings ()
    {
        $arr = ['platform' => $_POST['platform'], 'genre' => $_POST['genre'],
            'currency' => $_POST['currency'] ,'price__min' => $_POST['price__min'],
            'price__max' => $_POST['price__max']];
        return $this->model->getSeveral($arr);
    }

    public function takeNew ()
    {
        $arr = ['name' => $_POST['new-name'], 'genre' => $_POST['new-genre'], 'platform' => $_POST['new-platform'],
            'type' => $_POST['new-type'], 'currency' => $_POST['new-currency'] ,'price__min' => $_POST['new-price__min'],
            'price__max' => $_POST['new-price__max'], 'annotation' => $_POST['new-annotation'], 'announce  ' => $_POST['new-announce']];
        return $this->model->addNew($arr);
    }

    public function paging()
    {
        return ceil(($this->model->getCount()) / 3);
    }
}