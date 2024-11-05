<?php 
require 'db_connect.php';
require 'Lotto.php';

// Function to calculate the prize based on the number of matches
function calculatePrize($numberOfMatches) {
    switch ($numberOfMatches) {
        case 5:
            return "1 000 000 zł";
        case 4:
            return "50 000 zł";
        case 3:
            return "5 000 zł";
        case 2:
            return "500 zł";
        default:
            return "0 zł";
    }
}

// Validate user numbers from the form
if (!isset($_POST['userNumbers']) || !is_array($_POST['userNumbers']) || count($_POST['userNumbers']) !== 6) {
    echo json_encode(["error" => "Musisz wprowadzić wszystkie 6 liczb."]);
    exit();
}

$userNumbers = $_POST['userNumbers'];

// Check for unique numbers
if (count($userNumbers) !== count(array_unique($userNumbers))) {
    echo json_encode(["error" => "Liczby muszą być unikalne!"]);
    exit();
}

// Validate the range of numbers
foreach ($userNumbers as $number) {
    if ($number < 1 || $number > 49) {
        echo json_encode(["error" => "Liczby muszą być w zakresie 1-49."]);
        exit();
    }
}

// Generate 6 unique random numbers
$randomNumbers = [];
while (count($randomNumbers) < 6) {
    $number = rand(1, 49);
    if (!in_array($number, $randomNumbers)) {
        $randomNumbers[] = $number;
    }
}

// Compare numbers and find matches
$matches = array_intersect($userNumbers, $randomNumbers);
$numberOfMatches = count($matches);

// Calculate the prize amount
$prize = calculatePrize($numberOfMatches);

// Convert arrays of numbers to strings
$userNumbersStr = implode(", ", $userNumbers);
$randomNumbersStr = implode(", ", $randomNumbers);

// Prepare SQL query
$sql = "INSERT INTO results (user_numbers, random_numbers, matches, prize) VALUES (:user_numbers, :random_numbers, :matches, :prize)";
$stmt = $pdo->prepare($sql);

// Bind parameters
$stmt->bindParam(':user_numbers', $userNumbersStr);
$stmt->bindParam(':random_numbers', $randomNumbersStr);
$stmt->bindParam(':matches', $numberOfMatches, PDO::PARAM_INT);
$stmt->bindParam(':prize', $prize);

// Execute the query
if ($stmt->execute()) {
    // Return the results as JSON
    echo json_encode([
        "userNumbers" => $userNumbersStr,
        "randomNumbers" => $randomNumbersStr,
        "matches" => $numberOfMatches,
        "prize" => $prize
    ]);
} else {
    // Handle error if the query fails
    echo json_encode(["error" => "Wystąpił błąd podczas zapisywania wyników."]);
}
?>
