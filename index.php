<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Quiz Application</title>
    <link rel="stylesheet" href="style.css">

</head>
<body>
<h1>Quiz Application</h1>
    <div class="form-container">
        <form method="post">
            <?php
            $answers = [
                "q1" => "Extern",
                "q2" => "Both 1 & 2",
                "q3" => "Hypertext Preprocessor",
                "q4" => ".php"
            ];

            $questions = [
                "q1" => "1. Which of the following is not a variable scope in PHP?",
                "q2" => "2. Which of the following is used to display the output in PHP?",
                "q3" => "3. PHP stands for -",
                "q4" => "4. Which of the following is the default file extension of PHP files?"
            ];

            $options = [
                "q1" => ["Extern", "Local", "Static", "Global"],
                "q2" => ["print", "echo", "write", "Both 1 & 2"],
                "q3" => ["Pretext Hypertext Preprocessor", "Personal Home Processor", "Hypertext Preprocessor", "one of the above"],
                "q4" => [".php", ".ph", ".xml", ".html"]
            ];

            $marks = [
                "q1" => 1,
                "q2" => 2,
                "q3" => 1,
                "q4" => 1
            ];

            $totalScore = 0;

            foreach ($questions as $key => $question) {
                echo "<div class='question'>";
                echo "<p>$question</p>";
                foreach ($options[$key] as $option) {
                    $isChecked = isset($_POST[$key]) && $_POST[$key] === $option ? "checked" : "";
                    echo "<div class='option'><input type='radio' name='$key' value='$option' $isChecked> <label>$option</label></div>";
                }

                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    if (isset($_POST[$key])) {
                        if ($_POST[$key] === $answers[$key]) {
                            echo "<span class='feedback correct'>Correct! (+{$marks[$key]} points)</span>";
                            $totalScore += $marks[$key];
                        } else {
                            echo "<span class='feedback'>Incorrect! Correct answer: " . $answers[$key] . "</span>";
                        }
                    } else {
                        echo "<span class='feedback'>Please select an answer.</span>";
                    }
                }

                echo "</div>";
            }

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                echo "<div class='score'>Your Total Score: $totalScore / " . array_sum($marks) . "</div>";
            }
            ?>
            <input type="submit" value="Submit">
        </form>
    </div>
</body>
</html>