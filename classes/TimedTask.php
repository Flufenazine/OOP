<?php
include_once 'Task.php';
class TimedTask extends Task {
    private $reminder;

    public function __construct($text, $datetime = null, $reminder = null) {
        parent::__construct($text, $datetime);
        $this->reminder = $reminder;
    }

    public function getReminder() {
        return $this->reminder;
    }

    public function setReminder($reminder) {
        $this->reminder = $reminder;
    }

    // Override toArray method
    public function toArray() {
        $parentArray = parent::toArray();
        $parentArray['reminder'] = $this->reminder;
        return $parentArray;
    }
}
?>