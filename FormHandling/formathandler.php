<?php 

// var_dump($_POST);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize input data
    // htmlspecialchars() - convert special characters to HTML entities for security
    //e.g if user inputs <script>alert('Hacked!');</script> it will be converted to &lt;script&gt;alert('Hacked!');&lt;/script&gt;
    // or & it will be converted to &amp; so that it will not be executed as HTML or JavaScript
    $firstname = htmlspecialchars(trim($_POST['firstname']));
    $lastname = htmlspecialchars(trim($_POST['lastname']));
    $favoritepet = htmlspecialchars(trim($_POST['favoritepet']));

    // Validate input data
    if (empty($firstname) || empty($lastname) || empty($favoritepet)) {
        echo "<script>
        alert('All fields are required.')
        window.location.href='index.html'
        </script>";

    } else {
        // Process the data
        echo "<script>
        alert('Thank you,.');
        window.location.href = 'index.html';
        </script>";
        // header("Location: index.html");
        
    }
} else {
    echo "Invalid request method.";
}