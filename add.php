<?php include "db.php";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $stmt = $pdo->prepare("INSERT INTO students(fullname, age, course) VALUES (?, ?, ?)");
    $stmt->execute([$_POST["fullname"], $_POST["age"], $_POST["course"]]);
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<body>
<h2>Add Student</h2>
<form method="POST">
    Fullname: <input name="fullname" required><br>
    Age: <input type="number" name="age" required><br>
    Course: <input name="course" required><br>
    <button type="submit">Save</button>
</form>
</body>
</html>

