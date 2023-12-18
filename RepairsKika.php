<?php
session_start();

function getFacilitiesFromDatabase() {
    $dbh = new PDO('sqlite:sql/DataBase.db');
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $facilities = array();

    try {
        $stmt = $dbh->prepare("SELECT id, address_ FROM Facility");
        $stmt->execute();
        $facilities = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    } finally {
        $dbh = null;
    }

    return $facilities;
}

function insertReparation($date, $client, $status, $deviceType, $brand, $serialNumber, $reportedIssue, $budget, $shippingCode, $facility) {
    $dbh = new PDO('sqlite:sql/DataBase.db');
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    try {
        // Insert into Reparation table
        $stmtReparation = $dbh->prepare("INSERT INTO Reparation (date_, client, status, device_type, brand, serial_number, reported_issue, budget, shipping_code) VALUES (:date, :client, :status, :deviceType, :brand, :serialNumber, :reportedIssue, :budget, :shippingCode)");
        $stmtReparation->bindParam(':date', $date, PDO::PARAM_STR);
        $stmtReparation->bindParam(':client', $client, PDO::PARAM_STR);
        $stmtReparation->bindParam(':status', $status, PDO::PARAM_STR);
        $stmtReparation->bindParam(':deviceType', $deviceType, PDO::PARAM_STR);
        $stmtReparation->bindParam(':brand', $brand, PDO::PARAM_STR);
        $stmtReparation->bindParam(':serialNumber', $serialNumber, PDO::PARAM_STR);
        $stmtReparation->bindParam(':reportedIssue', $reportedIssue, PDO::PARAM_STR);
        $stmtReparation->bindParam(':budget', $budget, PDO::PARAM_INT);
        $stmtReparation->bindParam(':shippingCode', $shippingCode, PDO::PARAM_INT);
        $stmtReparation->execute();

        // Get the last inserted ID
        $reparationId = $dbh->lastInsertId();

        // Insert into ReparationFacility table
        $stmtReparationFacility = $dbh->prepare("INSERT INTO ReparationFacility (facility, reparation) VALUES (:facility, :reparation)");
        $stmtReparationFacility->bindParam(':facility', $facility, PDO::PARAM_INT);
        $stmtReparationFacility->bindParam(':reparation', $reparationId, PDO::PARAM_INT);
        $stmtReparationFacility->execute();
    } catch (PDOException $e) {
        echo "Error inserting data: " . $e->getMessage(); // Print the error message
    } finally {
        $dbh = null;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $date = date('Y-m-d H:i:s');
    $client = $_SESSION['user_id'] ?? ''; // Use null coalescing operator to handle undefined index
    $status = 'Evaluating';
    $deviceType = $_POST['deviceType'] ?? '';
    $brand = $_POST['brand'] ?? '';
    $serialNumber = $_POST['serialNumber'] ?? '';
    $reportedIssue = $_POST['issue'] ?? '';
    $budget = $_POST['budget'] ?? '';
    $shippingCode = $_POST['code'] ?? '';
    $facility = $_POST['facility'] ?? '';

    insertReparation($date, $client, $status, $deviceType, $brand, $serialNumber, $reportedIssue, $budget, $shippingCode, $facility);

    // Additional logic if needed

    // Redirect or display a success message
    header("Location: success_page.php");
    exit();
}
?>

<!-- Rest of the HTML code remains the same -->


<!-- Rest of the HTML code remains the same -->


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Repair</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        form {
            max-width: 600px;
            margin: 20px 0;
        }
        .no-repair-message {
            font-style: italic;
            color: #888;
            margin-top: 10px;
        }
    </style>
</head>
<body>

<h1>Products under Repair</h1>

<div id="noRepairMessage" class="no-repair-message">
   No reparation being done.
</div>

<table id="productTable" style="display: none;">
    <tr>
        <th>Device Type</th>
        <th>Brand</th>
        <th>Serial Number</th>
        <th>Reported Issue</th>
        <th>Facility</th>
        <th>Budget (€)</th>
        <th>Shipping Code</th>
        <th>Status</th>
    </tr>
    
</table>

<button onclick="openForm()">Create Repair</button>

<div id="repairForm" style="display: none;">
    <h2>Repair Form</h2>
    <form id="reparationForm">
        <label for="deviceType">Device Type:</label>
        <input type="text" id="deviceType" name="deviceType" required><br>

        <label for="brand">Brand:</label>
        <input type="text" id="brand" name="brand" required><br>

        <label for="serialNumber">Serial Number:</label>
        <input type="text" id="serialNumber" name="serialNumber" required><br>

        <label for="issue">Reported Issue:</label>
        <input type="text" id="issue" name="issue" required><br>

        <label for="facility">Choose Facility:</label>
        <select id="facility" name="facility" required>
            <?php
            // Assuming you have a function to fetch facilities from the database
            $facilities = getFacilitiesFromDatabase(); // Replace this with your actual function

            foreach ($facilities as $facility) {
                echo '<option value="' . $facility['id'] . '">' . $facility['address_'] . '</option>';
            }
            ?>
        </select>

        <label for="budget">Budget:</label>
        <input type="number" id="budget" name="budget" required>

        <input type="hidden" id="code" name="code">

        <input type="submit" value="Submit">
    </form>
</div>

<script>
    function openForm() {
        document.getElementById("repairForm").style.display = "block";
        generateCode();
    }

    function generateCode() {
        const randomCode = Math.floor(1000 + Math.random() * 9000);
        document.getElementById("code").value = randomCode;
    }

    document.getElementById("reparationForm").addEventListener("submit", function (event) {
    event.preventDefault();

    const deviceType = document.getElementById("deviceType").value;
    const brand = document.getElementById("brand").value;
    const serialNumber = document.getElementById("serialNumber").value;
    const issue = document.getElementById("issue").value;
    const facilityId = document.getElementById("facility").value;
    const selectedFacility = document.getElementById("facility").options[document.getElementById("facility").selectedIndex].text;
    const budget = document.getElementById("budget").value;
    const code = document.getElementById("code").value;

    const table = document.getElementById("productTable").getElementsByTagName('tbody')[0];
    const newRow = table.insertRow(table.rows.length);

    const cells = [deviceType, brand, serialNumber, issue, selectedFacility, budget, code, "Under Repair"];

    for (let i = 0; i < cells.length; i++) {
        const cell = newRow.insertCell(i);
        cell.innerHTML = cells[i];
    }

    document.getElementById("reparationForm").reset();
    document.getElementById("repairForm").style.display = "none";

    checkForRepair();
});

    // Verifica se há reparação ao carregar a página
    window.onload = function () {
        checkForRepair();
    };

    function checkForRepair() {
        const table = document.getElementById("productTable").getElementsByTagName('tbody')[0];
        const rowCount = table.rows.length;

        if (rowCount === 0) {
            // Se não houver reparação, exibe a mensagem e esconde a tabela
            document.getElementById("noRepairMessage").style.display = "block";
            document.getElementById("productTable").style.display = "none";
        } else {
            // Se houver reparação, esconde a mensagem e exibe a tabela
            document.getElementById("noRepairMessage").style.display = "none";
            document.getElementById("productTable").style.display = "table";
        }
    }
</script>

<?php
include_once('templates/header&navmenu.php');
include_once('templates/footer.php');
?>
</body>
</html>
