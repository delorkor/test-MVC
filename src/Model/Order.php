<?php

namespace Test\Test\Model;
use PDO;
use Test\Test\Component\Database;

class Order
{
    private int $id;
    private int $id_user;
    private string $product;
    private string $description;

    public function setId(int $id)
    {
        $this->id = $id;
    }

    public function getId(): int
    {
        return $this->id;
    }
    public function setId_user(int $id_user)
    {
        $this->id_user = $id_user;
    }

    public function getId_user(): int
    {
        return $this->Id_user;
    }

    public function setProduct(string $product)
    {
        $this->product = $product;
    }

    public function getProduct(): string 
    {
        return $this->product;
    }

    public function setDescription(string $description)
    {
        $this->description = $description;
    }

    public function getDescription(): string 
    {
        return $this->surname;
    }

    public static function getUserOrders($idUser, bool $isObjectFormat = true)
    {
        $db = Database::getConnection();

        $stmt = $db->prepare("SELECT * FROM orders WHERE id_user=?");
        $stmt->bindValue(1,$idUser);
        $stmt->execute();

        if ($isObjectFormat) {
            $stmt->setFetchMode(PDO::FETCH_CLASS, Order::class); // User::class ='App\Mvc\Model\User' 

            return $stmt->fetchAll();
        }

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }





    
    public static function create(array $data)
    {
        $db = Database::getConnection();

        $stmt = $db->prepare("INSERT INTO orders (id_user, product) VALUES (?,?)");

        $stmt->execute([$data['id_user'], $data['product']]);
    }
}