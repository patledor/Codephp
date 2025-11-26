<?php 
include "db.php";

$id = $_GET["id"];
$stmt = $pdo->prepare("SELECT * FROM students WHERE id = ?");
$stmt->execute([$id]);
$student = $stmt->fetch();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $stmt = $pdo->prepare("UPDATE students SET fullname=?, age=?, course=? WHERE id=?");
    $stmt->execute([$_POST["fullname"], $_POST["age"], $_POST["course"], $id]);
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<body>
<h2>Edit Student</h2>
<form method="POST">
    Fullname: <input name="fullname" value="<?= $student['fullname'] ?>"><br>
    Age: <input type="number" name="age" value="<?= $student['age'] ?>"><br>
    Course: <input name="course" value="<?= $student['course'] ?>"><br>
    <button type="submit">Update</button>
</form>
</body>
</html>
