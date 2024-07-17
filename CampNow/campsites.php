<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['campsite_name'])) {
    if (isset($_POST['rating'])) {
        // Rating submission
        $campsite_name = $_POST['campsite_name'];
        $rating = intval($_POST['rating']);
        
        if (!isset($_SESSION['ratings'])) {
            $_SESSION['ratings'] = [];
        }

        if (!isset($_SESSION['ratings'][$campsite_name])) {
            $_SESSION['ratings'][$campsite_name] = [];
        }

        $_SESSION['ratings'][$campsite_name][] = $rating;
    } else {
        // Campsite selection
        $_SESSION['selected_campsite_name'] = $_POST['campsite_name'];
        $_SESSION['selected_campsite_location'] = $_POST['campsite_location'];
        header("Location: dashboard.php");
        exit;
    }
}

$campsites = [
    [
        'name' => 'Sunset Valley',
        'location' => 'California',
        'description' => 'A beautiful campsite with stunning sunset views.',
    ],
    [
        'name' => 'Mountain Retreat',
        'location' => 'Colorado',
        'description' => 'Nestled in the mountains, perfect for hiking and nature lovers.',
    ],
    [
        'name' => 'Lakeside Haven',
        'location' => 'Michigan',
        'description' => 'Enjoy fishing and boating at this serene lakeside campsite.',
    ],
];

function getAverageRating($campsite_name) {
    if (isset($_SESSION['ratings'][$campsite_name])) {
        $ratings = $_SESSION['ratings'][$campsite_name];
        return round(array_sum($ratings) / count($ratings), 2);
    }
    return 0;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>CampNow Campsites</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            background-image: url('images/campsites.png'); /* Background photo URL */
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

        .campsite-listing {
            border: 1px solid #ccc;
            padding: 10px;
            margin-bottom: 20px;
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
        }

        .campsite-listing h2, .campsite-listing p {
            color: #000;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <header class="header">
            <div class="nav-buttons">
                <a href="dashboard.php">Dashboard</a>
                <a href="resources.php">Resources</a>
                <a href="logout.php">Sign Out</a>
            </div>
            <h1 class="header"><img src="images/logo.png" alt="CampNow Logo"> CampNow</h1>
        </header>
        <div class="container">
            <h1>Campsite Listings</h1>
            <p>The campsite page on the CampNow website is designed to be a comprehensive resource for users planning their next camping adventure. At its core, the page features a user-friendly interface where visitors can easily search for campsites based on their preferred location. Whether they're looking for a serene spot in the mountains or a lakeside retreat, the page offers a variety of options to suit different preferences and needs.</p>
            <p>Upon selecting a campsite, users can view detailed information such as amenities, nearby attractions, and availability. This allows them to make informed decisions before proceeding to reserve a spot directly through the website. The reservation process is streamlined, ensuring a seamless user experience from browsing to booking.</p>
            <p>Additionally, user engagement is encouraged through interactive features like rating and reviews. Campers can share their experiences and insights, helping others in the community choose the perfect campsite. The page is designed to foster a sense of community among outdoor enthusiasts, providing a platform where users can connect, share tips, and discover hidden gems for their next camping trip. Whether planning a weekend getaway or an extended outdoor retreat, the campsite page on CampNow aims to be a valuable resource for every camper's journey.</p>
            
            <?php foreach ($campsites as $campsite): ?>
                <div class="campsite-listing">  
                    <h2><?php echo htmlspecialchars($campsite['name']); ?></h2>
                    <p><strong>Location:</strong> <?php echo htmlspecialchars($campsite['location']); ?></p>
                    <p><?php echo htmlspecialchars($campsite['description']); ?></p>
                    <p><strong>Average Rating:</strong> <?php echo getAverageRating($campsite['name']); ?> / 5</p>
                    <form method="POST">
                        <label for="rating-<?php echo htmlspecialchars($campsite['name']); ?>">Rate this campsite:</label>
                        <select name="rating" id="rating-<?php echo htmlspecialchars($campsite['name']); ?>">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                        <input type="hidden" name="campsite_name" value="<?php echo htmlspecialchars($campsite['name']); ?>">
                        <button type="submit">Submit Rating</button>
                    </form>
                    <form method="POST">
                        <input type="hidden" name="campsite_name" value="<?php echo htmlspecialchars($campsite['name']); ?>">
                        <input type="hidden" name="campsite_location" value="<?php echo htmlspecialchars($campsite['location']); ?>">
                        <button type="submit">Reserve this Campsite</button>
                    </form>
                </div>
            <?php endforeach; ?>
        </div>
        <footer class="footer">
            <p>&copy; <?php echo date('Y'); ?> CampNow</p>
        </footer>
    </div>
</body>
</html>
