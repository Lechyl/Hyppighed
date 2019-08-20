function diagram() {
    $('#hidden-elem').html('<div style="position: relative; width: 80vw"><canvas id="myChart"></canvas></div>');
    
    $.ajax({
        url: 'api/person_data/str',
        type:'GET',
        dataType: 'json',  // what to expect back from the PHP script, if anything
        headers: {
            Accept: "application/json"
        },
        success:function (response) {
           //let encodedData = JSON.parse(response);
            let datas = [];
            let labels = [];
            for (let data of response){
                //console.log(data.str);
                  datas.push(data.total.toString());
                  labels.push(data.str);
            }
            let img = new Image();
            img.src = "../img/SuperBil.jpg";

            //Drawing the chart
            img.onload = function() {
                let canvas = document.getElementById('myChart').getContext('2d');
                let fillPattern = canvas.createPattern(img,'repeat');


                //Drawing table
                let myChart = new Chart(canvas, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Hyppighed',
                            backgroundColor: fillPattern,
                            data: datas,
                            borderWidth: 1,
                        }]
                    },
                    options: {
                        responsive: true,
                        scales: {
                            xAxes:[{
                                scaleLabel:{
                                    display: true,
                                    labelString: 'Sko størrelser'
                                }
                            }],
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true,
                                    max: 20
                                },
                                scaleLabel:{
                                    display: true,
                                    labelString: 'Antal'
                                }

                            }]
                        }
                    }
                });
            };
        }
    });
}