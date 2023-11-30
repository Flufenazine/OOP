<?php
include_once 'classes/TimedTask.php';

session_start();

$tasks = [];

if (file_exists('tasks.json')) {
    $tasks = json_decode(file_get_contents('tasks.json'), true);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['addTask'])) {
        $taskText = $_POST['taskText'];
        $taskDateTime = $_POST['taskDateTime'];
        $taskReminder = $_POST['taskReminder']; // Tambahkan input reminder

        // Validasi tanggal dan waktu
        if (empty($taskDateTime)) {
            $taskDateTime = null;
        } else {
            $taskDateTime = date('Y-m-d H:i:s', strtotime($taskDateTime));
        }

        $task = new TimedTask ($taskText, $taskDateTime, $taskReminder);
        $tasks[] = $task->toArray();
        file_put_contents('tasks.json', json_encode($tasks, JSON_PRETTY_PRINT));
    } elseif (isset($_POST['deleteTask'])) {
        $taskId = $_POST['taskId'];
        unset($tasks[$taskId]);
        file_put_contents('tasks.json', json_encode(array_values($tasks), JSON_PRETTY_PRINT));
    } elseif (isset($_POST['toggleTask'])) {
        $taskId = $_POST['taskId'];
        if (isset($tasks[$taskId])) {
            $tasks[$taskId]['completed'] = !$tasks[$taskId]['completed'];
            file_put_contents('tasks.json', json_encode(array_values($tasks), JSON_PRETTY_PRINT));
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Simple To-Do List</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<h1>Simple To-Do List</h1>

<button id="themeToggle">Toggle Theme</button>

<form method="post">
    <input type="text" name="taskText" placeholder="Add a new task" required>
    <input type="datetime-local" name="taskDateTime">
    <button type="submit" name="addTask">Add</button>
</form>

<ul id="taskList">
    <?php foreach ($tasks as $key => $task) : ?>
        <li>
            <input type="checkbox" id="task_<?php echo $key; ?>" data-task-id="<?php echo $key; ?>" <?php echo isset($task['completed']) && $task['completed'] ? 'checked' : ''; ?>>
            <label for="task_<?php echo $key; ?>">
                <?php echo $task['text']; ?>
            </label>
            <span class="task-datetime"><?php echo isset($task['datetime']) ? date('d/m/Y H:i', strtotime($task['datetime'])) : ''; ?></span>
            <form method="post" style="display:inline;">
                <input type="hidden" name="taskId" value="<?php echo $key; ?>">
                <button type="submit" name="deleteTask">Delete</button>
            </form>
        </li>
    <?php endforeach; ?>
</ul>

<div id="credits">
    <p>Author by Muhammad Alfarizi Habibullah (49) & Muhammad Azwar Firmansyah (51)</p>
</div>

<script src="js/script.js"></script>
</body>
</html>