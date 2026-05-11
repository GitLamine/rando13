<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h2>Debug Rando13</h2>";

// Test 1: Database Connection
echo "<h3>Test 1: Connexion Base de Données</h3>";
try {
    $pdo = new PDO("mysql:host=localhost;dbname=rando13", "root", "root");
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    echo "✅ Connexion à la base de données réussie!<br>";
    
    // List tables
    $tables = $pdo->query("SHOW TABLES")->fetchAll();
    echo "Tables trouvées: " . count($tables) . "<br>";
    foreach ($tables as $table) {
        echo "- " . $table[0] . "<br>";
    }
} catch (PDOException $e) {
    echo "❌ Erreur de connexion: " . $e->getMessage() . "<br>";
}

// Test 2: File paths
echo "<h3>Test 2: Chemins de Fichiers</h3>";
echo "DOCUMENT_ROOT: " . $_SERVER['DOCUMENT_ROOT'] . "<br>";
echo "Dossier config existe: " . (file_exists($_SERVER['DOCUMENT_ROOT'] . '/rando13/config.php') ? '✅' : '❌') . "<br>";
echo "Dossier functions existe: " . (file_exists($_SERVER['DOCUMENT_ROOT'] . '/rando13/src/functions.php') ? '✅' : '❌') . "<br>";

// Test 3: PHP Version
echo "<h3>Test 3: Informations PHP</h3>";
echo "PHP Version: " . phpversion() . "<br>";
echo "Extensions PDO: " . (extension_loaded('pdo') ? '✅' : '❌') . "<br>";
echo "Extensions PDO MySQL: " . (extension_loaded('pdo_mysql') ? '✅' : '❌') . "<br>";
?>
