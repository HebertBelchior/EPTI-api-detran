<?php
class Vehicle{
    public $id;
    public $plate;
    public $renavam;
    public $situation;
    public $rate;

    public function __construct($id, $plate, $renavam, $situation, $rate){
        $this->id = $id;
        $this->plate = $plate;
        $this->renavam = $renavam;
        $this->situation = $situation;
        $this->rate = $rate;
    }
}
?>