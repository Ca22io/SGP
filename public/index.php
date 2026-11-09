<?php
use App\Config\Database;

require_once __DIR__ . '/../src/Config/DataBase.php';

Database::getConnection();

echo "<h1>Sucesso! Conectado ao MySQL via Docker! 🐳🚀</h1>";
echo "<p>Seu ambiente PHP com MySQL está pronto.</p>";

Database::closeConnection();

?>
