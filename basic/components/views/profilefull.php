<?
  use yii\helpers\Html;
  use yii\helpers\Url;
?>

<div class="col-sm-7 col-md-8 layout-main">
    <div class="portlet portlet-default">
        <div class="col-md-4" style="padding-left:0;">
            <input type="text" id="datepicker1" class="form-control ui-datepicker" placeholder="Выбрать дату начала">
        </div>
        <div class="col-md-4" style="padding-left:0;">
            <input type="text" id="datepicker2" class="form-control ui-datepicker" placeholder="Выбрать дату окончания">
        </div>
        <input type="button" name="go" value="OK" class="send btn btn-primary">        
        <div class="clearfix"></div><br>
        <div class="portlet-header">
            <h4 class="portlet-title">Переходы на сайт с рекламы</h4>
        </div> <!-- /.portlet-header -->
        <div class="portlet-body">
            <!--graphic-->
            <div id="line-chart" class="chart-holder"></div>
        </div> <!-- /.portlet-body -->  
        <div class="clearfix"></div>
        <br><br><br>


        <div class="portlet portlet-default">
          <div class="portlet-header">
            <h4 class="portlet-title">
              Статистика
            </h4>
          </div> <!-- /.portlet-header -->
        <div class="portlet-body">                
                <table class="table keyvalue-table">
                  <tbody>
                    <tr>
                      <td class="kv-key"><i class="fa fa-dollar kv-icon kv-icon-primary"></i> Стоимость клиента</td>
                      <td class="kv-value">$5,367 </td>
                    </tr>
                    <tr>
                      <td class="kv-key"><i class="fa fa-gift kv-icon kv-icon-secondary"></i> Количество кликов за неделю</td>
                      <td class="kv-value"><?=$data['count_week_stat']?></td>
                    </tr>
                    <tr>
                      <td class="kv-key"><i class="fa fa-exchange kv-icon kv-icon-tertiary"></i>Количество кликов за месяц</td>
                      <td class="kv-value"><?=$data['count_mounth_stat']?></td>
                    </tr>
                    <tr>
                      <td class="kv-key"><i class="fa fa-envelope-o kv-icon kv-icon-default"></i> Количество кликов всего</td>
                      <td class="kv-value"><?=$data['count_all_stat']?></td>
                    </tr>
                  </tbody>
                </table>
              </div> <!-- /.portlet-body -->
            </div> <!-- /.portlet -->
    </div> <!-- /.portlet -->
    </div> <!-- /.layout-main -->

    <script type="text/javascript">
    var mass = <?echo(json_encode($data['mass']));?>, d1, data = [], chartOptions, min = <?echo $data['min'];?>,max = <?echo $data['max'];?>,res,graph; 
    
    res=[];

    if (mass != false) {
      for(j=0;j<mass.length;j++){
          res.push([mass[j].data, mass[j].count]);
          d1 = mass[j].link;
      }
      
      data.push({
          label: d1, 
          data: res
      });

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
    } else {
      $("#line-chart").html('<h2 style="margin-top: 15%; text-align: center;">Данные по этой кампании отсутсвуют...</h2>');
    }
    
    if (mass != false) {
      $( ".send" ).click(function() {
      var results = [];
      var counts = 0;
      var request = [];
      var first = $('#datepicker1');
      var last = $('#datepicker2');
      var id = <?=$data['id'];?>;    
      var csrfToken = $('meta[name="csrf-token"]').attr("content");
      results.push(first.val());
      results.push(last.val());
      results.push(id);

      if (results[0] != '' && results[1] != '') {
        $.ajax({
          type: "POST",
          url: '<?php echo Url::toRoute("default/get_ajax"); ?>',
          data: {
              analytics : results,
              _csrf : csrfToken
          },
          success: function(result){
            request = result['data'];
            max = result['max'];
            min = result['min'];
            summary = result['summary'];
              
            if(request != false){
              data = [];
              graph.setData(data);
                
              res=[];
              for(i=0;i<request.length;i++){
                  res.push([request[i].data, request[i].count]);
                  d1 = request[i].link;
              }
                
              data.push({
                label: d1, 
                data: res
              });
                
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
            } else {
                 data = [];
                 graph.setData(data);
                
                 res=[];
                 for(i=0;i<summary;i++){
                      res.push(min+i*3600*24,0);
                      d1 = request[i].link;
                  }

                  data.push({
                    label: d1, 
                    data: res
                  });
                
                if(summary > 30){
                    graph.getAxes().xaxis.options.tickSize = [1, "month"];
                } else if(summary < 30){
                    graph.getAxes().xaxis.options.tickSize = [1, "day"];
                }
                
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
    }
    
</script>
