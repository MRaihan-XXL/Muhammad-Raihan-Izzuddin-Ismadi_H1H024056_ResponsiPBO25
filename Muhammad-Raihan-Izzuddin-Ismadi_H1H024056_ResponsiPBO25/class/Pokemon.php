<?php
// File: classes/Pokemon.php
abstract class Pokemon {
    protected $nama;
    protected $tipe;
    protected $level;
    protected $hp;
    protected $hpMaksimum;
    protected $jurusSpesial;

    public function __construct($nama, $tipe, $level, $hp, $jurusSpesial) {
        $this->nama = $nama;
        $this->tipe = $tipe;
        $this->level = $level;
        $this->hp = $hp;
        $this->hpMaksimum = $hp;
        $this->jurusSpesial = $jurusSpesial;
    }

    // Method abstract yang harus diimplementasikan subclass
    abstract public function latihan($jenisLatihan, $intensitas);
    abstract public function getEfektivitasLatihan();

    // Getter methods
    public function getNama() { return $this->nama; }
    public function getTipe() { return $this->tipe; }
    public function getLevel() { return $this->level; }
    public function getHp() { return $this->hp; }
    public function getHpMaksimum() { return $this->hpMaksimum; }
    public function getJurusSpesial() { return $this->jurusSpesial; }

    // Setter methods  
    public function setLevel($level) { $this->level = $level; }
    public function setHp($hp) { 
        $this->hp = $hp;
        // Pastikan HP tidak melebihi maksimum
        if ($this->hp > $this->hpMaksimum) {
            $this->hp = $this->hpMaksimum;
        }
    }
}
?>