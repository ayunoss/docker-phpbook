<?php

namespace app\models;

use app\Model;

class Maps extends Model
{
    public function createGeoCollection($name, $address, $coords) {
        $newCollection = $this->db->queryPDO("INSERT INTO GeoCollection VALUES (NULL, '{$name}')");
        $collection_id = $this->db->lastInsertId();
        for ($i = 0; $i < count($address); $i++) {
            $newGeoPoint   = $this->db->queryPDO("
            INSERT INTO GeoPoint VALUES (NULL, '{$address[$i]}', '{$coords[$i]}', '{$collection_id}')");
        }
    }

    public function getAllGeoCollections() {
        $collections = $this->db->getAssocDataViaPDO("SELECT * FROM GeoCollection");
        return $collections;
    }

    public function getCoordinates($id) {
        $data = $this->db->getAssocDataViaPDO("SELECT * FROM GeoPoint WHERE collection_id='{$id}'");
        return $data;
    }

}