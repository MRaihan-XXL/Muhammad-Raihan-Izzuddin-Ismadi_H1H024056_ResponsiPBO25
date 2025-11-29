<?php
// ABSTRACT CLASS - ABSTRACTION
abstract class Pokemon {
    protected $nama;
    protected $tipe;
    protected $level;
    protected $hp;
    protected $attack;
    protected $defense;
    protected $speed;
    protected $energy;
    
    // Abstract method - harus diimplementasikan subclass
    abstract public function train($jenis, $intensitas);
    
    // Constructor
    public function __construct($nama, $tipe, $level, $hp, $attack, $defense, $speed) {
        $this->nama = $nama;
        $this->tipe = $tipe;
        $this->level = $level;
        $this->hp = $hp;
        $this->attack = $attack;
        $this->defense = $defense;
        $this->speed = $speed;
        $this->energy = 100;
    }
    
    // ENCAPSULATION - Getter methods
    public function getNama() { return $this->nama; }
    public function getTipe() { return $this->tipe; }
    public function getLevel() { return $this->level; }
    public function getHp() { return $this->hp; }
    public function getAttack() { return $this->attack; }
    public function getDefense() { return $this->defense; }
    public function getSpeed() { return $this->speed; }
    public function getEnergy() { return $this->energy; }
    
    public function useEnergy($amount) {
        $this->energy -= $amount;
        if ($this->energy < 0) $this->energy = 0;
    }
    
    public function restoreEnergy() {
        $this->energy = 100;
    }
}

// INHERITANCE - Class Machamp mewarisi Pokemon
class Machamp extends Pokemon {
    public function __construct() {
        parent::__construct("Machamp", "Fighting", 1, 300, 12, 8, 10);
    }
    
    // POLYMORPHISM - Override method train
    public function train($jenis, $intensitas) {
        if ($this->energy < 20) {
            return ["error" => "Energy tidak cukup! Minimal 20 energy."];
        }
        
        $this->useEnergy(20);
        $boost = $intensitas * 0.5;
        
        switch($jenis) {
            case 'Attack':
                $this->attack += $boost;
                break;
            case 'Defense':
                $this->defense += $boost;
                break;
            case 'Speed':
                $this->speed += $boost;
                break;
        }
        
        $this->level += 0.1;
        $this->hp += $intensitas * 2;
        
        return [
            'success' => true,
            'jenis' => $jenis,
            'boost' => $boost,
            'energy_used' => 20,
            'new_energy' => $this->energy
        ];
    }
    
    public function getStats() {
        return [
            'HP' => $this->hp,
            'ATK' => $this->attack,
            'DEF' => $this->defense,
            'SPD' => $this->speed,
            'Energy' => $this->energy
        ];
    }
}

// Class untuk menangani riwayat training
class TrainingHistory {
    private $history = [];
    
    public function addSession($jenis, $intensitas, $result) {
        $this->history[] = [
            'waktu' => date('Y-m-d H:i:s'),
            'jenis' => $jenis,
            'intensitas' => $intensitas,
            'result' => $result
        ];
        
        // Simpan ke session
        $_SESSION['training_history'] = $this->history;
    }
    
    public function getHistory() {
        return isset($_SESSION['training_history']) ? $_SESSION['training_history'] : [];
    }
    
    public function clearHistory() {
        $this->history = [];
        unset($_SESSION['training_history']);
    }
}
?>
