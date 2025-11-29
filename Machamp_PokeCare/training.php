<?php
session_start();
require_once 'classes.php';

$history = $_SESSION['history'];
$sessions = $history->getSessions();
?>
<!DOCTYPE html>
<html>
<body>
    <h1>Riwayat Latihan</h1>
    
    <?php if (empty($sessions)): ?>
        <p>Belum ada sesi latihan.</p>
    <?php else: ?>
        <table border="1">
            <tr>
                <th>Waktu</th>
                <th>Jenis Latihan</th>
                <th>Intensitas</th>
                <th>Level (Before/After)</th>
                <th>HP (Before/After)</th>
            </tr>
            <?php foreach ($sessions as $session): ?>
            <tr>
                <td><?= $session->getData()['waktu'] ?></td>
                <td><?= $session->getData()['jenis_latihan'] ?></td>
                <td><?= $session->getData()['intensitas'] ?></td>
                <td><?= $session->getData()['level_before'] ?> → <?= $session->getData()['level_after'] ?></td>
                <td><?= $session->getData()['hp_before'] ?> → <?= $session->getData()['hp_after'] ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
    
    <div class="navigation">
        <a href="index.php"><button>Kembali ke Beranda</button></a>
        <a href="training.php"><button>Latihan Lagi</button></a>
    </div>
</body>
</html>