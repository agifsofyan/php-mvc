<!-- Top -->
<?php require APP_ROOT . '/views/inc/_top.php' ?>
<script src="<?php echo URL_ROOT; ?>/vendors/chartjs/Chart.min.js"></script>
<!-- Top -->

<?php flash('msg_success'); ?>
<?php flash('msg_error'); ?>

<!-- Content -->

<div class="mdc-layout-grid__inner">
  <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-6">
    
    <div class="mdc-layout-grid__inner">
        <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6">
            <div class="mdc-card info-card info-card--danger">
              <div class="card-inner text-center">
                
                <h2><?php echo count($data);?></h2>
                <h5>Total Order</h5>
                
                <div class="card-icon-wrapper">
                  <i class="material-icons">attach_money</i>
                </div>
              </div>
            </div>
        </div>
        
        <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6">
            <div class="mdc-card info-card info-card--info">
              <div class="card-inner text-center">
                
                <h2>
                    <?php
                    $paid = 0;
                    $unpaid = 0;
                    foreach($data as $product){
                        if($product->status == 'paid'){
                            $paid++;
                        }else{
                            $unpaid++;
                        }
                    };
                    echo $paid;
                    ?>
                </h2>
                <h5>Total Paid</h5>
                
                <div class="card-icon-wrapper">
                  <i class="material-icons">credit_card</i>
                </div>
              </div>
            </div>
        </div>

        <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6">
            <div class="mdc-card info-card info-card--primary">
              <div class="card-inner text-center">
                
                <h2><?php echo count($data) > 0 ? round($paid/count($data)*100, 2) . '%' : 0 ; ?></h2>
                <h5>Total Ratio</h5>
                
                <div class="card-icon-wrapper">
                  <i class="material-icons">trending_up</i>
                </div>
              </div>
            </div>
        </div>
        
        <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6">
            <div class="mdc-card info-card info-card--success">
              <div class="card-inner text-center">
                
                <h2><?php echo $unpaid; ?></h2>
                <h5>Unpaid Order</h5>
                
                <div class="card-icon-wrapper">
                  <i class="material-icons">dvr</i>
                </div>
              </div>
            </div>
        </div>
    </div>
    
  </div>
  
  <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-6 bg-white" <?php echo count($opt['horizontal']) > 0 ? '' : 'hidden'; ?>>
    <canvas
      id="myChart"
      data-horizontal="<?php echo implode(',', $opt['horizontal']); ?>"
      data-vertical="<?php echo implode(',', $opt['vertical']); ?>"
    ></canvas>
  </div>
</div>

<br>
<br>

<div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12">
    <div class="mdc-card">
      <div class="d-flex justify-content-between">
        <h4 class="card-title mb-0">Top <?php echo count($opt['top']); ?> Product</h4>
        <div>
            <i class="material-icons refresh-icon">refresh</i>
            <i class="material-icons options-icon ml-2">more_vert</i>
        </div>
      </div>
      <div class="d-block d-sm-flex justify-content-between align-items-center">
      <div class="mdc-layout-grid__inner mt-2">
        <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-10">
            <div class="table-responsive">
              <table class="table dashboard-table">
                <tbody>
                  <?php foreach($opt['top'] as $key => $val): ?>
                  <tr>
                    <td># <?php echo $key+1; ?></td>
                    <td><?php echo ucwords($val->name); ?></td>
                  </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
        </div>
        <!--<div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-4">-->
          <!--<div id="revenue-map" class="revenue-world-map"></div>-->
        <!--</div>-->
      </div>
    </div> 
  </div>
<!-- Content -->

<script type="text/javascript">
  //Chart Bar
  var ctx = $("#myChart");
  let x = ctx.data('horizontal');
  let y = ctx.data('vertical');


  let dataX = x.search(',') > 0 ? x.split(',') : [x];
  let dataY = y.toString().search(',') > 0 ? y.split(',') : [y];

  console.log('dataX: ', dataX);
  console.log('dataY: ', dataY);
  
  let backgroundData = [
      'rgba(255, 99, 132, 0.2)',
      'rgba(54, 162, 235, 0.2)',
      'rgba(255, 206, 86, 0.2)',
      'rgba(75, 192, 192, 0.2)',
      'rgba(153, 102, 255, 0.2)',
      'rgba(255, 159, 64, 0.2)'
  ];
  
  let borderData = [
      'rgba(255,99,132,1)',
      'rgba(54, 162, 235, 1)',
      'rgba(255, 206, 86, 1)',
      'rgba(75, 192, 192, 1)',
      'rgba(153, 102, 255, 1)',
      'rgba(255, 159, 64, 1)'
  ];
  
  var randomColor = function(opacity) {
    return 'rgba(' + Math.round(Math.random() * 255) + ',' + Math.round(Math.random() * 255) + ',' + Math.round(Math.random() * 255) + ',' + (opacity || '.3') + ')';
  };

  var myChart = new Chart(ctx, {
    type: 'pie',
      data: {
        labels: dataX,
        datasets: [{
            label: '# of Total',
            data: dataY,
            backgroundColor: backgroundData,
            borderColor: borderData,
            borderWidth: 1
        }]
    },
    options: {
      responsive: true,
        legend: {
            position: 'bottom',
        },
        title: {
            display: true,
            text: 'Monthly order this year'
        },
        tooltips: {
          callbacks: {
            label: function(tooltipItem, data) {
                //console.log('tooltipItem', tooltipItem);
              var label = data.labels[tooltipItem.index];
                var val = data.datasets[tooltipItem.datasetIndex].data[tooltipItem.index];
                var valCurrency = parseFloat(val).toLocaleString('id-ID', {
                    style: 'decimal',
                    maximumFractionDigits: 2,
                  minimumFractionDigits: 0
                });
                
                return label + ': Rp ' + valCurrency;
            }
          }
        } 
      }
  });
</script>

<!-- Bottom -->
<?php require APP_ROOT . '/views/inc/_bottom.php' ?>
<!-- Bottom -->
