<?php 
require 'db_connect.php';

try {
    // Fetch results from the database
    $sql = "SELECT * FROM results ORDER BY id DESC";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // If there are no results, initialize $results as an empty array
    if (!$results) {
        $results = [];
    }

} catch (Exception $e) {
    // If there's an error with the database query, set an error message
    $error_message = "Błąd: Nie udało się pobrać wyników. Spróbuj ponownie później.";
    $results = [];
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historia Gier Lotto</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap">
    <style>
        /* General Reset */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        /* Page styling */
        body {
            font-family: 'Roboto', sans-serif;
            background: url('hój.jpg') no-repeat center center fixed;
            background-size: cover;
            color: #333;
            display: flex;
            flex-direction: column;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
            position: relative;
        }

        /* Header and button styling */
        h1 {
            color: #1e88e5;
            margin-bottom: 20px;
            font-weight: 700;
            font-size: 2em;
            text-align: center;
        }

        a {
            display: inline-block;
            margin-bottom: 20px;
            padding: 10px 20px;
            background-color: #1e88e5;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            font-weight: 500;
            transition: background-color 0.3s;
        }

        a:hover {
            background-color: #1565c0;
        }

        /* Error message styling */
        .error {
            color: #d32f2f;
            font-weight: bold;
            margin-top: 10px;
            text-align: center;
        }

        /* Table styling */
        table {
            width: 90%;
            max-width: 800px;
            border-collapse: collapse;
            margin-top: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            background-color: #fff;
            border-radius: 8px;
            overflow: hidden;
        }

        th, td {
            padding: 12px;
            text-align: center;
            font-size: 1em;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #1e88e5;
            color: white;
            font-weight: 500;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #e3f2fd;
        }

        /* Last row styling */
        tbody tr:last-child td {
            border-bottom: none;
        }

        /* Message when no results are available */
        .no-results {
            margin-top: 20px;
            color: #555;
            font-size: 1.2em;
            font-weight: 500;
            text-align: center;
        }
    </style>
</head>
<body>

<a href="index.php">Wróć do gry</a>
<h1>Historia Gier Lotto</h1>

<?php if (isset($error_message)): ?>
    <div class="error"><?php echo htmlspecialchars($error_message); ?></div>
<?php elseif (empty($results)): ?>
    <div class="no-results">Brak dostępnych wyników do wyświetlenia.</div>
<?php else: ?>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Liczby Użytkownika</th>
                <th>Liczby Wylosowane</th>
                <th>Trafienia</th>
                <th>Wygrana</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($results as $result): ?>
                <tr>
                    <td><?php echo htmlspecialchars($result['id']); ?></td>
                    <td><?php echo htmlspecialchars($result['user_numbers']); ?></td>
                    <td><?php echo htmlspecialchars($result['random_numbers']); ?></td>
                    <td><?php echo htmlspecialchars($result['matches']); ?></td>
                    <td><?php echo htmlspecialchars($result['prize']); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>

</body>
</html>
