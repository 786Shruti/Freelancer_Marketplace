<?php
session_start();
include "../includes/config.php";

// Define pagination variables
$limit = 5; // Number of jobs per page
$page = isset($_GET["page"]) ? (int)$_GET["page"] : 1;
$offset = ($page - 1) * $limit;

// Search functionality
$search = "";
$whereClause = "";
$params = [];

if (isset($_GET["search"]) && !empty(trim($_GET["search"]))) {
    $search = trim($_GET["search"]);
    $whereClause = "WHERE title LIKE ? OR description LIKE ?";
    $params = ["%$search%", "%$search%"];
}

// Get total job count for pagination
$stmt = $pdo->prepare("SELECT COUNT(*) FROM jobs $whereClause");
$stmt->execute($params);
$total_jobs = $stmt->fetchColumn();
$total_pages = ceil($total_jobs / $limit);

// Fetch jobs with pagination
$stmt = $pdo->prepare("SELECT * FROM jobs $whereClause LIMIT $limit OFFSET $offset");
$stmt->execute($params);
$jobs = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Browse Jobs</title>
    <style>
        /* General Page Styling */
        body {
            font-family: Arial, sans-serif;
            background: radial-gradient(circle, rgba(63,94,251,1) 0%, rgba(252,70,107,1) 100%);
            color: white;
            text-align: center;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        /* Job Listing Container */
        .job-container {
            background: rgba(0, 0, 0, 0.3);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
            width: 60%;
            max-width: 600px;
        }

        h1 {
            margin-bottom: 15px;
        }

        /* Search Form */
        .search-form {
            margin-bottom: 15px;
        }

        .search-form input {
            padding: 8px;
            width: 250px;
            border: none;
            border-radius: 5px;
        }

        .search-form button {
            padding: 8px 12px;
            background: #ffcc00;
            border: none;
            color: black;
            font-weight: bold;
            cursor: pointer;
            border-radius: 5px;
            margin-left: 5px;
        }

        .search-form button:hover {
            background: #e6b800;
        }

        /* Job List */
        ul {
            list-style-type: none;
            padding: 0;
        }

        li {
            background: rgba(255, 255, 255, 0.1);
            padding: 20px;
            margin: 10px 0;
            border-radius: 8px;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.2);
            text-align: left;
        }

        strong {
            font-size: 18px;
            color: #ffcc00;
        }

        p {
            color: #ddd;
            font-size: 16px;
            margin: 10px 0;
        }

        /* Apply Button */
        a {
            display: inline-block;
            text-decoration: none;
            color: white;
            background: rgba(255, 255, 255, 0.2);
            padding: 10px 15px;
            border-radius: 5px;
            transition: 0.3s;
            font-weight: bold;
        }

        a:hover {
            background: rgba(255, 255, 255, 0.5);
        }

        /* Pagination */
        .pagination {
            margin-top: 20px;
        }

        .pagination a {
            padding: 10px;
            margin: 5px;
            background-color: #ffcc00;
            color: black;
            text-decoration: none;
            border-radius: 5px;
        }

        .pagination a:hover {
            background-color: #e6b800;
        }

    </style>
</head>
<body>
    <h1>Available Jobs</h1>

    <!-- Search Form -->
    <form class="search-form" method="GET" action="">
        <input type="text" name="search" placeholder="Search by title or description" value="<?= htmlspecialchars($search) ?>">
        <button type="submit">Search</button>
    </form>

    <div class="job-container">
        <ul>
            <?php if (count($jobs) > 0): ?>
                <?php foreach ($jobs as $job): ?>
                    <li>
                        <strong><?= htmlspecialchars($job["title"]) ?></strong>
                        <p><?= htmlspecialchars($job["description"]) ?></p>
                        <a href="../applications/apply.php?job_id=<?= $job['id'] ?>">Apply</a>
                    </li>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No jobs found.</p>
            <?php endif; ?>
        </ul>

        <!-- Pagination -->
        <div class="pagination">
            <?php if ($page > 1): ?>
                <a href="?page=<?= $page - 1 ?>&search=<?= htmlspecialchars($search) ?>">Previous</a>
            <?php endif; ?>

            <?php if ($page < $total_pages): ?>
                <a href="?page=<?= $page + 1 ?>&search=<?= htmlspecialchars($search) ?>">Next</a>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
