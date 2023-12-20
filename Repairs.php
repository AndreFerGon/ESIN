<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     
    <link rel="icon" href="images/logo.png" type="image/png">
</head>

<body>

    <section id="repairs">
        <h2>Repairs</h2>

        
        <?php
        try {
            $dbh = new PDO('sqlite:sql/DataBase.db');
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            if (isset($_SESSION['user_id'])) {
                $user_id = $_SESSION['user_id'];
            
                $stmt_client = $dbh->prepare('SELECT username FROM Client WHERE username = ?');
                $stmt_client->execute([$user_id]);
                $client_id = $stmt_client->fetchColumn();
            
                
                $stmt_check_repairs = $dbh->prepare('SELECT COUNT(*) FROM Reparation WHERE client = ?');
                $stmt_check_repairs->execute([$client_id]);
                $has_repairs = $stmt_check_repairs->fetchColumn();
            
                if ($has_repairs) {
                    $stmt = $dbh->prepare('SELECT Reparation.id, Reparation.date_, Reparation.device_type, Reparation.brand, Reparation.serial_number, Reparation.reported_issue, Reparation.budget, ReparationFacility.facility, Reparation.status, Reparation.shipping_code, Facility.address_
                                        FROM Reparation
                                        LEFT JOIN ReparationFacility ON Reparation.id = ReparationFacility.reparation
                                        LEFT JOIN Facility ON ReparationFacility.facility = Facility.id
                                        WHERE Reparation.client = ?
                                        ORDER BY Reparation.id ASC');
                    $stmt->execute([$client_id]);
                    $repairs = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
                    if ($repairs) {
                        echo '<table border="1">';
                        echo '<tr><th>ID</th><th>Date</th><th>Device Type</th><th>Brand</th><th>Serial Number</th><th>Reported Issue</th><th>Budget</th><th>Shipping Code</th><th>Facility</th><th>Status</th></tr>';
                        foreach ($repairs as $repair) {
                            echo '<tr>';
                            echo '<td>' . $repair['id'] . '</td>';
                            echo '<td>' . $repair['date_'] . '</td>';
                            echo '<td>' . $repair['device_type'] . '</td>';
                            echo '<td>' . $repair['brand'] . '</td>';
                            echo '<td>' . $repair['serial_number'] . '</td>';
                            echo '<td>' . $repair['reported_issue'] . '</td>';
                            echo '<td>' . $repair['budget'] . '</td>';
                            echo '<td>' . $repair['shipping_code'] . '</td>';
                            echo '<td>' . $repair['address_'] . '</td>';
                            echo '<td>' . $repair['status'] . '</td>';
                            echo '</tr>';
                        }
                        echo '</table>';
                    } else {
                        echo '<p>No repairs found for the user.</p>';
                    }
                } else {
                    echo '<p>No repairs found for the user.</p>';
                }
            } else {
                echo '<p>User not logged in.</p>';
            }
            
            
            
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
        ?>

       
        <h3>Create Repair</h3>
        <form action="process_repair.php" method="post">
            
            <?php
            $currentDate = date('Y-m-d');
            echo '<input type="hidden" id="date" name="date" value="' . $currentDate . '">';
            ?>

           
            <?php
            if (isset($_SESSION['user_id'])) {
                $user_id = $_SESSION['user_id'];

                $stmt_client = $dbh->prepare('SELECT username FROM Client WHERE username = ?');
                $stmt_client->execute([$user_id]);
                $client_id = $stmt_client->fetchColumn();

                
                echo '<input type="hidden" id="client" name="client" value="' . $client_id . '">';
            }
            ?>

            <label for="device_type">Device Type</label>
            <input type="text" id="device_type" name="device_type" placeholder="Device Type" required>

            <label for="brand">Brand</label>
            <input type="text" id="brand" name="brand" placeholder="Brand" required>

            <label for="serial_number">Serial Number</label>
            <input type="text" id="serial_number" name="serial_number" placeholder="Serial Number" required>

            <label for="reported_issue">Reported Issue</label>
            <input type="text" id="reported_issue" name="reported_issue" placeholder="Reported Issue" required>

            <label for="budget">Budget</label>
            <input type="text" id="budget" name="budget" placeholder="Budget" required>

            <?php
            $shipping_code = mt_rand(1000, 9999);
            echo '<input type="hidden" id="shipping_code" name="shipping_code" value="' . $shipping_code . '">';
            ?>

            
            <label for="facility">Facility</label>
            <select name="facility">
                <?php
                
                $stmt_facilities = $dbh->query('SELECT * FROM Facility');
                $facilities = $stmt_facilities->fetchAll(PDO::FETCH_ASSOC);

                foreach ($facilities as $facility) {
                    echo '<option value="' . $facility['id'] . '">' . $facility['address_'] . '</option>';
                }
                ?>
            </select>

            
            <input type="hidden" id="facility_id" name="facility_id" value="">

            <button type="submit">Create Repair</button>
        </form>

    </section>

    <?php
    include_once('templates/userpages.php');
    include_once('templates/header&navmenu.php');
    include_once('templates/footer.php');
    ?>

</body>

</html>
