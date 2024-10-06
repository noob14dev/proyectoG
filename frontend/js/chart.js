document.addEventListener('DOMContentLoaded', function () {
    fetch('http://localhost:8000/src/api.php')
        .then(response => response.json())
        .then(data => {
            const chartData = data.map(item => ({
                name: item.name,
                y: item.id // Cambia esto según tu estructura de datos
            }));

            Highcharts.chart('container', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Datos de la API'
                },
                series: [{
                    name: 'Datos',
                    data: chartData
                }]
            });
        })
        .catch(error => console.error('Error:', error));
});
