<?php
class ProductsAdminController {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function index() {
        $result = $this->conn->query("SELECT * FROM products");
        include 'views/admin/products/index.view.php';
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['product_name'];
            $desc = $_POST['product_description'];
            $image = $_FILES['product_image']['name'];

            move_uploaded_file($_FILES['product_image']['tmp_name'], 'public/static/' . $image);

            $stmt = $this->conn->prepare("INSERT INTO products (product_name, product_description, product_image) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $name, $desc, $image);
            $stmt->execute();

            header("Location: index.php?route=admin/product");
            exit;
        }

        include 'views/admin/products/create.view.php';
    }

    public function edit($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['product_name'];
            $desc = $_POST['product_description'];
            $image = $_FILES['product_image']['name'];

            if (!empty($image)) {
                move_uploaded_file($_FILES['product_image']['tmp_name'], 'public/static/' . $image);
                $stmt = $this->conn->prepare("UPDATE products SET product_name=?, product_description=?, product_image=? WHERE id=?");
                $stmt->bind_param("sssi", $name, $desc, $image, $id);
            } else {
                $stmt = $this->conn->prepare("UPDATE products SET product_name=?, product_description=? WHERE id=?");
                $stmt->bind_param("ssi", $name, $desc, $id);
            }

            $stmt->execute();
            header("Location: index.php?route=admin/product");
            exit;
        }

        $result = $this->conn->query("SELECT * FROM products WHERE id = $id");
        $product = $result->fetch_assoc();

        include 'views/admin/products/edit.view.php';
    }

    public function delete($id) {
        $this->conn->query("DELETE FROM products WHERE id = $id");
        header("Location: index.php?route=admin/product");
        exit;
    }
}
