<?php

namespace app\models;

class Files {

    public function getFilesPaths($path) {
        $files  = scandir($path);
        $names = [];
        foreach ($files as $file) {
            if (($file == '.') || ($file == '..')) continue;
            $names[] = $file;
        }
        $urls = self::getFileUrl($names);
        return $urls;
    }

    protected static function getFileUrl($names) {
        if($names != []) {
            $urls = [];
            foreach ($names as $name) {
                $urls[$name] = "storage/files/".$name;
            }
            return $urls;
        }
    }
}