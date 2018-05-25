<?php
session_start();
$username = $_SESSION['username'];
if ($_SESSION['logged_in'] != true) {
    $_SESSION['message'] = "Please login first before using.";
    header("location: index.php");
    die();
}

if ($_SESSION['logged_in'] == true && $_SESSION['is_admin'] == false) {
    header("location: index.php");
    die();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add new student</title>
    <?php include 'css/css.html'; ?>
</head>

<body>
<div class="wrapper">
    <?php
    include 'side-bar.php';
    ?>

    <div id="content">
        <h1>Add A New Student</h1>
        <?php
        function test_input($data)
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = strip_tags($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        if (isset($_POST['submit']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
            $studentID = test_input($_POST["inputID"]);
            $studentEmail = test_input($_POST["inputEmail"]);
            $studentLastName = test_input($_POST["inputLastName"]);
            $studentFirstName = test_input($_POST["inputFirstName"]);
            $studentAddress = test_input($_POST["inputAddress"]);

            $error = false;

            $filename = "students.xml";
            $students = simplexml_load_file($filename) or die("Error: Cannot create object");
            foreach ($students->children() as $student) {
                if ($student->student_id == $studentID) {
                    $error = true;
                    break;
                }
            }

            if ($error) {
                echo "<h3 class='text-danger'>Error! Student ID must be unique - Try another ID.</h3>";
                $error = false;
            } else {
                $entry = $students->addChild('student');
                $entry->addChild('student_id', $studentID)->addAttribute('email', $studentEmail);
                $entry->addChild('lastname', $studentLastName);
                $entry->addChild('firstname', $studentFirstName);
                $entry->addChild('address', $studentAddress);
                $students->asXML('students.xml');
                echo "<h3 class='text-success'>The new student has been added successfully.</h3>";
            }
            $_POST = array();
        }
        ?>
        <form action="add-student.php" method="post">
            <div class="form-group row">
                <label for="inputID" class="col-sm-2 col-form-label">Student ID</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control button-no-radius" id="inputID" name="inputID" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="inputID" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-4">
                    <input type="email" class="form-control button-no-radius" id="inputEmail" name="inputEmail"
                           required>
                </div>
            </div>
            <div class="form-group row">
                <label for="inputID" class="col-sm-2 col-form-label">First Name</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control button-no-radius" id="inputFirstName" name="inputFirstName"
                           required>
                </div>
            </div>
            <div class="form-group row">
                <label for="inputID" class="col-sm-2 col-form-label">Last Name</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control button-no-radius" id="inputLastName" name="inputLastName"
                           required>
                </div>
            </div>
            <div class="form-group row">
                <label for="inputID" class="col-sm-2 col-form-label">Address</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control button-no-radius" id="inputAddress" name="inputAddress"
                           required>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-sm-2">
                </div>
                <div class="col-sm-10">
                    <button class="btn btn-success button-no-radius" name="submit"><i class="fas fa-plus"></i> Add
                        student
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

</body>

</html>
