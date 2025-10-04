<!doctype html>
<html>

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>SCADA Mini Dashboard</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <h2>Mini SCADA - Monitoring Daya</h2>

    <canvas id="powerChart" width="800" height="250"></canvas>

    <script>
        async function fetchData() {
            const res = await fetch('/api/sensor/latest?limit=100');
            return await res.json();
        }

        function buildChart(labels, data) {
            const ctx = document.getElementById('powerChart').getContext('2d');
            return new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Power (W)',
                        data: data,
                        fill: false,
                        tension: 0.2
                    }]
                },
                options: { responsive: true, scales: { x: { display: true }, y: { beginAtZero: true } } }
            });
        }

        (async () => {
            const d = await fetchData();
            const labels = d.map(r => new Date(r.timestamp).toLocaleTimeString());
            const data = d.map(r => parseFloat(r.power_W));
            const chart = buildChart(labels, data);

            // polling tiap 5 detik untuk demo real-time
            setInterval(async () => {
                const d2 = await fetchData();
                const labels2 = d2.map(r => new Date(r.timestamp).toLocaleTimeString());
                const data2 = d2.map(r => parseFloat(r.power_W));
                chart.data.labels = labels2;
                chart.data.datasets[0].data = data2;
                chart.update();
            }, 5000);
        })();
    </script>
</body>

</html>