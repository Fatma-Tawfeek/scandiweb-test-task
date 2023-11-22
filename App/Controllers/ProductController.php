<?php

session_start();

require_once 'Controller.php';
require_once __DIR__ . '/../Validators/Validator.php';

class ProductController extends Controller
{
    public $name;
    public $sku;
    public $price;
    public $productType;
    public $size;
    public $weight;
    public $height;
    public $width;
    public $length;

    public $table = 'products';

    public function __construct()
    {
        parent::__construct();
    }

    public function getAll()
    {
        $query = "SELECT
                    *
                FROM
                    {$this->table} ";

        $stmt = $this->db->prepare($query);
        $stmt->execute();

        return  $stmt;
    }

    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            //write query
            $query = "INSERT INTO
            " . $this->table . "
            SET
            name=:name, price=:price, sku=:sku, size=:size, weight=:weight, height=:height, width=:width, length=:length";

            $stmt = $this->db->prepare($query);

            // posted values
            $this->sku = Validator::sanitizeInput($_POST['sku']);
            $this->name = Validator::sanitizeInput($_POST['name']);
            $this->price = Validator::sanitizeInput($_POST['price']);
            $this->productType = Validator::sanitizeInput($_POST['productType']);
            $this->size = Validator::sanitizeInput($_POST['size']);
            $this->weight = Validator::sanitizeInput($_POST['weight']);
            $this->height = Validator::sanitizeInput($_POST['height']);
            $this->width = Validator::sanitizeInput($_POST['width']);
            $this->length = Validator::sanitizeInput($_POST['length']);


            // sku validations
            if (!Validator::checkRequired($this->sku)) {
                $errors[] = "SKU is required";
            } elseif (!Validator::isSkuUnique($this->sku)) {
                $errors[] = "SKU alreay exists";
            }

            // name validations
            if (!Validator::checkRequired($this->name)) {
                $errors[] = "Name is required";
            } elseif (!Validator::checkLength($this->name, 5, 55)) {
                $errors[] = "Please, enter valid name length between 5 and 55";
            }

            // price validations
            if (!Validator::checkRequired($this->price)) {
                $errors[] = "Price is required";
            } elseif (!Validator::isNumber($this->price)) {
                $errors[] = "Please, enter a valid price";
            }

            // product type validations
            if (!Validator::checkRequired($this->productType)) {
                $errors[] = "Product Type is required";
            }

            // DVD validations
            if ($_POST['productType'] == 'DVD') {
                if (!Validator::checkRequired($this->size)) {
                    $errors[] = "Size is required";
                } elseif (!Validator::isNumber($this->size)) {
                    $errors[] = "Please, enter a valid size";
                }
            }

            // Book validations
            if ($_POST['productType'] == 'Book') {
                if (!Validator::checkRequired($this->weight)) {
                    $errors[] = "Weight is required";
                } elseif (!Validator::isNumber($this->weight)) {
                    $errors[] = "Please, enter a valid weight";
                }
            }

            // Furniture validations
            if ($_POST['productType'] == 'Furniture') {
                if (!Validator::checkRequired($this->height)) {
                    $errors[] = "Height is required";
                } elseif (!Validator::isNumber($this->height)) {
                    $errors[] = "Please, enter a valid height";
                }
                if (!Validator::checkRequired($this->width)) {
                    $errors[] = "Width is required";
                } elseif (!Validator::isNumber($this->width)) {
                    $errors[] = "Please, enter a valid width";
                }
                if (!Validator::checkRequired($this->length)) {
                    $errors[] = "Length is required";
                } elseif (!Validator::isNumber($this->length)) {
                    $errors[] = "Please, enter a valid length";
                }
            }

            // bind values 
            $stmt->bindParam(":sku", $this->sku);
            $stmt->bindParam(":name", $this->name);
            $stmt->bindParam(":price", $this->price);
            $stmt->bindParam(":size", $this->size);
            $stmt->bindParam(":weight", $this->weight);
            $stmt->bindParam(":height", $this->height);
            $stmt->bindParam(":width", $this->width);
            $stmt->bindParam(":length", $this->length);


            if (empty($errors)) {
                $stmt->execute();
                header('location: index.php');
                die();
            } else {
                $_SESSION['errors'] = $errors;
                return false;
            }
        }
    }

    public function destroy()
    {
        // Check if the form is submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['selected_items'])) {
            
            // Get the selected items
            $selectedItems = $_POST['selected_items'];

            // Perform the delete operation for each selected item (replace this with your actual delete logic)
            foreach ($selectedItems as $id) {
                //write query
                $query = "DELETE FROM `products` WHERE `id` = :id";
                $stmt = $this->db->prepare($query);
                $stmt->bindParam(":id", $id);
                $stmt->execute();
            }
            header('location: index.php');
            die();
        }
    }
}
