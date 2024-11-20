<?php
session_start();
require_once 'C:/xampp/htdocs/roadsters/models/FavoriteModel.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userID = $_SESSION['userID'] ?? null;
    $carID = $_POST['carID'] ?? null;

    if ($userID && $carID) {
        $favoriteModel = new FavoriteModel();

        if (isset($_POST['saveCar'])) {
            $favoriteModel->saveCarAsFavorite($userID, $carID);
            header("Location: /roadsters/views/cars/viewCar.php?carID=$carID&status=saved");
        } elseif (isset($_POST['removeFavorite'])) {
            // Remove the car from favorites
            if (isset($_POST['redirect']) && $_POST['redirect'] === 'favorites') {
                $favoriteModel->removeCarFromFavorite($userID, $carID);
                header("Location: /roadsters/views/cars/viewFavoriteCars.php"); // Redirect to the favorites page
            } else {
                $favoriteModel->removeCarFromFavorite($userID, $carID);
                header("Location: /roadsters/views/cars/viewCar.php?carID=$carID&status=removed"); // Redirect to the car details page
            }
        } elseif (isset($_POST['viewCar'])) {
            // Redirect to the car details page
            header("Location: /roadsters/views/cars/viewCar.php?carID=$carID");
        }
        exit();
    } else {
        header("Location: /roadsters/index.php?error=invalid");
        exit();
    }
}
