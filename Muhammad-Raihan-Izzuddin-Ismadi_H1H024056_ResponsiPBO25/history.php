<?php
// File: history.php
session_start();
if (!isset($_SESSION['machamp'])) {
    header('Location: index.php');
    exit();
}

$machamp = $_SESSION['machamp'];
$manajer = $_SESSION['manajer_latihan'];

$riwayat = $machamp->getRiwayatLatihan();
$laporan = $manajer->getLaporanLatihan();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat - PokéCare</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>📊 Riwayat Latihan</h1>
            <nav>
                <a href="index.php" class="btn">🏠 Beranda</a>
                <a href="training.php" class="btn">💪 Latihan</a>
                <a href="history.php" class="btn active">📊 Riwayat</a>
            </nav>
        </header>

        <main>
            <?php if (empty($riwayat)): ?>
                <div class="empty-state">
                    <h2>📝 Belum Ada Riwayat Latihan</h2>
                    <p>Mulai latihan pertama Anda di halaman <a href="training.php">Latihan</a>!</p>
                </div>
            <?php else: ?>
                <div class="training-report">
                    <h2>📈 Laporan Latihan</h2>
                    <div class="report-summary">
                        <div class="summary-item">
                            <span class="number"><?php echo $laporan['total_sesi']; ?></span>
                            <span class="label">Total Sesi</span>
                        </div>
                        <?php foreach($laporan['sesi_per_jenis'] as $jenis => $jumlah): ?>
                        <div class="summary-item">
                            <span class="number"><?php echo $jumlah; ?></span>
                            <span class="label"><?php echo $jenis; ?></span>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="history-section">
                    <h2>🕐 Riwayat Sesi Latihan</h2>
                    <div class="history-table">
                        <table>
                            <thead>
                                <tr>
                                    <th>Waktu</th>
                                    <th>Jenis Latihan</th>
                                    <th>Intensitas</th>
                                    <th>Level</th>
                                    <th>HP</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach(array_reverse($riwayat) as $sesi): ?>
                                <tr>
                                    <td><?php echo $sesi['waktu']; ?></td>
                                    <td>
                                        <?php 
                                        $icons = [
                                            'Attack' => '⚔️',
                                            'Defense' => '🛡️', 
                                            'Speed' => '⚡'
                                        ];
                                        echo $icons[$sesi['jenis']] . ' ' . $sesi['jenis']; 
                                        ?>
                                    </td>
                                    <td><?php echo $sesi['intensitas']; ?></td>
                                    <td>
                                        <span class="change">
                                            <?php echo $sesi['level_sebelum']; ?> 
                                            → 
                                            <strong><?php echo $sesi['level_sesudah']; ?></strong>
                                        </span>
                                    </td>
                                    <td>
                                        <span class="change">
                                            <?php echo $sesi['hp_sebelum']; ?> 
                                            → 
                                            <strong><?php echo $sesi['hp_sesudah']; ?></strong>
                                        </span>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="progress-chart">
                    <h2>📊 Grafik Perkembangan</h2>
                    <div class="chart-container">
                        <div class="chart-item">
                            <h3>Perkembangan Level</h3>
                            <div class="chart-bar">
                                <?php 
                                $maxLevel = max($laporan['perkembangan_level']);
                                foreach($laporan['perkembangan_level'] as $index => $level): 
                                    $width = ($level / $maxLevel) * 100;
                                ?>
                                <div class="chart-bar-item">
                                    <div class="bar-level" style="width: <?php echo $width; ?>%"></div>
                                    <span class="bar-label">Sesi <?php echo $index + 1; ?>: <?php echo $level; ?></span>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </main>
    </div>
</body>
</html>
