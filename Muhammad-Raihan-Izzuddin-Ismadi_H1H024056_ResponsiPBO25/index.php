<?php
// File: index.php
session_start();
require_once 'classes/Machamp.php';
require_once 'classes/TrainingManager.php';

// Inisialisasi Pokémon jika belum ada
if(!isset($_SESSION['machamp'])) {
    $_SESSION['machamp'] = new Machamp();
    $_SESSION['manajer_latihan'] = new ManajerLatihan($_SESSION['machamp']);
}

$machamp = $_SESSION['machamp'];
$efektivitas = $machamp->getEfektivitasLatihan();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PokéCare - Machamp</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>🏋️ PokéCare - Pusat Latihan Pokémon</h1>
            <nav>
                <a href="index.php" class="btn active">🏠 Beranda</a>
                <a href="training.php" class="btn">💪 Latihan</a>
                <a href="history.php" class="btn">📊 Riwayat</a>
            </nav>
        </header>

        <main>
            <div class="pokemon-card">
                <h2>✨ Informasi Pokémon Anda</h2>
                <div class="pokemon-info">
                    <div class="pokemon-stats">
                        <p><strong>Nama:</strong> <?php echo $machamp->getNama(); ?></p>
                        <p><strong>Tipe:</strong> <span class="type-fighting"><?php echo $machamp->getTipe(); ?></span></p>
                        <p><strong>Level:</strong> <?php echo $machamp->getLevel(); ?></p>
                        <p><strong>HP:</strong> <?php echo $machamp->getHp(); ?>/<?php echo $machamp->getHpMaksimum(); ?></p>
                        <p><strong>Jurus Spesial:</strong> <?php echo $machamp->getJurusSpesial(); ?></p>
                    </div>
                </div>

                <div class="training-info">
                    <h3>📈 Efektivitas Latihan</h3>
                    <div class="effectiveness-bars">
                        <div class="effectiveness-item">
                            <span>Attack: <?php echo ($efektivitas['Attack'] * 100); ?>%</span>
                            <div class="bar"><div class="fill" style="width: <?php echo ($efektivitas['Attack'] * 100); ?>%"></div></div>
                        </div>
                        <div class="effectiveness-item">
                            <span>Defense: <?php echo ($efektivitas['Defense'] * 100); ?>%</span>
                            <div class="bar"><div class="fill" style="width: <?php echo ($efektivitas['Defense'] * 100); ?>%"></div></div>
                        </div>
                        <div class="effectiveness-item">
                            <span>Speed: <?php echo ($efektivitas['Speed'] * 100); ?>%</span>
                            <div class="bar"><div class="fill" style="width: <?php echo ($efektivitas['Speed'] * 100); ?>%"></div></div>
                        </div>
                    </div>
                </div>

                <?php
                $riwayat = $machamp->getRiwayatLatihan();
                if (!empty($riwayat)) {
                    echo "<div class='quick-stats'>";
                    echo "<h3>📊 Statistik Cepat</h3>";
                    echo "<p>Total Sesi Latihan: " . count($riwayat) . "</p>";
                    echo "<p>Level Tertinggi: " . $machamp->getLevel() . "</p>";
                    echo "<p>HP Tertinggi: " . $machamp->getHpMaksimum() . "</p>";
                    echo "</div>";
                }
                ?>
            </div>
        </main>

        <footer>
            <p>Trainer: <?php echo "Muhammad Raihan Izzuddin Ismadi (H1H024056)"; ?> | Pokémon: Machamp</p>
        </footer>
    </div>
</body>
</html>