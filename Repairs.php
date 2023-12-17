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
    Nenhuma reparação em curso.
</div>

<table id="productTable" style="display: none;">
    <tr>
        <th>Device Type</th>
        <th>Brand</th>
        <th>Serial Number</th>
        <th>Reported Issue</th>
        <th>Shipping Code</th>
        <th>Status</th>
    </tr>
    <!-- The table will be dynamically filled with JavaScript -->
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
        const code = document.getElementById("code").value;

        const table = document.getElementById("productTable").getElementsByTagName('tbody')[0];
        const newRow = table.insertRow(table.rows.length);

        const cells = [deviceType, brand, serialNumber, issue, code, "Under Repair"];

        for (let i = 0; i < cells.length; i++) {
            const cell = newRow.insertCell(i);
            cell.innerHTML = cells[i];
        }

        document.getElementById("reparationForm").reset();
        document.getElementById("repairForm").style.display = "none";

        checkForRepair(); // Chama a função para verificar se há reparação
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
    include_once('templates/userpages.php');
    ?>
</body>

</html>