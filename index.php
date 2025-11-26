<?php include "db.php"; ?>

<?php
echo "hello world";
/**
 * Kinukuha ang subdomain mula sa buong hostname.
 * Halimbawa: test.pampangmarket.com -> test
 * shop.pampangmarket.com -> shop
 * pampangmarket.com -> NULL
 * www.pampangmarket.com -> NULL (o 'www' kung gusto mo)
 */
function get_subdomain_name() {
    // 1. Kumuha ng Hostname
    // Gamitin ang HTTP_HOST dahil ito ang actual na ipinasa ng browser.
    $host = $_SERVER['HTTP_HOST'] ?? $_SERVER['SERVER_NAME'] ?? '';

    if (empty($host)) {
        return null;
    }

    // 2. Tukuyin ang Base Domain
    // Palitan ng sarili mong domain kung sakaling magbago ito.
    $base_domain = 'pampangmarket.com'; 

    // 3. I-check kung naglalaman ang host ng base domain
    if (strpos($host, $base_domain) === false) {
        // Ang hostname ay hindi naglalaman ng base domain (error or ibang domain)
        return null;
    }

    // 4. Tanggalin ang base domain mula sa host
    // (example.pampangmarket.com -> example.)
    $subdomain_part = str_replace('.' . $base_domain, '', $host);

    // 5. I-check kung may natira pang subdomain
    if ($subdomain_part === $host || $subdomain_part === '') {
        // Walang subdomain (ito ay pampangmarket.com)
        return null;
    }

    // 6. Linisin at Ibalik ang Subdomain
    // Tanggalin ang "www." kung ang natira lang ay "www" (para sa www.pampangmarket.com)
    $subdomain = str_replace('www.', '', $subdomain_part);

    // Kung ang natira ay "www", ibalik ang NULL para hindi ito ituring na subdomain.
    if ($subdomain === 'www') {
        return null;
    }

    // Kung ang natira ay may tuldok pa sa dulo, tanggalin (just in case)
    $subdomain = trim($subdomain, '.');

    return $subdomain;
}

// EXAMPLE USAGE:

$current_subdomain = get_subdomain_name();

if ($current_subdomain) {
    echo "Ang kasalukuyang subdomain ay: **" . htmlspecialchars($current_subdomain) . "**";
    
    // Halimbawa ng paggamit para sa routing:
    if ($current_subdomain === 'admin') {
        // Load admin panel
        // include 'admin/index.php';
    } elseif ($current_subdomain === 'vendor') {
        // Load vendor portal
        // include 'vendor/index.php';
    } else {
        // Load user storefront for this subdomain/shop
        // include 'storefront.php';
    }

} else {
    echo "Ikaw ay nasa **root domain** (pampangmarket.com).";
}

?>
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



