<?php
// Connect to the database
$mysqli = mysqli_connect("mi-linux.wlv.ac.uk", "2123563", "Prayer252525@@", "db2123563");
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    exit();
}

// Check if a search query has been submitted
$search = '';
if (isset($_GET['search'])) {
    $search = $_GET['search'];
    $query = "SELECT Title, Genre, prices, Developer, Publisher, Release_date
    FROM Games WHERE Title LIKE '%$search%'";
} else {
    $query = "SELECT Title, Genre, prices, Developer, Publisher, Release_date FROM Games";
}

// Run SQL query
$res = mysqli_query($mysqli, $query);

// Are there any errors in the SQL statement?
if (!$res) {
    print("MySQL error: " . mysqli_error($mysqli));
    exit;
}

session_start();

// Check if the session variable for start time exists or is expired
if (!isset($_SESSION['start_time']) || (time() - $_SESSION['start_time'] > 1800)) { // Set a time limit (e.g., 1800 seconds = 30 minutes)
    $_SESSION['start_time'] = time();
}

?>

<!DOCTYPE html>
<html>
<head>
    <style>

        body {
            background: linear-gradient(to top left, #8457fc, #20d3fe) no-repeat fixed center;
        }

        table {
            border-collapse: collapse;
            font-size: 0.9em;
            width: 100%;
            border-radius: 20px 20px 0 0;
            overflow: hidden;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
        }
        
        th, td {
            border: 1px solid black;
            padding: 15px;
            text-align: center;
        }

        tr {
            background-color: #3ba8fa;
        }

        th {
            background-color: #3ba8fa;
            color: #ffff;
        }

        tr:nth-child(even) {
            background: #667afd;
            color: #ffff;
        }
        
        tr:nth-child(odd) {
            color: #ffff;
        }

        tr:last-of-type {
            border-bottom: 2px solid #3ba8fa;
        }
		
        h1 {
            color: #fff;
            padding: 10px;
            text-align: center;
        }

        div.form-container {
        text-align: center;
        background-color: #3ba8fa;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
    }

    /* Style the label for the search input */
    label {
        font-size: 18px;
        color: #ffffff; /* Text color */
    }

    /* Style the search input field */
    input[type="text"] {
        width: 300px;
        padding: 10px;
        border: none;
        border-radius: 5px;
        margin: 10px;
        
    }

    /* Style the search button */
    input[type="submit"] {
        background-color: #ffffff;
        color: #3ba8fa;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        font-weight: bold;
        cursor: pointer;
    }

    /* Style the search button on hover */
    input[type="submit"]:hover {
        background-color: #3ba8fa;
        color: #ffffff;
    }

    </style>
</head>
 <script>
    var isTabClosed = false; // Flag to track if the tab is closed

    // Listen for the page visibility change event
    document.addEventListener('visibilitychange', function() {
        if (document.visibilityState === 'hidden') {
            // The tab is being closed
            isTabClosed = true;

            // Send an AJAX request to update the session variable when tab is closed
            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'update_session.php', true);
            xhr.send();
        }
    });

    // Listen for page unload event (for refresh or tab close)
    window.addEventListener('beforeunload', function(event) {
        if (isTabClosed) {
            // Don't trigger the reset on a page refresh
            return;
        }
    });
    </script>
<body>
    <h1>List of Games</h1>

    <div style="margin-bottom: 20px; text-align: center; color: #fff;
            padding: 10px;
            text-align: center;">
        <?php
        $currentTime = time();
        $timeElapsed = $currentTime - $_SESSION['start_time'];
        $minutes = floor($timeElapsed / 60);
        $seconds = $timeElapsed % 60;
        echo "You've been here for " . $minutes . " minute(s) and " . $seconds . " second(s).";
        ?>
    </div>

    <div style="margin-bottom: 30px;">
    <table>
        <tr>
            <th>Title</th>
            <th>Genre</th>
            <th>Price</th>
            <th>Developer</th>
            <th>Publisher</th>
            <th>Release date</th>
        </tr>
        <?php
        if (mysqli_num_rows($res) == 0) {
            echo "<tr><td colspan='6'>No results found.</td></tr>";
        } else {
            while ($row = mysqli_fetch_assoc($res)) {
                echo "<tr>";
                echo "<td><a href='game_details.php?title=" . urlencode($row['Title']) . "' style='text-decoration: none; color: #ffff;'>" . $row['Title'] . "</a></td>";
                echo "<td>" . $row['Genre'] . "</td>";
                echo "<td>$" . number_format($row['prices'], 2) . "</td>";
                echo "<td>" . $row['Developer'] . "</td>";
                echo "<td>" . $row['Publisher'] . "</td>";
                echo "<td>" . $row['Release_date'] . "</td>";
                echo "</tr>";
            }
        }
        ?>
    </table>
</div>


    <div style="text-align: center;">
    <form method="get">
        <label for="search">Search for a game:</label>
        <input type="text" name="search" id="search" value="<?php echo $search; ?>">
        <input type="submit" value="Search">
    </form>
    </div>
    <div class="container" style="text-align: center;">
    <a href="index.php" style="display: inline-block; padding: 5px 10px; background-color: #667afd; text-decoration: none; color: #fff;">Back to Game List</a>
</div>
</body>
</html>