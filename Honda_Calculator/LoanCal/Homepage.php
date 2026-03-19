<?php include "db.php";?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<title>Honda Loan Calculator</title>

<style>
body {
  font-family: Arial;
  background: #f4f4f4;
  margin: 0;
}

/* CENTER SCREEN */
.page-wrapper {
  height: 100vh;
  display: flex;
  justify-content: center;
  align-items: center;
  padding: 15px;
}

/* CARD BOX */
.card {
  background: white;
  width: 100%;
  max-width: 420px;
  padding: 20px;
  border-radius: 12px;
  box-shadow: 0 10px 25px rgba(0,0,0,0.15);
  position: relative;
}

/* USER ICON */
.top-right {
  position: absolute;
  top: 12px;
  right: 12px;
}

.top-right i {
  font-size: 28px;
  color: #555;
  cursor: pointer;
}

/* INPUTS */
input, select, button {
  width: 100%;
  padding: 12px;
  margin: 8px 0;
  font-size: 16px;
  border-radius: 6px;
  border: 1px solid #ccc;
}

button {
  background: red;
  color: white;
  border: none;
  cursor: pointer;
}

/* TITLE */
h2 {
  text-align: center;
}

/* RESULT BOX */
.result {
  margin-top: 15px;
  font-weight: bold;
  overflow-x: auto;
}

/* TABLE */
table {
  width: 100%;
  font-size: 14px;
  border-collapse: collapse;
  text-align: center;
}

table th {
  background: red;
  color: white;
  padding: 8px;
}

table td {
  border: 1px solid #ddd;
  padding: 8px;
}
</style>
</head>

<body>

<div class="page-wrapper">

  <div class="card">

    <!-- USER ICON -->
    <div class="top-right">
      <i class="fas fa-user-circle" onclick="checkAccess()"></i>
    </div>

    <h2>Honda Loan Calculator</h2>

    <!-- UNIT -->
    <label>Motorcycle Unit:</label>
    <select id="unit" onchange="setLCP()">
      <option value="">Select Unit</option>
      <?php
        $sql = "SELECT * FROM honda_units";
        $result = $conn->query($sql);
        while($row = $result->fetch_assoc()) {
            $lcp = $row['lcp'] ? $row['lcp'] : '';
            echo "<option value='{$lcp}'>{$row['units']}</option>";
        }
      ?>
    </select>

    <!-- LCP -->
    <label>LCP (₱):</label>
    <input type="number" id="lcp" readonly>

    <!-- DOWNPAYMENT -->
    <label>Downpayment (₱):</label>
    <input type="number" id="dp">

    <button onclick="calculateLoan()">Calculate</button>

    <div class="result" id="result"></div>

  </div>

</div>

<script>
// SET LCP
function setLCP() {
  let select = document.getElementById("unit");
  document.getElementById("lcp").value = select.value;
}

// CALCULATE LOAN
function calculateLoan() {
  let unit = document.getElementById("unit").options[
    document.getElementById("unit").selectedIndex
  ].text;

  let lcp = parseFloat(document.getElementById("lcp").value);
  let dp = parseFloat(document.getElementById("dp").value);

  if (isNaN(lcp) || isNaN(dp) || dp > lcp) {
    document.getElementById("result").innerHTML = "Invalid input.";
    return;
  }

  let loan = lcp - dp;

  let factors = {
    36: 0.04778,
    30: 0.05333,
    24: 0.06167,
    18: 0.07556,
    12: 0.10333
  };

  let output = `
    <strong>Unit:</strong> ${unit}<br>
    <strong>LCP:</strong> ₱${lcp.toLocaleString()}<br>
    <strong>Downpayment:</strong> ₱${dp.toLocaleString()}<br>
    <strong>Loan:</strong> ₱${loan.toLocaleString()}<br><br>

    <table>
      <tr>
        <th>Term</th>
        <th>Monthly</th>
      </tr>
  `;

  Object.keys(factors).sort((a,b)=>b-a).forEach(term => {
    let monthly = Math.round(loan * factors[term]);
    output += `
      <tr>
        <td>${term} mos</td>
        <td>₱${monthly.toLocaleString()}</td>
      </tr>
    `;
  });

  output += `</table>`;

  document.getElementById("result").innerHTML = output;
}

// ACCESS CHECK
function checkAccess() {
  let code = prompt("Enter Access Code:");
  if (!code) return;

  fetch("verify_access.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/x-www-form-urlencoded"
    },
    body: "access_code=" + encodeURIComponent(code.trim())
  })
  .then(res => res.text())
  .then(res => {
    console.log("Server response:", res); // DEBUG

    if (res.trim() === "OK") {
      window.location.href = "access_page.php";
    } else {
      alert("Invalid access code!");
    }
  })
  .catch(err => {
    console.error("Error:", err);
  });
}
</script>

</body>
</html>