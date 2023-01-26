$(document).ready(function () {
    const graphdata = $('#graphdata').data("graph");
    const graphtype = $('#graphtype').data("type");
    const ctx = document.getElementById('myPieChart');

    var labels = graphdata.map(function(e) {
        return e.page;
    });
    var data = graphdata.map(function(e) {
        return e.cnt;
    });

    new Chart(ctx, {
        type: 'pie', //graphtype
        data: {
            labels: labels,
            datasets: [{
                label: '# of Accesses',
                data: data,
            }]
        }
    });
});