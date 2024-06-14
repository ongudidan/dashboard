<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require '../modelClass.php';

if (isset($_POST['submit'])) {
    // Get user input from the form
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $physical_address = $_POST['physical_address'];

    $logo = $_FILES['logo'];

    $logoName = $logo['name'];
    $logoType = $logo['type'];
    $logoTmpName = $logo['tmp_name'];
    $logoError = $logo['error'];
    $logoSize = $logo['size'];



    // Separate the file extension from the name
    $logoExt = explode('.', $logoName);
    $logoActualExt = strtolower(end($logoExt));

    // File extensions allowed
    $allowed = array('png', 'jpeg', 'jpg');

    if ($logoSize < 9000000) {
        // $logoNameNew = uniqid('', true) . '.' . $logoActualExt;

        $logoDestination = '../uploads/' . $logoName;
        $logoDestination2 = 'uploads/' . $logoName;


        move_uploaded_file($logoTmpName, $logoDestination);

        $id = 1;


        // Check if a record with id=1 exists
        $database->query('SELECT COUNT(*) AS count FROM navbar WHERE id = :id');
        $database->bind(':id', $id);
        $database->execute();
        $row = $database->single();

        if ($row['count'] > 0) {
            // Record exists, perform update
            $database->query('UPDATE navbar 
                      SET phone = :phone, 
                          email = :email, 
                          physical_address = :physical_address, 
                          logoName = :logoName, 
                          logoType = :logoType, 
                          logoSize = :logoSize, 
                          logoDestination = :logoDestination, 
                          logoActualExt = :logoActualExt 
                      WHERE id = :id');

            $database->bind(':phone', $phone);
            $database->bind(':email', $email);
            $database->bind(':physical_address', $physical_address);
            $database->bind(':logoName', $logoName);
            $database->bind(':logoType', $logoType);
            $database->bind(':logoSize', $logoSize);
            $database->bind(':logoDestination', $logoDestination2);
            $database->bind(':logoActualExt', $logoActualExt);
            $database->bind(':id', $id);

            $database->execute();
        } else {
            // Record does not exist, perform insert
            $database->query('INSERT INTO navbar (id, phone, email, physical_address, logoName, logoType, logoSize, logoDestination, logoActualExt) 
                    VALUES (:id, :phone, :email, :physical_address, :logoName, :logoType, :logoSize, :logoDestination, :logoActualExt)');

            $database->bind(':id', $id);
            $database->bind(':phone', $phone);
            $database->bind(':email', $email);
            $database->bind(':physical_address', $physical_address);
            $database->bind(':logoName', $logoName);
            $database->bind(':logoType', $logoType);
            $database->bind(':logoSize', $logoSize);
            $database->bind(':logoDestination', $logoDestination);
            $database->bind(':logoActualExt', $logoActualExt);

            $database->execute();
        }

        // return true;

        header("Location: ../editNavbar.php");
        exit();


    } else {
        echo "Your file is too big";
    }
}
