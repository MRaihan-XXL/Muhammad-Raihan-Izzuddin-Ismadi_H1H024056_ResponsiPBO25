<?php
// File: training.php
session_start();
if (!isset($_SESSION['machamp'])) {
    header('Location: index.php');
    exit();
}

$machamp = $_SESSION['machamp'];
$manajer = $_SESSION['manajer_latihan'];

$hasilLatihan = null;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $jenisLatihan = $_POST['jenis_latihan'];
    $intensitas = intval($_POST['intensitas']);
    
    $hasilLatihan = $manajer->lakukanLatihan($jenisLatihan, $intensitas);
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Latihan - PokéCare</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>💪 Latihan Pokémon</h1>
            <nav>
                <a href="index.php" class="btn">🏠 Beranda</a>
                <a href="training.php" class="btn active">💪 Latihan</a>
                <a href="history.php" class="btn">📊 Riwayat</a>
            </nav>
        </header>

        <main>
            <div class="training-section">
                <h2>Latih Machamp Anda</h2>
                
                <form method="post" class="training-form">
                    <div class="form-group">
                        <label for="jenis_latihan">Jenis Latihan:</label>
                        <select name="jenis_latihan" id="jenis_latihan" required>
                            <option value="Attack">⚔️ Attack Training</option>
                            <option value="Defense">🛡️ Defense Training</option>
                            <option value="Speed">⚡ Speed Training</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="intensitas">Intensitas Latihan (1-10):</label>
                        <input type="range" name="intensitas" id="intensitas" min="1" max="10" value="5" required>
                        <span id="intensitas-value">5</span>
                    </div>
                    
                    <button type="submit" class="btn-training">🚀 Mulai Latihan!</button>
                </form>

                <?php if ($hasilLatihan): ?>
                <div class="training-result">
                    <h3>🎉 Hasil Latihan</h3>
                    <div class="result-card">
                        <p class="special-move"><?php echo $hasilLatihan['jurus_spesial']; ?></p>
                        
                        <div class="stat-changes">
                            <div class="stat-change">
                                <span class="label">Level:</span>
                                <span class="change">
                                    <?php echo $hasilLatihan['data_sesi']['level_sebelum']; ?> 
                                    → 
                                    <strong><?php echo $hasilLatihan['data_sesi']['level_sesudah']; ?></strong>
                                </span>
                            </div>
                            
                            <div class="stat-change">
                                <span class="label">HP:</span>
                                <span class="change">
                                    <?php echo $hasilLatihan['data_sesi']['hp_sebelum']; ?> 
                                    → 
                                    <strong><?php echo $hasilLatihan['data_sesi']['hp_sesudah']; ?></strong>
                                </span>
                            </div>
                        </div>
                        
                        <div class="current-stats">
                            <p><strong>Statistik Saat Ini:</strong></p>
                            <p>Level: <?php echo $hasilLatihan['statistik_sekarang']['level']; ?></p>
                            <p>HP: <?php echo $hasilLatihan['statistik_sekarang']['hp']; ?>/<?php echo $hasilLatihan['statistik_sekarang']['hp_maksimum']; ?></p>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </main>
    </div>

    <script>
        // Update nilai intensitas saat slider digerakkan
        document.getElementById('intensitas').addEventListener('input', function() {
            document.getElementById('intensitas-value').textContent = this.value;
        });
    </script>
</body>
</html>
