<?php
session_start();
$username = $_SESSION['username'];
?>

<body>
<div class="wrapper">
    <?php
    include 'side-bar.php';
    ?>

    <?php
    if (isset($_POST['search']) && ($_POST['firstName'] || $_POST['lastName'])) {
        echo "<div id='content'>";

        $firstName = strtolower($_POST['firstName']);
        $lastName = strtolower($_POST['lastName']);
        $notFound = 0;
        $foundOne = false;

        $filename = "students.xml";
        $students = simplexml_load_file($filename) or die("Error: Cannot create object");
        foreach ($students->children() as $student) {
            if ($firstName && $lastName) {
                if ((strpos(strtolower($student->firstname), $firstName) !== false) && (strpos(strtolower($student->lastname), $lastName) !== false)) {
                    $foundOne = true;
                    if ($notFound === 0) {
                        $notFound = 1;
                    }
                }
            } elseif ($firstName) {
                if (strpos(strtolower($student->firstname), $firstName) !== false) {
                    $foundOne = true;
                    if ($notFound === 0) {
                        $notFound = 1;
                    }
                }
            } elseif ($lastName) {
                if (strpos(strtolower($student->lastname), $lastName) !== false) {
                    $foundOne = true;
                    if ($notFound === 0) {
                        $notFound = 1;
                    }
                }
            }
            if ($foundOne) {
                $foundOne = false;
                if ($notFound === 1) {
                    $notFound = 2;
                    ?>
                    <table class="table table-hover table-bordered">
                            <thead class="thead-dark">
                            <tr>
                                <th scope="col">Student ID</th>
                                <th scope="col">Last Name</th>
                                <th scope="col">First Name</th>
                                <th scope="col">Address</th>
                            </tr>
                            </thead>
                            <tbody>
                <?php }
                $studentID = $student->student_id;
                $email = $student->student_id["email"];
                $emailA = "<a href='mailto:" . $email . "'>$email</a>";
                $address = $student->address;
                $addressA = "<a href='student-map.php?studentID=" . $studentID . "'>$address</a>";
                echo "<tr><td>$studentID<br>($emailA)" . "</td><td>" . $student->lastname . "</td><td>" . $student->firstname . "</td><td>" . $addressA . "</td></tr>";
            }
        }

        if ($notFound === 0) {
            echo "<h1>No student found</h1>";
        } else {
            echo "</tbody>";
            echo "</table>";
        }
        echo "</div>";

    } else { ?>
        <div id="content">
            <?php
            $filename = "students.xml";
            $students = simplexml_load_file($filename) or die("Error: Cannot create object");
            ?>

            <div class="scrollable" style="height: 100%">
                <table class="table table-hover table-bordered">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">Student ID</th>
                        <th scope="col">Last Name</th>
                        <th scope="col">First Name</th>
                        <th scope="col">Address</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($students->children() as $student) {
                        $studentID = $student->student_id;
                        $email = $student->student_id["email"];
                        $emailA = "<a href='mailto:" . $email . "'>$email</a>";
                        $lastName = $student->lastname;
                        $firstName = $student->firstname;
                        $address = $student->address;
                        $addressA = "<a href='student-map.php?studentID=" . $studentID . "'>$address</a>";

                        echo "<tr><td>$studentID<br>($emailA)" . "</td><td>" . $lastName . "</td><td>" . $firstName . "</td><td>" . $addressA . "</td></tr>";
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>

    <?php } ?>
</div>

</body>
