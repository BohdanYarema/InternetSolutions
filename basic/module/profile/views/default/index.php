<?
  use yii\helpers\Html;
  use yii\helpers\Url;
  use app\components\ProfilefullWidget;
  use app\components\ProfileemptyWidget;

?>
<div class="content">
    <div class="container">
        <div class="layout layout-stack-sm layout-main-left">
          <?
            if ($data['counts'] == 1) {
              echo ProfilefullWidget::widget(['data'=>$data]);
            } else {
              echo ProfileemptyWidget::widget();
            }
          ?>
          <div class="col-sm-5 col-md-4 layout-sidebar">
              <?
                if ($data['counts'] != 0) {
                  ?>
                    <div class="portlet">
                      <? $url = Url::toRoute(['projects/create']);?>
                      <a href="<?echo $url;?>" class="btn btn-primary btn-jumbo btn-block ">Создать Проект</a>
                      <br>
                      <? $url = Url::toRoute(['campaigns/create']);?>
                      <a href="<?echo $url;?>" class="btn btn-secondary btn-lg btn-block ">Создать рекламную Кампанию</a>
                    </div> <!-- /.portlet -->
                  <?
                }
              ?>
              <h4>Полезные советы</h4>
              <div class="well">
                  <ul class="icons-list text-md">
                      <li>
                          <i class="icon-li fa fa-comments-o text-success"></i>
                          <strong class="semibold">New Sale!</strong>
                          <br>
                          Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                      </li>
                      <li>
                          <i class="icon-li fa fa-check-square text-secondary"></i>
                          <strong class="semibold">New Action!</strong>
                          <br>
                          Vestibulum iaculis felis eu eros pellentesque placerat.
                      </li>
                      <li>
                          <i class="icon-li fa fa-truck text-tertiary"></i>
                          <strong class="semibold">New Product!</strong>
                          <br>
                          Curabitur cursus nisl et mauris imperdiet porttitor.
                      </li>
                      <li>
                          <i class="icon-li fa fa-comments-o text-primary"></i>
                          <strong class="semibold">New Comment!</strong>
                          <br>
                          Vestibulum iaculis felis eu eros pellentesque placerat.
                      </li>
                      <li>
                          <i class="icon-li fa fa-comments-o text-primary"></i>
                          <strong class="semibold">New Comment!</strong>
                          <br>
                          Curabitur cursus nisl et mauris imperdiet porttitor.
                      </li>
                  </ul>
              </div> <!-- /.well -->
          </div> <!-- /.layout-sidebar -->
        </div> <!-- /.layout -->
    </div> <!-- /.container -->
</div> <!-- .content -->