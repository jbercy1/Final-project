<?php
session_start();

// array of resources 
$resources = [
    [
        'title' => 'How to start a campfire',
        'description' => 'To build a campfire, start by choosing a safe spot away from overhanging branches, dry grass, or other flammable materials. Clear the area of debris and create a fire ring using rocks to contain the fire. Gather three types of wood: tinder (small, easily ignitable materials like dry leaves or twigs), kindling (slightly larger sticks), and fuel wood (larger logs). Arrange the tinder in the center of the fire ring and build a teepee structure around it with the kindling. Light the tinder with a match or lighter, and gradually add more kindling to keep the flame going.

        As the kindling burns and the fire grows, add the larger fuel wood pieces in a crisscross pattern to ensure good airflow. Maintain the fire by adding wood as needed, but avoid overloading it to prevent smothering the flames. Always keep a bucket of water, a shovel, or sand nearby to extinguish the fire completely before leaving or going to sleep. To put out the fire, spread the embers, pour water over them, and stir until everything is cool to the touch. Never leave a campfire unattended.'
    ],
    [
        'title' => 'Camping Essentials',
        'description' => 'When preparing for a camping trip, essential items include a tent for shelter, a sleeping bag and sleeping pad for comfort, and appropriate clothing for varying weather conditions. Bring a portable stove or campfire supplies for cooking, along with food, a water filter or purification tablets, and a durable water bottle. Pack a first aid kit, a multi-tool, a flashlight or headlamp with extra batteries, and navigation tools such as a map, compass, or GPS device. Additionally, include personal hygiene items, insect repellent, sunscreen, and a trash bag to carry out all waste, ensuring you leave no trace behind.'
    ],
    [
        'title' => 'Tips for setting up a tent',
        'description' => 'To set up a tent efficiently, choose a flat, level spot free of rocks and debris, ideally with some natural wind protection. Lay down a ground tarp to protect the tent floor from moisture and abrasion. Unpack the tent, lay it out over the tarp, and stake down the corners to prevent it from moving. Assemble the poles and insert them into the designated sleeves or clips, raising the tent as you go. Once the tent is standing, secure the rainfly if needed and ensure all zippers and seams are properly closed. Finally, check that all guy lines are taut and stakes are secure to ensure stability and weather resistance.'
    ]
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>CampNow Resources</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            background-image: url('images/resources.jpg'); /* Background image URL */
            background-size: cover; /* Cover the entire background */
            background-position: center; /* Center the background */
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .wrapper {
            flex: 1; /* Flex grow to push footer to bottom */
        }

        .container {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.9);
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px; /* Rounded corners for container */
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

        .resources-listing {
            border: 1px solid #ccc;
            padding: 10px;
            margin-bottom: 20px;
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
        }

        .resources-listing h2, .resources-listing p {
            color: #000;
        }

        .footer {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 10px 0;
            margin-top: auto; /* Pushes footer to the bottom */
        }

        .footer p {
            margin: 0;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <header class="header">
            <h1><img src="images/logo.png" alt="CampNow Logo"> CampNow Resources</h1>
            <nav class="nav-buttons">
                <a href="dashboard.php" class="btn">Dashboard</a>
                <a href="campsites.php" class="btn">Campsites</a>
                <a href="logout.php" class="btn">Sign Out</a>
            </nav>
        </header>
        <div class="container">
    <div class="content">
        <h2>Resources for Campers</h2>
        <p>The resource page on CampNow is designed as an indispensable tool for campers seeking comprehensive guidance and preparation for their outdoor excursions. Central to its purpose is to equip users with essential information and tips to enhance their camping experience. The page features a wealth of resources ranging from practical advice on outdoor living to detailed equipment tips, ensuring campers are well-prepared and confident in their camping endeavors.</p>

        <p>At its core, the resource page offers insightful articles and guides on various aspects of outdoor living. Whether it's tips on setting up a campsite, cooking over a campfire, or navigating trails safely, campers can access valuable knowledge to make their camping trips enjoyable and hassle-free. This section is curated to cater to both novice campers looking for basic skills and seasoned outdoor enthusiasts seeking new insights.</p>

        <p>Moreover, the resource page serves as a vital hub for accessing local resources and emergency information. Campers can find essential contacts and guidelines for handling emergencies while outdoors, ensuring they are prepared for unexpected situations. From local ranger stations to emergency services, this section provides peace of mind by offering easy access to critical resources that can safeguard campers' well-being during their adventures.</p>
    </div>
    </div>

        <div class="container">
            <h1>Camping Tips and Resources</h1>
            <?php foreach ($resources as $resource): ?>
                <div class="resources-listing">
                    <h2><?php echo htmlspecialchars($resource['title']); ?></h2>
                    <p><?php echo nl2br(htmlspecialchars($resource['description'])); ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <footer class="footer">
        <p>&copy; <?php echo date('Y'); ?> CampNow</p>
    </footer>
</body>
</html>
