<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\module\profile\models\AnalyticsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Аналитика';
$max = $max*1000;
$min = $min*1000;
?>

<div class="analytics-index">
    <h1><?= Html::encode($this->title) ?></h1>
</div>
<div class="row">
  <div class="col-md-12 col-sm-12">
    <div class="col-md-4 col-sm-4"><input type="text" id="datepicker1" class="form-control ui-datepicker" placeholder="Выбрать дату начала"></div>
    <div class="col-md-4 col-sm-4"><input type="text" id="datepicker2" class="form-control ui-datepicker" placeholder="Выбрать дату окончания"></div>
    <div class="col-md-4 col-sm-4"><input type="button" name="go" value="OK" class="send btn btn-primary"></div>
  </div>
</div>
<div class="clearfix"></div><br>

<script type="text/javascript">
    
    var mass = <?echo(json_encode($mass));?>, d1, data = [], chartOptions, min = <?echo $min;?>,max = <?echo $max;?>, counts = <?echo count($mass);?>,res,graph; 
    
    for(i=0;i<counts;i++){
        res=[];
        for(j=0;j<mass[i].length;j++){
            res.push([mass[i][j].data, mass[i][j].count]);
            d1 = mass[i][j].link;
        }
        
        data.push({
            label: d1, 
            data: res
        });
    }
    
    
    $(function () {
        chartOptions = {
        xaxis: {
            min: min,
            max: max,
            mode: "time",
            tickSize: [1, "day"],
            monthNames: ["Янв", "Фев", "Март", "Апр", "Май", "Июнь", "Июль", "Авг", "Сеп", "Окт", "Ноя", "Дек"],
            tickLength: 0
          },
          yaxis: {

          },
          series: {
            lines: {
              show: true, 
              fill: true,
              lineWidth: 1
            },
            points: {
              show: true,
              radius: 3,
              fill: true,
              fillColor: "#ffffff",
              lineWidth: 2
            }
          },
          grid: { 
            hoverable: true, 
            clickable: false, 
            borderWidth: 0 
          },
          legend: {
            show: true
          },
          tooltip: true,
          tooltipOpts: {
            content: '%s: %y'
          },
          colors: mvpready_core.layoutColors
        }    

        var holder = $('#line-chart')

        if (holder.length) {
            graph = $.plot(holder, data, chartOptions );
        }

    })
</script>


<div class="row">
    <div class="col-md-12">
       	<div class="portlet portlet-boxed">
            <div class="portlet-header">
              	<h4 class="portlet-title">
                	<u>Line  Chart</u>
              	</h4>
            </div> <!-- /.portlet-header -->
            <div class="portlet-body">
              <div id="line-chart" class="chart-holder"></div>
            </div> <!-- /.portlet-body -->
        </div><!-- /.portle -->	
	</div> <!-- /.col -->
</div> <!-- /.row -->
<script>


    
$( ".send" ).click(function() {
  var results = [];
  var counts = 0;
  var request = [];
  var first = $('#datepicker1');
  var last = $('#datepicker2');
  var csrfToken = $('meta[name="csrf-token"]').attr("content");
  results.push(first.val());
  results.push(last.val());

  if (results[0] != '' && results[1] != '') {
    $.ajax({
      type: "POST",
      url: '<?php echo Url::toRoute("analytics/get_ajax"); ?>',
      data: {
          analytics : results,
          _csrf : csrfToken
      },
      success: function(result){
        request = result['data'];
        counts = result['counts'];
        max = result['max'];
        min = result['min'];
        summary = result['summary'];

        if(request != ''){
          data = [];
          graph.setData(data);
          
          for(i=0;i<counts;i++){
              res=[];
              for(j=0;j<request[i].length;j++){
                  res.push([request[i][j].data, request[i][j].count]);
                  d1 = request[i][j].link;
              }
              data.push({
                  label: d1, 
                  data: res
              });
          }
            
            if(summary > 30){
                graph.getAxes().xaxis.options.tickSize = [1, "month"];
            } else if(summary < 30){
                graph.getAxes().xaxis.options.tickSize = [1, "day"];
            }
          //graph.getAxes().xaxis.options.tickSize = [1, "day"];
            graph.getAxes().xaxis.options.min = min*1000;
            graph.getAxes().xaxis.options.max = max*1000;
            graph.setData(data);
            graph.setupGrid();
            graph.draw();
        }
      }
    });
  } else {
    alert('не все поля заданы');
  }
});
</script>   
