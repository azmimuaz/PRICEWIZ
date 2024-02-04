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
    <div style="width: 80%; margin: auto;">
        <canvas id="myChart"></canvas>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Your API call code
            var requestOptions = {
                method: "GET",
                redirect: "follow",
            };

            fetch("https://api.data.gov.my/data-catalogue?id=cpi_core&limit=2000", requestOptions)
                .then(response => response.json())
                .then(apiData => {
                    // Assuming the API data has a structure similar to your sample static data
                    const dataPoints = apiData.map(point => ({
                        label: point.label,
                        value: point.value
                    }));

                    const labels = dataPoints.map(point => point.label);
                    const values = dataPoints.map(point => point.value);

                    // Update the existing Chart.js code with the fetched data
                    var ctx = document.getElementById('myChart').getContext('2d');
                    var myChart = new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: labels,
                            datasets: [{
                                label: 'API Data',
                                data: values,
                                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                borderColor: 'rgba(75, 192, 192, 1)',
                                borderWidth: 1
                            }]
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                })
                .catch(error => console.log("error", error));
        });
    </script>

</main>

</body>
</html>
