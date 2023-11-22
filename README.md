# Scandiweb Test Task

This PHP-based web application, developed for Scandiweb Junior Developer Test Task, provides functionality for managing products. It includes a product list with the ability to perform multiple deletions and an Add Product page.

![Product List](https://i.imgur.com/JZKr2qK.png)
![Add Product](https://i.imgur.com/XriLM89.png)

## Features

- View a list of products
- Perform multiple deletions of selected products
- Add new products with details like sku, name, price, and product attributes

## Technologies Used

- HTML
- CSS
- JavaScript
- PHP
- MySQL

## Installation

1. Clone the repository:

    ```bash
    git clone https://github.com/Fatma-Tawfeek/scandiweb-test-task.git
    ```

2. Set up the database:
    - Create a MySQL database.
    - Import the `database.sql` file to create the necessary table.

    ```bash
    mysql -u your-username -p your-database-name < database.sql
    ```

3. Configure database connection:
    - Open `config.php`.
    - Update the database credentials with your own.

4. Start the PHP development server:

    ```bash
    php -S localhost:8000 -t public
    ```

5. Open your browser and navigate to [http://localhost:8000](http://localhost:8000).

## Usage

1. Visit the Products List page at [http://localhost:8000/](http://localhost:8000) to view and manage existing products.
2. Navigate to [http://localhost:8000/add-product.php](http://localhost:8000/add-product.php) to add a new product.