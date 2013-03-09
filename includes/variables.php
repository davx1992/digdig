<?php
$baseUrl = 'http://localhost/digdig/';

    function getData($type = null){
        $data = array();
        if ($type == null) {
            if (isset($_GET) && is_array($_GET) && !empty($_GET)) {
                $data['get'] = $_GET;
            }
            if (isset($_POST) && is_array($_POST) && !empty($_POST)) {
                $data['get'] = $_GET;
            }
            if (empty($data)) {
                $data = false;
            }
        } else {
            switch ($type) {
                case 'get':
                    $type = $_GET;
                break;
                case 'post':
                    $type = $_POST;
                break;
            }
            if (isset($type) && !empty($type)) {
                $data[$type] =  $type;
            } else {
                $data = false;
            }
        }
        return $data;
    }

?>