<?php
session_start();
$username = $_SESSION['username'];
if ($_SESSION['logged_in'] != true) {
    $_SESSION['message'] = "Please login first before using.";
    header("location: index.php");
    die();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Student map</title>
    <?php include 'css/css.html'; ?>
</head>
<body>
<div class="wrapper">
    <?php
    include 'side-bar.php';
    ?>

    <div id="content">
        <?php
        $studentID = $_GET["studentID"];
        $foundOne = false;
        $foundStudent = null;

        $filename = "students.xml";
        $students = simplexml_load_file($filename) or die("Error: Cannot create object");
        foreach ($students->children() as $student) {
            if ($student->student_id == $studentID) {
                $foundOne = true;
                $foundStudent = $student;
                break;
            }
        }
        if ($foundOne == false) {
            echo "<h3 class='text-danger'> This student is not exist.</h3>";
        } else {
            ?>
            <div class="jumbotron button-no-radius">
                <h1 class="text-center">Details</h1>
                <hr>
                <ul>
                    <li>
                        Student ID: <?php echo "$foundStudent->student_id" ?>
                    </li>
                    <li>
                        Student name: <?php echo "$foundStudent->firstname" . " " . "$foundStudent->lastname" ?>
                    </li>
                    <li>
                        Email: <?php echo $foundStudent->student_id['email'] ?>
                    </li>
                    <li>
                        Address: <?php echo "$foundStudent->address" ?>
                    </li>
                </ul>

            </div>
            <?php
            $address = $foundStudent->address;
            echo "<iframe id='map' frameborder='0' src='https://maps.google.com/maps?f=q&source=s_q&hl=en&geocode=&q=" . str_replace(",", "", str_replace(" ", "+", $address)) . "&z=14&output=embed'></iframe>";
        }
        ?>
    </div>
</div>

</body>

</html>



