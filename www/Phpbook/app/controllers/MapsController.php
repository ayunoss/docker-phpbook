<?php
namespace app\controllers;

use app\Controller;
use app\models\Maps;
use function Sodium\add;

class MapsController extends Controller {

    /** @var $model Maps */
    public $model;

    public function yandexMapsAction() {
        $this->view->render('Yandex Maps Api');
    }

    public function createGeoCollectionAction() {
        $collectionName    = filter_var(trim($_POST['collectionName']), FILTER_SANITIZE_STRING);
        $rowAddress        = filter_var(trim($_POST['address']), FILTER_SANITIZE_STRING);
        $rowCoords         = filter_var(trim($_POST['coords']), FILTER_SANITIZE_STRING);
        $address           = explode("\n", $rowAddress);
        $coords            = explode("\n", $rowCoords);

        $this->model->createGeoCollection($collectionName, $address, $coords);
        echo json_encode(['status' => 'success']);
    }

    public function showCollectionAction() {
        $collections = $this->model->getAllGeoCollections();
        $this->view->render('Geo Collections', $collections);
    }

    public function getCoordinatesAction() {
        $collection  = filter_var(trim($_POST['chooseCollection']), FILTER_SANITIZE_STRING);
        $rowCoords   = $this->model->getCoordinates($collection);
        $coords = [];
        $address = [];
        foreach ($rowCoords as $val) {
            $coords[] = $val['point'];
        }
//        var_dump($coords);
//        var_dump($rowCoords);
        echo json_encode(['status'=>'success', 'coords' => $coords]);
    }
}