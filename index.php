<?php include "db.php"; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Student Masterfile</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h2>Student Masterfile</h2>

<a href="add.php" class="btn">+ Add Student</a>

<table>
    <tr>
        <th>ID</th>
        <th>Fullname</th>
        <th>Age</th>
        <th>Course</th>
        <th>Actions</th>
    </tr>

<?php
$stmt = $pdo->query("SELECT * FROM students ORDER BY id DESC");
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)):
?>
<tr>
    <td><?= $row["id"] ?></td>
    <td><?= htmlspecialchars($row["fullname"]) ?></td>
    <td><?= $row["age"] ?></td>
    <td><?= htmlspecialchars($row["course"]) ?></td>
    <td>
        <a href="edit.php?id=<?= $row['id'] ?>">Edit</a> | 
        <a onclick="return confirm('Delete?')" href="delete.php?id=<?= $row['id'] ?>">Delete</a>
    </td>
</tr>
<?php endwhile; ?>

</table>

</body>
</html>
