<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upoload</title>
</head>

<body>
    <?php require_once './template/header.php'; ?>
    <main>
        <?php require_once './template/sidebar.php'; ?>

        <div class="main">
            <form action="" class="d-flex justify-content-center mb-5 flex-column align-items-center">
                <input type="text" class="custom-input-feild" name="studentID" placeholder="Student ID">
                <input type="text" class="custom-input-feild" name="educational_year" placeholder="Educational year">
                <input type="text" class="custom-input-feild" name="educational_semester" placeholder="Educational semester">
                <input type="text" class="custom-input-feild" name="enrolled_course" placeholder="Enrolled course">
                <input type="text" class="custom-input-feild" name="enrolled_section" placeholder="Enrolled section">
                <input type="text" class="custom-input-feild" name="mark_1" placeholder="Mark 1">
                <input type="text" class="custom-input-feild" name="mark_2" placeholder="Mark 2">
                <input type="text" class="custom-input-feild" name="mark_3" placeholder="Mark 3">
                <input type="text" class="custom-input-feild" name="mark_4" placeholder="Mark 4">
                <input type="text" class="custom-input-feild" name="mark_5" placeholder="Mark 5">
                <input type="text" class="custom-input-feild" name="mark_6" placeholder="Mark 6">
                <button type="submit" class="custom-btn">Submit</button>
            </form>
        </div>
    </main>
</body>

</html>