<?
  foreach ($data as $key => $message) {
     $name = $message;
  }
?>

<script type="text/javascript">
  var name = '<? echo $name;?>';

  function notify(from, align, icon, type, animIn, animOut, title, message){
    $.growl({
      icon: icon,
      title: title || '',
      message: message || '',
      url: ''
    },{
      element: 'body',
      type: type,
      allow_dismiss: true,
      placement: {
        from: from,
        align: align
      },
      offset: {
        x: 20,
        y: 85
      },
      spacing: 10,
      z_index: 1031,
      delay: 2500,
      timer: 1000,
      url_target: '_blank',
      mouse_over: false,
      animate: {
        enter: animIn,
        exit: animOut
      },
      icon_type: 'class',
      template: '<div data-growl="container" class="alert" role="alert">' +
                 '<button type="button" class="close" data-growl="dismiss">' +
                     '<span aria-hidden="true">&times;</span>' +
                     '<span class="sr-only">Close</span>' +
                 '</button>' +
                 '<span data-growl="icon"></span>' +
                 '<span data-growl="title"></span>' +
                 '<span data-growl="message"></span>' +
                 '<a href="#" data-growl="url"></a>' +
             '</div>'
    });
  };
</script>
<?
$this->registerJs(
    '$("document").ready(function(){
        notify("top", "right", "", "inverse", "animated fadeIn", "animated fadeOut", "" , name);
    });'
);
?>