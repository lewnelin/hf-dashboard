
  const ctx = document.getElementById('myPieChart');
  
  new Chart(ctx, {
    type: 'pie',
    data: {
      labels: ['Red', 'Blue', 'Yellow', 'Green'],
      datasets: [{
        label: '# of Votes',
        data: [12, 19, 3, 5],
      }]
    }
  });