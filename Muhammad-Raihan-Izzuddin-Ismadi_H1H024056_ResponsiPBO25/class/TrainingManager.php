<?php
// File: classes/TrainingManager.php
class ManajerLatihan {
    private $pokemon;
    private $semuaSesiLatihan = [];

    public function __construct($pokemon) {
        $this->pokemon = $pokemon;
    }

    public function lakukanLatihan($jenisLatihan, $intensitas) {
        $sesi = $this->pokemon->latihan($jenisLatihan, $intensitas);
        $this->semuaSesiLatihan[] = $sesi;
        
        return [
            'data_sesi' => $sesi,
            'jurus_spesial' => $this->pokemon->gunakanJurusSpesial(),
            'statistik_sekarang' => [
                'level' => $this->pokemon->getLevel(),
                'hp' => $this->pokemon->getHp(),
                'hp_maksimum' => $this->pokemon->getHpMaksimum()
            ]
        ];
    }

    public function getLaporanLatihan() {
        $laporan = [
            'total_sesi' => count($this->semuaSesiLatihan),
            'sesi_per_jenis' => [],
            'perkembangan_level' => [],
            'perkembangan_hp' => []
        ];

        foreach($this->semuaSesiLatihan as $sesi) {
            // Kelompokkan berdasarkan jenis latihan
            if(!isset($laporan['sesi_per_jenis'][$sesi['jenis']])) {
                $laporan['sesi_per_jenis'][$sesi['jenis']] = 0;
            }
            $laporan['sesi_per_jenis'][$sesi['jenis']]++;

            // Lacak perkembangan
            $laporan['perkembangan_level'][] = $sesi['level_sesudah'];
            $laporan['perkembangan_hp'][] = $sesi['hp_sesudah'];
        }

        return $laporan;
    }

    public function getSemuaSesi() {
        return $this->semuaSesiLatihan;
    }
}
?>