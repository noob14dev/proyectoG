document.addEventListener('DOMContentLoaded', function () {
    fetch('http://localhost:8000/getData.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({
            periodicidad: "0",   // semestres
            proyecto: "578",     // ejemplo
            componentes: ["1","2","3","4"]
        })
    })
    .then(response => response.json())
    .then(result => {
        Highcharts.chart('container-packed', {
            chart: {
                type: 'packedbubble',
                height: '100%'
            },
            title: {
                text: 'Progreso académico - Packed Bubble'
            },
            tooltip: {
                useHTML: true,
                pointFormat: '<b>{point.name}:</b> {point.value}'
            },
            plotOptions: {
                packedbubble: {
                    minSize: '20%',
                    maxSize: '100%',
                    zMin: 0,
                    zMax: 100,
                    layoutAlgorithm: {
                        splitSeries: false,
                        gravitationalConstant: 0.02
                    },
                    dataLabels: {
                        enabled: true,
                        format: '{point.name}',
                        filter: {
                            property: 'y',
                            operator: '>',
                            value: 1
                        },
                        style: {
                            color: 'black',
                            textOutline: 'none',
                            fontWeight: 'normal'
                        }
                    }
                }
            },
            series: result.series
        });
    })
    .catch(error => console.error('Error:', error));
});
