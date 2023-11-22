<?php

require_once __DIR__ . '/../Database/Database.php';

class Validator
{
    // Sanitize Input
    public static function sanitizeInput($input)
    {
        return trim(htmlspecialchars(htmlentities(stripslashes($input))));
    }

    // Check if the input Length is within the allowed range 
    public static function checkLength($input, $min, $max)
    {
        if (!(strlen($input) >= $min && strlen($input) <= $max)) {
            return false;
        }
        return true;
    }

    // Check if an input exists
    public static function checkRequired($input)
    {
        if (empty($input)) {
            return false;
        }
        return true;
    }

    // Check if SKU is unique
    public static function isSkuUnique($input)
    {

        $database = new Database();
        $db = $database->getConnection();
        // Prepare the SQL statement
        $sql = "SELECT COUNT(*) as count FROM `products` WHERE `sku` = :input";

        // Prepare the statement
        $stmt = $db->prepare($sql);

        // Bind the parameter
        $stmt->bindParam(':input', $input, PDO::PARAM_STR);

        // Execute the query
        $stmt->execute();

        // Fetch the result
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        // Check if the count is 0, indicating that the value is unique
        if ($result['count'] > 0) {
            return false;
        }
        return true;
    }

    // Check if the value is numeric
    public static function isNumber($input)
    {
        if (!is_numeric($input)) {
            return false;
        }
        return true;
    }
}
