<?php
// Define users array (in-memory data)
$users = [
    ['id' => 1, 'name' => 'John Doe', 'email' => 'john.doe@example.com'],
    ['id' => 2, 'name' => 'Jane Doe', 'email' => 'jane.doe@example.com'],
    ['id' => 3, 'name' => 'Bob Smith', 'email' => 'bob.smith@example.com'],
    ['id' => 4, 'name' => 'Alice Johnson', 'email' => 'alice.johnson@example.com'],
];

// Get the column to sort by from the URL, default to 'id'
$sort_column = isset($_GET['sort_by']) ? $_GET['sort_by'] : 'id';

// Get the direction to sort (ascending or descending)
$sort_direction = isset($_GET['direction']) ? $_GET['direction'] : 'asc';

// Function to compare users based on the sorting column and direction
function compare_users($a, $b) {
    global $sort_column, $sort_direction;

    if ($a[$sort_column] == $b[$sort_column]) {
        return 0;
    }

    if ($sort_direction == 'asc') {
        return ($a[$sort_column] < $b[$sort_column]) ? -1 : 1;
    } else {
        return ($a[$sort_column] > $b[$sort_column]) ? -1 : 1;
    }
}

// Sort the users array based on the chosen column and direction
usort($users, 'compare_users');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Info Table</title>
    <style>
        table {
            width: 50%;
            margin: 20px auto;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px 12px;
            border: 1px solid #ddd;
            text-align: center;
        }
        th {
            cursor: pointer;
        }
        th:hover {
            background-color: #f1f1f1;
        }
        .sorted-asc::after {
            content: " ↑";
        }
        .sorted-desc::after {
            content: " ↓";
        }
    </style>
</head>
<body>

<h2 style="text-align: center;">User Information</h2>

<table>
    <thead>
        <tr>
            <th class="<?= ($sort_column == 'id' && $sort_direction == 'asc') ? 'sorted-asc' : (($sort_column == 'id' && $sort_direction == 'desc') ? 'sorted-desc' : '') ?>">
                <a href="?sort_by=id&direction=<?= ($sort_column == 'id' && $sort_direction == 'asc') ? 'desc' : 'asc' ?>">ID</a>
            </th>
            <th class="<?= ($sort_column == 'name' && $sort_direction == 'asc') ? 'sorted-asc' : (($sort_column == 'name' && $sort_direction == 'desc') ? 'sorted-desc' : '') ?>">
                <a href="?sort_by=name&direction=<?= ($sort_column == 'name' && $sort_direction == 'asc') ? 'desc' : 'asc' ?>">Name</a>
            </th>
            <th class="<?= ($sort_column == 'email' && $sort_direction == 'asc') ? 'sorted-asc' : (($sort_column == 'email' && $sort_direction == 'desc') ? 'sorted-desc' : '') ?>">
                <a href="?sort_by=email&direction=<?= ($sort_column == 'email' && $sort_direction == 'asc') ? 'desc' : 'asc' ?>">Email</a>
            </th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($users as $user): ?>
            <tr>
                <td><?= htmlspecialchars($user['id']) ?></td>
                <td><?= htmlspecialchars($user['name']) ?></td>
                <td><?= htmlspecialchars($user['email']) ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

</body>
</html>
