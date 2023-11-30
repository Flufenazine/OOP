document.addEventListener("DOMContentLoaded", function () {
    const form = document.querySelector("form");
    const taskList = document.getElementById("taskList");
    const themeToggle = document.getElementById("themeToggle");
    const body = document.body;

    themeToggle.addEventListener("click", function () {
        // Toggle class 'dark-mode' pada body
        body.classList.toggle("dark-mode");

        // Simpan preferensi tema pada localStorage
        const isDarkMode = body.classList.contains("dark-mode");
        localStorage.setItem("darkMode", isDarkMode);
    });

    // Periksa localStorage untuk tema yang disimpan sebelumnya
    const savedDarkMode = localStorage.getItem("darkMode");
    if (savedDarkMode === "true") {
        body.classList.add("dark-mode");
    }

    form.addEventListener("submit", function (event) {
        event.preventDefault();
        const taskText = document.querySelector("[name='taskText']").value;
        const taskDateTime = document.querySelector("[name='taskDateTime']").value;

        if (taskText.trim() === "") {
            alert("Silakan masukkan teks tugas!");
            return;
        }

        const xhr = new XMLHttpRequest();
        xhr.open("POST", "index.php", true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                location.reload();
            }
        };

        const params = "addTask=true&taskText=" + encodeURIComponent(taskText) + "&taskDateTime=" + encodeURIComponent(taskDateTime);
        xhr.send(params);
    });

    taskList.addEventListener("click", function (event) {
        const target = event.target;

        if (target.type === "checkbox") {
            const taskId = target.getAttribute("data-task-id");
            const xhr = new XMLHttpRequest();
            xhr.open("POST", "index.php", true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    location.reload();
                }
            };

            const params = "toggleTask=true&taskId=" + encodeURIComponent(taskId);
            xhr.send(params);
        }
    });
});
