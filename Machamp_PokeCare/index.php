<?php
session_start();
require_once 'classes.php';

// Inisialisasi Pokémon jika belum ada
if (!isset($_SESSION['pokemon'])) {
    $_SESSION['pokemon'] = new Machamp();
}
if (!isset($_SESSION['history'])) {
    $_SESSION['history'] = new TrainingHistory();
}

$pokemon = $_SESSION['pokemon'];
?>
<!DOCTYPE html>
<html>
<head>
    <title>PokéCare - Beranda</title>
</head>
<body>
    <h1>PokéCare - Pokémon Research & Training Center</h1>
    
    <div class="pokemon-info">
        <h2>Informasi Pokémon Anda</h2>
        <p><strong>Nama:</strong> <?= $pokemon->getNama() ?></p>
        <p><strong>Tipe:</strong> <?= $pokemon->getTipe() ?></p>
        <p><strong>Level:</strong> <?= $pokemon->getLevel() ?></p>
        <p><strong>HP:</strong> <?= $pokemon->getHp() ?>/<?= $pokemon->getMaxHp() ?></p>
        <p><strong>Jurus Spesial:</strong> <?= $pokemon->getSpecialMove() ?></p>
    </div>
    
    <div class="navigation">
        <a href="training.php"><button>Mulai Latihan</button></a>
        <a href="history.php"><button>Riwayat Latihan</button></a>
    </div>
</body>
</html>