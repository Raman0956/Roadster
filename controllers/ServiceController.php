<?php
require_once 'models/Service.php';

class ServiceController {
    public function list() {
        $serviceModel = new Service();
        $services = $serviceModel->getServices();
        require 'views/services/list.php';
    }
}
?>
