<?php

// implementasi oop contohnya class dan environment
class Task {
    private $text;
    private $datetime; // Tambahkan properti datetime
    // kita menggunakan encapsulation dengan cara membuatnya jadi private

    public function __construct($text, $datetime = null) {
        $this->text = $text;
        $this->datetime = $datetime;
    }

    public function toArray() {
        return [
            'text' => $this->text,
            'datetime' => $this->datetime,
            'completed' => false,
        ];
    }
}
?>
