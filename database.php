<?php
// fonction de connexion à la DB
function connectDB()
{
    try {

        // on instancie l'objet PDO dans la variable $pdo
        $pdo = new PDO("mysql:host=" . DBHOST . ";dbname=" . DBNAME, DBUSER, DBPASS);
        // on définit par défaut le mode de fetch
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        $pdo->exec("SET NAMES utf8");
        return $pdo;
    } catch (PDOException $e) {
        die("Erreur de conexion:" . $e->getMessage());
    }
}
$pdo = connectDB();
