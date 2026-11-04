<?php
use App\Config\Database;

require_once __DIR__ . '/../src/Config/DataBase.php';

Database::getConnection();

echo "<h1>Sucesso! Conectado ao PostgreSQL via Docker! 🐳🚀</h1>";
echo "<p>Seu ambiente PHP com banco de dados está pronto no Windows 11.</p>";

$conn = null;
?>
