<?php

namespace app\controllers;

use app\Controller;

class FilesController extends Controller {

    /** @var $model Files */
    public $model;

    public function filesListAction() {
        $path = '/home/ayunoss/Projects/phpbook/ayunoss/storage/files';
        $data = $this->model->getFilesPaths($path);
        $this->view->render('Files library', $data);
    }

    public function showAction() {
        $name = $_GET['name'];
        $data = self::getContent($name);
        $this->view->render($name, $data);
    }

    public function editFormAction() {
        $name = $_GET['name'];
        $data = self::getContent($name);
        $this->view->render('Edit file', $data);
    }

    protected static function getContent($name) {
        $file = file_get_contents('storage/files/'.$name);
        $data[$name] = $file;
        return $data;
    }

    public function editFileAction() {
        $name   = $_GET['name'];
        $data   = $_POST['text'];
        $file   = 'storage/files/'.$name;
        $result = file_put_contents($file, $data);
        $this->view::redirect("file/?name=".$name);
    }

    public function uploadFormAction() {
        $this->view->render('Download files');
    }

    public function uploadFilesAction() {
        if (!isset($_FILES)) {
            $errors = ['invalid_file' => 'Please select files to upload'];
            echo json_encode(['status' => 'error', 'errors' => $errors]);
            return;
        }
        for ($i = 0; $i < (count($_FILES['files']['name'])); $i++) {
            $tmp_name = $_FILES['files']['tmp_name'][$i];
            $name = $_FILES['files']['name'][$i];
            move_uploaded_file($tmp_name, 'storage/files/'.$name);
        }
        $this->view::redirect('files');
    }

    public function downloadFileAction() {
        $name = $_GET['name'];
        $file = "storage/files/".$name;
        $file_extension = strtolower(substr(strrchr($file,"."),1));

        switch ($file_extension) {
            case "pdf": $ctype="application/pdf"; break;
            case "exe": $ctype="application/octet-stream"; break;
            case "zip": $ctype="application/zip"; break;
            case "rar": $ctype="application/rar"; break;
            case "7z":  $ctype="application/7z"; break;
            case "doc": $ctype="application/msword"; break;
            case "xls": $ctype="application/vnd.ms-excel"; break;
            case "ppt": $ctype="application/vnd.ms-powerpoint"; break;
            case "gif": $ctype="image/gif"; break;
            case "png": $ctype="image/png"; break;
            case "jpe": case "jpeg":
            case "jpg": $ctype="image/jpg"; break;
            default:    $ctype="application/force-download";
        }

        if (ob_get_level()) {
            ob_end_clean();
        }
        header('Content-Description: File Transfer');
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Cache-Control: private",false);
        header("Content-Type: $ctype");
        header('Content-Disposition: attachment; filename=' . basename($file));
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($file));
        set_time_limit(0);
        readfile($file) or die("File not found.");
        exit;
    }

    public function deleteFileAction() {
        $name = $_GET['name'];
        $file = "storage/files/".$name;
        unlink($file);
        $this->view::redirect('files');
    }
}