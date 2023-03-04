<?php

namespace Test\Test\Model;
use PDO;
use Test\Test\Component\Database;

class User
{
    private int $id;
    private string $name;
    private string $surname;

    public function setId(int $id)
    {
        $this->id = $id;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setName(string $name)
    {
        $this->name = $name;
    }

    public function getName(): string 
    {
        return $this->name;
    }

    public function setSurname(string $surname)
    {
        $this->surname = $surname;
    }

    public function getSurname(): string 
    {
        return $this->surname;
    }

    public static function getAll(bool $isObjectFormat = true)
    {
        $db = Database::getConnection();

        $stmt = $db->query("SELECT * FROM users");

        if ($isObjectFormat) {
            $stmt->setFetchMode(PDO::FETCH_CLASS, User::class); // User::class ='App\Mvc\Model\User' 

            return $stmt->fetchAll();
        }

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getUser($idUser, bool $isObjectFormat = true)
    {
        $db = Database::getConnection();

        $stmt = $db->prepare("SELECT * FROM users WHERE id=?");
        $stmt->bindValue(1,$idUser);
        $stmt->execute();

        if ($isObjectFormat) {
            $stmt->setFetchMode(PDO::FETCH_CLASS, User::class); // User::class ='App\Mvc\Model\User' 

            return $stmt->fetch();
        }

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function create(array $data)
    {
        $db = Database::getConnection();

        $stmt = $db->prepare("INSERT INTO users (name, surname) VALUES (?,?)");

        $stmt->execute([$data['name'], $data['surname']]);
    }

    public static function Delete(string $idUser, bool $isObjectFormat = true)
    {
        $db = Database::getConnection();

        $stmt = $db->prepare("DELETE FROM users WHERE id=?");

        $stmt->execute([$idUser]);
        if ($isObjectFormat) {
            $stmt->setFetchMode(PDO::FETCH_CLASS, User::class); // User::class ='App\Mvc\Model\User' 

            return $stmt->fetch();
        }
    }
}