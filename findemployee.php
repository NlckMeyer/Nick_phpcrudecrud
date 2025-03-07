<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Find Employee</title>
</head>

<body>
    <h2>Find an Employee Record</h2>

    <!-- Employee Number Input Form -->
    <form action="findemployee.php" method="get">
        <label for="emp_no">Employee Number:</label>
        <input type="text" id="emp_no" name="emp_no">
        <input type="submit" value="Search">
    </form>

    <?php
        // Access credentials for database connection
        include 'credentials.php';

        // Create MySQL connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection success
        if ($conn->connect_error) {
            die("MySQL Connection Failed: " . $conn->connect_error);
        }

        echo "MySQL Connection Succeeded<br><br>";

        // Check if emp_no is set in the GET request
        if (isset($_GET['emp_no']) && !empty($_GET['emp_no'])) {
            $emp_no = $_GET['emp_no'];

            // SQL query to fetch employee details based on emp_no
            $sql = "SELECT * FROM employees WHERE emp_no = '$emp_no'";
            $result = $conn->query($sql);

            // If records are found, display them
            if ($result->num_rows > 0) {
                // Loop through the result and display employee details
                while($row = $result->fetch_assoc()) {
                    echo "Employee Number: " . htmlspecialchars($row['emp_no']) . "<br>";
                    echo "First Name: " . htmlspecialchars($row['first_name']) . "<br>";
                    echo "Last Name: " . htmlspecialchars($row['last_name']) . "<br>";
                    echo "Gender: " . htmlspecialchars($row['gender']) . "<br>";
                    echo "Hire Date: " . htmlspecialchars($row['hire_date']) . "<br>";
                    echo "Birth Date: " . htmlspecialchars($row['birth_date']) . "<br>";
                }
            } else {
                // If no records are found, show this message
                echo "No records found.";
            }
        } else {
            // If emp_no is not provided, prompt the user to enter a valid number
            echo "Please enter a valid employee number.";
        }

        // Close database connection
        $conn->close();
    ?>
</body>
</html>
