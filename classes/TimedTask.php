<?php
include_once 'Task.php';

//dibawah ini adalah salah satu penggunaan dari inhertitance dengan ada nya extends
class TimedTask extends Task {
    private $reminder;

    // ini bagian construct
    public function __construct($text, $datetime = null, $reminder = null) {
        parent::__construct($text, $datetime);  // manggil konstruktor (chaining construct(anak manggil induk dii task)) kelas dri induk Task.php
        $this->reminder = $reminder; 
        
    } // ^^ yang diatas penambahan kelas anak
    public function getReminder() {
        return $this->reminder;
    } //ini penerapan getter

    public function setReminder($reminder) {
        $this->reminder = $reminder;
    } // ini penerapan setter

    // Overriding ni boss toArray method
    public function toArray() {
        $parentArray = parent::toArray();   // yang ini sebenernya manggil metode dari file sebelah
        $parentArray['reminder'] = $this->reminder;  // mengubah perilaku metode toArray di file Task.php
        return $parentArray;
    }
}
?>