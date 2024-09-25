<?php
// app/controllers/ProductController.php

include_once '../models/Product.php';
include_once '../core/Database.php';

class ProductController {
    private $db;
    private $product;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->product = new Product($this->db);
    }

    // Obtener todos los productos
    public function getAll() {
        $stmt = $this->product->getAll();
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return json_encode($products);
    }

    // Obtener un producto por ID
    public function getById($id) {
        $product = $this->product->getById($id);
        return json_encode($product);
    }

    // Crear un nuevo producto
    public function create($data) {
        $this->product->nombre = $data->nombre;
        $this->product->descripcion = $data->descripcion;
        $this->product->precio = $data->precio;
        if ($this->product->create()) {
            return json_encode(["message" => "Producto creado con éxito"]);
        }
        return json_encode(["message" => "Error al crear el producto"]);
    }

    // Actualizar un producto
    public function update($id, $data) {
        $this->product->nombre = $data->nombre;
        $this->product->descripcion = $data->descripcion;
        $this->product->precio = $data->precio;
        if ($this->product->update($id)) {
            return json_encode(["message" => "Producto actualizado con éxito"]);
        }
        return json_encode(["message" => "Error al actualizar el producto"]);
    }

    // Eliminar un producto
    public function delete($id) {
        if ($this->product->delete($id)) {
            return json_encode(["message" => "Producto eliminado con éxito"]);
        }
        return json_encode(["message" => "Error al eliminar el producto"]);
    }
}
?>