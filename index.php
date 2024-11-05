<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Symulator Lotto</title>
    <style>
        /* Stylizacja ogólna strony */
        body {
            font-family: 'Roboto', sans-serif;
            background: url('pit.jpg') no-repeat center center fixed;
            background-size: cover;
            color: #333;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            position: relative;
        }

        
        /* Stylizacja nagłówka */
        h1 {
            color: #1e88e5;
            margin-bottom: 20px;
        }

        /* Kontener formularza */
        .container {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            max-width: 450px;
            width: 100%;
            text-align: center;
        }

        /* Stylizacja grup formularza */
        .form-group {
            margin-bottom: 15px;
        }

        /* Etykieta pól formularza */
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #555;
        }

        /* Stylizacja pól wejściowych */
        input[type="number"] {
            width: calc(100% - 20px);
            padding: 10px;
            margin-bottom: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            text-align: center;
            font-size: 16px;
        }

        /* Stylizacja przycisku */
        input[type="submit"] {
            background-color: #1e88e5;
            color: #fff;
            border: none;
            border-radius: 4px;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #1565c0;
        }

        /* Link do historii gier */
        .history-link {
            margin-top: 20px;
            display: block;
            color: #1e88e5;
            text-decoration: none;
            font-weight: bold;
        }

        .history-link:hover {
            text-decoration: underline;
        }

        /* Sekcja wyników */
        .result {
            background-color: #e3f2fd;
            border: 1px solid #bbdefb;
            padding: 15px;
            margin-top: 20px;
            border-radius: 8px;
            color: #0d47a1;
            font-weight: bold;
        }

        /* Stylizacja komunikatu o błędzie */
        .error {
            color: #d32f2f;
            font-weight: bold;
            margin-top: 10px;
        }

        .result p {
            margin: 10px 0;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Symulator Lotto</h1>
    
    <?php if (isset($_GET['error'])): ?>
        <div class="error"><?php echo htmlspecialchars($_GET['error']); ?></div>
    <?php endif; ?>
    
    <form action="process.php" method="post">
        <div class="form-group">
            <label for="userNumbers">Wybierz 6 liczb (1-49):</label>
            <?php for ($i = 1; $i <= 6; $i++): ?>
                <input type="number" name="userNumbers[]" min="1" max="49" required>
            <?php endfor; ?>
        </div>
        
        <input type="submit" value="Zagraj">
    </form>

    <div id="result"></div>
    <a class="history-link" href="results.php">Zobacz historię gier</a>

</div>
<script src="script.js"></script>
</body>
</html>
