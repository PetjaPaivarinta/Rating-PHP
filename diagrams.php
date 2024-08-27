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
        <style>
            body {
                font-family: Arial, sans-serif;
            }

            h1 {
                text-align: center;
            }
        </style>
        <h1>Male</h1>
    <canvas id="maleChart"></canvas>
        <h1>Female</h1>
    <canvas id="femaleChart"></canvas>
        <script>
            async function fetchRatingData() {
                const response = await fetch('ratings.txt?' + new Date().getTime());
                const text = await response.text();
                return text;
            }

            function processRatingData(data) {
                const lines = data.split('\n').filter(line => line.trim() !== '');
                const ratings = lines.map(line => line.split(','));
                return ratings;
            }

            function createChart(ctx, labels, data, title) {
                new Chart(ctx, {
                    type: 'pie',
                    data: {
                        labels: labels,
                        datasets: [
                            {
                                label: title,
                                data: data,
                                backgroundColor: [
                                    'rgba(255, 99, 132, 0.2)',
                                    'rgba(54, 162, 235, 0.2)',
                                    'rgba(75, 192, 192, 0.2)',
                                    'rgba(255, 206, 86, 0.2)',
                                    'rgba(153, 102, 255, 0.2)',
                                    'rgba(255, 159, 64, 0.2)',
                                    'rgba(255, 99, 132, 0.4)',
                                    'rgba(54, 162, 235, 0.4)',
                                    'rgba(75, 192, 192, 0.4)',
                                    'rgba(255, 206, 86, 0.4)',
                                    'rgba(153, 102, 255, 0.4)',
                                    'rgba(255, 159, 64, 0.4)'
                                ],
                                borderColor: [
                                    'rgba(255, 99, 132, 1)',
                                    'rgba(54, 162, 235, 1)',
                                    'rgba(75, 192, 192, 1)',
                                    'rgba(255, 206, 86, 1)',
                                    'rgba(153, 102, 255, 1)',
                                    'rgba(255, 159, 64, 1)',
                                    'rgba(255, 99, 132, 0.8)',
                                    'rgba(54, 162, 235, 0.8)',
                                    'rgba(75, 192, 192, 0.8)',
                                    'rgba(255, 206, 86, 0.8)',
                                    'rgba(153, 102, 255, 0.8)',
                                    'rgba(255, 159, 64, 0.8)'
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

                const maleEmotions = ratings.filter(rating => rating[0] === 'Male').map(rating => rating[1]);
                const femaleEmotions = ratings.filter(rating => rating[0] === 'Female').map(rating => rating[1]);

                const maleEmotionCounts = maleEmotions.reduce((acc, emotion) => {
                    acc[emotion] = (acc[emotion] || 0) + 1;
                    return acc;
                }, {});

                const femaleEmotionCounts = femaleEmotions.reduce((acc, emotion) => {
                    acc[emotion] = (acc[emotion] || 0) + 1;
                    return acc;
                }, {});

                const maleCtx = document.getElementById('maleChart').getContext('2d');
                const femaleCtx = document.getElementById('femaleChart').getContext('2d');

                createChart(maleCtx, Object.keys(maleEmotionCounts), Object.values(maleEmotionCounts), 'Male Emotions');
                createChart(femaleCtx, Object.keys(femaleEmotionCounts), Object.values(femaleEmotionCounts), 'Female Emotions');
            }

            init();
        </script>
    </body>
</html>