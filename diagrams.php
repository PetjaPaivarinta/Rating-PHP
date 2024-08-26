<!DOCTYPE html>
<html>
    <head>
        <title>Diagrams</title>
        <link rel="stylesheet" type="text/css" href="../Rating-PHP/Assets/main.css">
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <style>
            canvas {
                max-width: 600px;
                margin: 0 auto;
                display: block;
            }
        </style>
    </head>
    <body>
        <canvas id="myChart"></canvas>
        <script>
            async function fetchRatingData() {
                const response = await fetch('ratings.txt');
                const text = await response.text();
                return text;
            }

            function processRatingData(data) {
                const lines = data.split('\n').filter(line => line.trim() !== '');
                const ratings = lines.map(line => line.split(','));
                return ratings;
            }

            function createChart(ratings) {
                const emotions = ratings.map(rating => rating[1]);

                const emotionCounts = emotions.reduce((acc, emotion) => {
                    acc[emotion] = (acc[emotion] || 0) + 1;
                    return acc;
                }, {});

                const ctx = document.getElementById('myChart').getContext('2d');
                new Chart(ctx, {
                    type: 'pie',
                    data: {
                        labels: Object.keys(emotionCounts),
                        datasets: [
                            {
                                label: 'Emotions',
                                data: Object.values(emotionCounts),
                                backgroundColor: [
                                    'rgba(255, 99, 132, 0.2)',
                                    'rgba(54, 162, 235, 0.2)',
                                    'rgba(75, 192, 192, 0.2)',
                                    'rgba(255, 206, 86, 0.2)',
                                    'rgba(153, 102, 255, 0.2)',
                                    'rgba(255, 159, 64, 0.2)'
                                ],
                                borderColor: [
                                    'rgba(255, 99, 132, 1)',
                                    'rgba(54, 162, 235, 1)',
                                    'rgba(75, 192, 192, 1)',
                                    'rgba(255, 206, 86, 1)',
                                    'rgba(153, 102, 255, 1)',
                                    'rgba(255, 159, 64, 1)'
                                ],
                                borderWidth: 1
                            }
                        ]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                position: 'top',
                            },
                            tooltip: {
                                callbacks: {
                                    label: function(tooltipItem) {
                                        return tooltipItem.label + ': ' + tooltipItem.raw;
                                    }
                                }
                            }
                        }
                    }
                });
            }

            async function init() {
                const data = await fetchRatingData();
                const ratings = processRatingData(data);
                createChart(ratings);
            }

            init();
        </script>
    </body>
</html>