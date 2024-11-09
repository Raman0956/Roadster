<?php
require_once 'models/CarModel.php';

class CarController {
    private $carModel;

    public function __construct() {
        $this->carModel = new CarModel();
    }

    public function getAllCars() {
        return $this->carModel->getAllCars();
    }

    public function getCarCategories() {
        return $this->carModel->getCarCategories();
    }

    public function filterByCategory($category) {
        return $this->carModel->getCarsByCategory($category);
    }
}
