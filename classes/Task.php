<?php

class Task {
    private $text;
    private $datetime; // Tambahkan properti datetime

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
