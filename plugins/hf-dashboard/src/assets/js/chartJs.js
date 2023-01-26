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

    if (data.length) {
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
  } else {
        document.getElementById('nodata').style.display = 'block';
        ctx.style.display = 'none';
  }
});