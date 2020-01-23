var dps = [];

var chart = new CanvasJS.Chart("chartContainer", {
    exportEnabled: true,
    title: {
        text: "Revenue / Users Chart"
    },
    data: [
        {
            type: "line",
            dataPoints: dps
        }
    ]
});

$.getJSON("/public/revenue", function(chartData) {
    for(var i = 0; i < chartData.items.length; i++){
        var timeStamp = chartData.items[i].timestamp;
        dps.push({
            x: new Date(timeStamp * 1000),
            y: parseFloat(chartData.items[i].price)
        });
    }
    chart.render();

    var axisXMin = chart.axisX[0].get("minimum");
    var axisXMax = chart.axisX[0].get("maximum");

    $( function() {
        $("#fromDate").val(CanvasJS.formatDate(axisXMin, "D MMM YYYY"));
        $("#toDate").val(CanvasJS.formatDate(axisXMax, "D MMM YYYY"));
        $("#fromDate").datepicker({dateFormat: "d M yy"});
        $("#toDate").datepicker({dateFormat: "d M yy"});
    });

    $("#date-selector").change(function() {
        var minValue = $("#fromDate").val();
        var maxValue = $("#toDate").val();

        if(new Date(minValue).getTime() < new Date(maxValue).getTime()) {
            chart.axisX[0].set("minimum", new Date(minValue));
            chart.axisX[0].set("maximum", new Date(maxValue));
        }
    });

    $(".period").click(function() {
        var period = this.id;
        var minValue;
        minValue = new Date(axisXMax);

        switch(period) {
            case "1m":
                minValue.setMonth(minValue.getMonth() - 1);
                break;
            case "3m":
                minValue.setMonth(minValue.getMonth() - 3);
                break;
            case "6m":
                minValue.setMonth(minValue.getMonth() - 6);
                break;
            case "1y":
                minValue.setYear(minValue.getFullYear() - 1);
                break;
            default:
                minValue = axisXMin;
        }

        chart.axisX[0].set("minimum", new Date(minValue));
        chart.axisX[0].set("maximum", new Date(axisXMax));
    });
});


$.getJSON("/public/retention", function(chartData) {
    let labels = [];
    let series = [];

    for(var i = 0; i < chartData.length; i++){
        let date = new Date(chartData[i].date * 1000);

        labels.push(date.getFullYear() + '-' + (date.getUTCMonth()+1) + '-' + date.getDate());

        series.push(chartData[i].retention);
    }

    new Chartist.Line('.ct-chart', {
        labels: labels,
        series: [series]
    }, {
        fullWidth: true,
        chartPadding: {
            right: 40
        }
    });
});

