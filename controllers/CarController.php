<?php

require_once 'C:/xampp/htdocs/roadsters/models/CarModel.php';

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


    public function browseCars() {
        // Extract filters, use defaults if not provided
        $filters = [
            'make' => $_GET['make'] ?? '',
            'model' => $_GET['model'] ?? '',
            'year' => $_GET['year'] ?? '',
            'price_min' => $_GET['price_min'] ?? 0,
            'price_max' => $_GET['price_max'] ?? PHP_INT_MAX,
        ];
    
        // Fetch cars based on provided filters
        $cars = $this->carModel->getFilteredCars(
            $filters['make'],
            $filters['model'],
            $filters['year'],
            $filters['price_min'],
            $filters['price_max']
        );

        return $cars;

        require_once '../../roadsters/views/cars/browse.php';

    }


    public function getSearchFilters() {
        $allMakes = $this->carModel->getCarMakes();
        $allModels = $this->carModel->getCarModels();
        $allYears = $this->carModel->getCaryears();
        
        return [
            'makes' => $allMakes,
            'models' => $allModels,
            'years' => $allYears
        ];
    }

    public function viewCar() {
        // Get the carID from the query parameter
        $carID = $_GET['carID'] ?? null;
    
        if ($carID) {
            // Fetch car details from the model
            $car = $this->carModel->getCarById($carID);
    
            // Include the view to display the car details
            require_once '../roadsters/views/cars/viewCar.php';
        } else {
            echo 'Car not found.';
        }
    }
    
    

}

?>
