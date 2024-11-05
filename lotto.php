<?php
class Lotto {
    private $min;
    private $max;
    private $quantity;

    public function __construct($min = 1, $max = 49, $quantity = 6) {
        $this->min = $min;
        $this->max = $max;
        $this->quantity = $quantity;
    }

    public function generateNumbers() {
        $numbers = [];
        while (count($numbers) < $this->quantity) {
            $number = rand($this->min, $this->max);
            if (!in_array($number, $numbers)) {
                $numbers[] = $number;
            }
        }
        return $numbers;
    }

    public function checkMatches($userNumbers, $randomNumbers) {
        return array_intersect($userNumbers, $randomNumbers);
    }
}
?>
