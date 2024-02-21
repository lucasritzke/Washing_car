<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['email']) && isset($_POST['message'])) {
        $email = $_POST['email'];
        $message = $_POST['message'];

        $command = "echo \"$message\" | mutt -s 'Your Car Washing Order' $email";

        $output = shell_exec($command);

        if ($output === null) {
            echo "E-mail sent successfully.";
        } else {
            echo "Failed to send e-mail.";
        }
    } else {
        echo "Missing data.";
    }
} else {
    echo "Invalid request method.";
}
?>

