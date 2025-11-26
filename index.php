<?php include "db.php"; ?>

<?php
/**
 * Kinukuha ang subdomain mula sa buong hostname.
 * Halimbawa: test.pampangmarket.com -> test
 * shop.pampangmarket.com -> shop
 * pampangmarket.com -> NULL
 * www.pampangmarket.com -> NULL (o 'www' kung gusto mo)
 */
function get_subdomain_name() {
    // 1. Kumuha ng Hostname
    $host = $_SERVER['HTTP_HOST'] ?? $_SERVER['SERVER_NAME'] ?? '';
    if (empty($host)) {
        return null;
    }

    // 2. Tukuyin ang Base Domain
    $base_domain = 'pampangmarket.com'; 

    // 3. I-check kung naglalaman ang host ng base domain
    if (strpos($host, $base_domain) === false) {
        return null;
    }

    // 4. Tanggalin ang base domain mula sa host
    $subdomain_part = str_replace('.' . $base_domain, '', $host);

    // 5. I-check kung may natira pang subdomain
    if ($subdomain_part === $host || $subdomain_part === '') {
        return null;
    }

    // 6. Linisin at Ibalik ang Subdomain
    $subdomain = str_replace('www.', '', $subdomain_part);

    if ($subdomain === 'www') {
        return null;
    }

    $subdomain = trim($subdomain, '.');

    return $subdomain;
}

// EXAMPLE USAGE:
$current_subdomain = get_subdomain_name();

// *** DITO GINAMIT ANG ISANG VARIABLE PARA SA MESSAGE SA HALIP NA ECHO AGAD ***
if ($current_subdomain) {
    $domain_message = "Ang kasalukuyang subdomain ay: <strong>" . htmlspecialchars($current_subdomain) . "</strong>";
    
    // Halimbawa ng paggamit para sa routing:
    if ($current_subdomain === 'admin') {
        // include 'admin/index.php';
    } elseif ($current_subdomain === 'vendor') {
        // include 'vendor/index.php';
    } else {
        // include 'storefront.php';
    }

} else {
    $domain_message = "Ikaw ay nasa <strong>root domain</strong> (pampangmarket.com).";
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Student Masterfile - <?= $current_subdomain ? ucfirst($current_subdomain) : 'Main' ?></title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    </head>
<body>

<div class="container mt-5">

    <div class="alert alert-info" role="alert">
        <?= $domain_message ?>
    </div>
    
    <h2 class="mb-4">Student Masterfile</h2>

    <div class="mb-3">
        <a href="add.php" class="btn btn-primary">+ Add Student</a>
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-hover table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Fullname</th>
                    <th>Age</th>
                    <th>Course</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Tiyakin na ang $pdo variable ay properly defined sa db.php
                // at naka-handle ang error kung hindi konektado.
                if (isset($pdo)): 
                    $stmt = $pdo->query("SELECT * FROM students ORDER BY id DESC");
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)):
                ?>
                <tr>
                    <td><?= $row["id"] ?></td>
                    <td><?= htmlspecialchars($row["fullname"]) ?></td>
                    <td><?= $row["age"] ?></td>
                    <td><?= htmlspecialchars($row["course"]) ?></td>
                    <td>
                        <a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                        <a onclick="return confirm('Sigurado ka bang buburahin mo ito?')" href="delete.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-danger">Delete</a>
                    </td>
                </tr>
                <?php 
                    endwhile; 
                else: 
                ?>
                <tr>
                    <td colspan="5" class="text-center text-danger">Database connection (PDO) not found or failed.</td>
                </tr>
                <?php 
                endif; 
                ?>
            </tbody>
        </table>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>
