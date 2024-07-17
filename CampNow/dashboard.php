<?php
session_start();

// Check if user is not logged in, redirect to login page
if (!isset($_SESSION['username'])) {
    header("Location: login.html");
    exit;
}

// Extract session variables 
$username = $_SESSION['username'];
$first_name = $_SESSION['first_name'];
$email = $_SESSION['email'];
$location = $_SESSION['location'];
$date_of_birth = $_SESSION['date_of_birth'];
$zip_code = $_SESSION['zip_code'];
$selected_campsite_name = isset($_SESSION['selected_campsite_name']) ? $_SESSION['selected_campsite_name'] : 'None';
$selected_campsite_location = isset($_SESSION['selected_campsite_location']) ? $_SESSION['selected_campsite_location'] : 'None';

// Function to calculate average rating for selected campsite
function getAverageRating($campsite_name) {
    if (isset($_SESSION['ratings'][$campsite_name])) {
        $ratings = $_SESSION['ratings'][$campsite_name];
        return round(array_sum($ratings) / count($ratings), 2);
    }
    return 0;
}

$selected_campsite_rating = getAverageRating($selected_campsite_name);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>CampNow Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            background-image: url('images/background.png'); 
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            height: 100%;
        }

        .wrapper {
            min-height: 100%;
            display: flex;
            flex-direction: column;
        }

        .container {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.8); /* Semi-transparent white background */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            flex: 1; /* Flex grow to push footer to bottom */
        }

        .header, .footer {
            background-color: rgba(0, 0, 0, 0.5); /* Semi-transparent black background */
            color: #fff;
            text-align: center;
            padding: 10px 0;
        }

        .header img {
            height: 50px;
            vertical-align: middle;
        }

        .header h1 {
            display: inline;
            margin-left: 10px;
            vertical-align: middle;
            color: #fff;
            text-decoration: none;
        }

        .header h1 img {
            vertical-align: middle;
            margin-right: 10px;
        }

        .welcome {
            text-align: center;
            margin: 20px 0;
        }

        .profile {
            display: flex;
            justify-content: space-around;
            margin: 20px 0;
            background-color: rgba(255, 255, 255, 0.9); /* Semi-transparent white background */
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        .profile div {
            width: 45%;
        }

        .profile h2 {
            margin-top: 0;
        }

        .profile p {
            line-height: 1.6;
        }

        .logout {
            text-align: center;
            margin-top: 20px;
        }

        .logout a {
            text-decoration: none;
            color: #fff;
            background-color: #333;
            padding: 10px 20px;
            border-radius: 5px;
        }

        .profile img {
            max-width: 100px;
            border-radius: 50%;
        }

        .nav-buttons {
            float: right;
            margin-top: 10px;
        }

        .nav-buttons a {
            display: inline-block;
            text-decoration: none;
            color: #333;
            background-color: #fff;
            padding: 10px 20px;
            margin-left: 10px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .nav-buttons a:hover {
            background-color: #333;
            color: #fff;
        }

        .footer {
            background-color: rgba(0, 0, 0, 0.5); /* Semi-transparent black background */
            color: #fff;
            text-align: center;
            padding: 10px 0;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <header class="header">
            <div class="nav-buttons">
                <a href="dashboard.php">Dashboard</a>
                <a href="campsites.php">Campsites</a>
                <a href="resources.php">Resources</a>
                <a href="logout.php">Sign Out</a>
            </div>
            <h1 class="header"><img src="images/logo.png" alt="CampNow Logo"> CampNow</h1>
        </header>
        <div class="container">
    <div class="welcome">
        <h2>Welcome to your CampNow Dashboard!</h2>
        <p>The dashboard on the CampNow website serves as a centralized hub where users can access and manage their camping experience seamlessly. Upon logging in, campers are greeted with a personalized overview of their profile, displaying essential account information such as username, contact details, and membership status. This feature ensures that users have quick access to their personal details, facilitating easy updates and management.</p>
        
        <h3>Your Profile</h3>
        <div class="profile">
            <div>
                <h4>Profile Information</h4>
                <p><strong>Username:</strong> <?php echo htmlspecialchars($username); ?></p>
                <p><strong>Email:</strong> <?php echo htmlspecialchars($email); ?></p>
                <p><strong>Location:</strong> <?php echo htmlspecialchars($location); ?></p>
                <p><strong>Date of Birth:</strong> <?php echo htmlspecialchars($date_of_birth); ?></p>
                <p><strong>Zip Code:</strong> <?php echo htmlspecialchars($zip_code); ?></p>
            </div>
            <div>
                <h4>Reservation Details</h4>
                <p><strong>Reserved Campsite:</strong> <?php echo htmlspecialchars($selected_campsite_name); ?></p>
                <p><strong>Campsite Location:</strong> <?php echo htmlspecialchars($selected_campsite_location); ?></p>
                <p><strong>Average Rating:</strong> <?php echo $selected_campsite_rating; ?> / 5</p>
            </div>
            <div>
                <img src="images/profile.png" alt="Profile Picture">
            </div>
        </div>

        <h3>Explore CampNow</h3>
        <p>Furthermore, the dashboard serves as a gateway to all other essential pages on CampNow. With intuitive navigation links, users can seamlessly navigate between different sections of the website, including the campsites page and the resource page. This cohesive design ensures that campers can explore additional information, browse available campsites, access camping tips and resources, and engage with the community—all from a single, user-friendly interface.</p>

        <h3>Upcoming Reservations</h3>
        <p>In addition to profile information, the dashboard prominently highlights the user's upcoming camping reservations. This feature allows campers to stay organized and prepared for their next outdoor adventure by displaying reservation details such as dates, locations, and any special accommodations chosen during booking. Users can easily review their upcoming plans and make necessary adjustments directly from the dashboard.</p>
    </div>
</div>

</body>
</html>
