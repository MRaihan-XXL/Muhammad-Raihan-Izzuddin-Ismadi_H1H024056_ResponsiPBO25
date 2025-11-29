<?php
// File: classes/Machamp.php
require_once 'Pokemon.php';

class Machamp extends Pokemon
{
    private $riwayatLatihan = [];

    public function __construct($level = 50, $hp = 90)
    {
        parent::__construct("Machamp", "Fighting", $level, $hp, "Pukulan Dinamis");
    }

    public function latihan($jenisLatihan, $intensitas)
    {
        $levelSebelum = $this->level;
        $hpSebelum = $this->hp;

        // Efek latihan berdasarkan tipe Fighting
        switch ($jenisLatihan) {
            case 'Attack':
                $this->level += round($intensitas * 0.8); // Fighting type sangat efektif untuk Attack
                $this->hp += round($intensitas * 1.5);
                break;
            case 'Defense':
                $this->level += round($intensitas * 0.6);
                $this->hp += round($intensitas * 2.0);
                break;
            case 'Speed':
                $this->level += round($intensitas * 0.4); // Fighting type kurang efektif untuk Speed
                $this->hp += round($intensitas * 1.0);
                break;
        }

        // Update HP maksimum jika perlu
        $this->hpMaksimum = max($this->hpMaksimum, $this->hp);

        // Simpan riwayat latihan
        $sesiLatihan = [
            'jenis' => $jenisLatihan,
            'intensitas' => $intensitas,
            'waktu' => date('d-m-Y H:i:s'),
            'level_sebelum' => $levelSebelum,
            'level_sesudah' => $this->level,
            'hp_sebelum' => $hpSebelum,
            'hp_sesudah' => $this->hp
        ];

        $this->riwayatLatihan[] = $sesiLatihan;
        return $sesiLatihan;
    }

    public function getEfektivitasLatihan()
    {
        // Fighting type paling efektif untuk Attack training
        return [
            'Attack' => 0.8,
            'Defense' => 0.6,
            'Speed' => 0.4
        ];
    }

    public function getRiwayatLatihan()
    {
        return $this->riwayatLatihan;
    }

    // Method khusus Machamp
    public function gunakanJurusSpesial()
    {
        return $this->nama . " menggunakan jurus " . $this->jurusSpesial . "! 💥";
    }
}
