<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link rel="stylesheet" href="./index.css">
    <link rel="stylesheet" href="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.9.0/TweenMax.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <title>PRICEWIZ</title>
</head>
<body>

<header>
    <?php include 'top_nav.html';?>
</header>

<main>
<div style="width: 60%; margin: auto;">
<br>
<div>

<div>
    <h2>Consumer Price Index</h2>
<h4>The graph below shows change in the prices of a basket of goods and services.</h4>

</div>
        <!-- Dropdown menu for selecting chart type -->
        <select id="chartSelector">
            <option value="overall">Overall Trend</option>
            <option value="foodBeverage">Food & Beverage</option>
            <option value="householdEquipment">Household Equipment</option>
            <option value="clothingFootwear">Clothing & Footwear</option>
            <option value="overall">Furnishing</option>
            <option value="overall">Health</option>
        </select>
 

    </div>
    <!-- Container for the charts -->
    <div id="chartContainer">
        <!-- Charts will be dynamically inserted here -->
    </div>

    <?php
    // Establish database connection
    $host = "localhost";
    $username = "root";
    $password = "";
    $dbname = "PRICEWIZ";
    $conn = new mysqli($host, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Fetch data from MySQL
    $sql = "SELECT * FROM cpi_core"; // Modify the query according to your database schema
    $result = $conn->query($sql);

    // Initialize arrays to store data
    $years = [];
    $overallPrices = [];
    $foodBeveragePrices = [];
    $householdEquipmentPrices = [];
    $clothingFootwearPrices = [];
    $housingUtilitiesPrices = [];
    $healthPrices = [];

    // Populate arrays with data from the database
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            // Extract year from date
            $year = date('Y', strtotime($row['price_date']));
            $years[] = $year;
            $overallPrices[] = $row['overall'];
            $foodBeveragePrices[] = $row['food_beverage'];
            $householdEquipmentPrices[] = $row['housing_utilities'];
            $clothingFootwearPrices[] = $row['clothing_footwear'];
            $furnishingPrices[] = $row['furnishings'];
            $healthPrices[] = $row['health'];
        }
    } else {
        echo "No data found in the database.";
    }

    // Close database connection
    $conn->close();
    ?>

    <script>
        // Function to create a line chart
        function createLineChart(ctx, labels, data, label) {
            return new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: label,
                        data: data,
                        fill: false,
                        borderColor: 'red',
                        tension: 0.1
                    }]
                }
            });
        }

        // Function to update chart based on selected option
        function updateChart(selectedOption, selectedYear) {
            var chartData, chartLabel;

            // Determine chart data based on selected option
            switch (selectedOption) {
                case 'overall':
                    chartLabel = 'Overall Trend';
                    chartData = <?php echo json_encode($overallPrices); ?>;
                    break;
                case 'foodBeverage':
                    chartLabel = 'Food & Beverage';
                    chartData = <?php echo json_encode($foodBeveragePrices); ?>;
                    break;
                case 'householdEquipment':
                    chartLabel = 'Household Equipment';
                    chartData = <?php echo json_encode($householdEquipmentPrices); ?>;
                    break;
                case 'clothingFootwear':
                    chartLabel = 'Clothing & Footwear';
                    chartData = <?php echo json_encode($clothingFootwearPrices); ?>;
                    break;
                case 'furnishing':
                    chartLabel = 'Furnishing';
                    chartData = <?php echo json_encode($furnishingPrices); ?>;
                    break;
                case 'health':
                    chartLabel = 'Health';
                    chartData = <?php echo json_encode($healthPrices); ?>;
                    break;
            }

            // Get the canvas element
            var ctx = document.createElement('canvas');

            // Create a new line chart
            var newChart = createLineChart(ctx, <?php echo json_encode($years); ?>, chartData, chartLabel);

            // Get the chart container and clear its content
            var container = document.getElementById('chartContainer');
            container.innerHTML = '';

            // Append the new chart canvas to the container
            container.appendChild(ctx);
        }

        // Event listener for dropdown menu change
        document.getElementById('chartSelector').addEventListener('change', function() {
            var selectedOption = this.value;
    
            updateChart(selectedOption);
        });

        // Event listener for year dropdown menu change
       

        // Initial chart display
        updateChart('overall',);
    </script>

</main>

</body>
</html>
