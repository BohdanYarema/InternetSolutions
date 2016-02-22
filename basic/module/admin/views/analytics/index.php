<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\web\View;
use yii\helpers\Url;

$this->title = 'Аналитика';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="analytics-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?php \yii\widgets\Pjax::begin(); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id_campaigns',
            'date',
            'link',
            'id_user',
            /*['class' => 'yii\grid\ActionColumn'],*/
        ],
    ]); ?>
    <?php \yii\widgets\Pjax::end(); ?>
</div>

<button id="auth-button" hidden>Authorize</button>


<script type="text/javascript">

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

<script>
// Replace with your client ID from the developer console.
var CLIENT_ID = '746431818850-sddh6at9g6o18hbmi82rh13tu2mi3pbg.apps.googleusercontent.com';

// Set authorized scope.
var SCOPES = ['https://www.googleapis.com/auth/analytics.readonly'];


function authorize(event) {
  // Handles the authorization flow.
  // `immediate` should be false when invoked from the button click.
  var useImmdiate = event ? false : true;
  var authData = {
    client_id: CLIENT_ID,
    scope: SCOPES,
    immediate: useImmdiate
  };

  gapi.auth.authorize(authData, function(response) {
    var authButton = document.getElementById('auth-button');
    if (response.error) {
      authButton.hidden = false;
    }
    else {
      authButton.hidden = true;
      queryAccounts();
    }
  });
}

function queryAccounts() {
  // Load the Google Analytics client library.
  gapi.client.load('analytics', 'v3').then(function() {

    // Get a list of all Google Analytics accounts for this user
    gapi.client.analytics.management.accounts.list().then(handleAccounts);
  });
}

function handleAccounts(response) {
  // Handles the response from the accounts list method.
  if (response.result.items && response.result.items.length) {
    // Get the first Google Analytics account.
    var firstAccountId = response.result.items[0].id;

    // Query for properties.
    queryProperties(firstAccountId);
  } else {
    console.log('No accounts found for this user.');
  }
}

function queryProperties(accountId) {
  // Get a list of all the properties for the account.
  gapi.client.analytics.management.webproperties.list(
      {'accountId': accountId})
    .then(handleProperties)
    .then(null, function(err) {
      // Log any errors.
      console.log(err);
  });
}

function handleProperties(response) {
  // Handles the response from the webproperties list method.
  if (response.result.items && response.result.items.length) {

    // Get the first Google Analytics account
    var firstAccountId = response.result.items[0].accountId;

    // Get the first property ID
    var firstPropertyId = response.result.items[0].id;

    // Query for Views (Profiles).
    queryProfiles(firstAccountId, firstPropertyId);
  } else {
    console.log('No properties found for this user.');
  }
}

function queryProfiles(accountId, propertyId) {
  // Get a list of all Views (Profiles) for the first property
  // of the first Account.
  gapi.client.analytics.management.profiles.list({
      'accountId': accountId,
      'webPropertyId': propertyId
  })
  .then(handleProfiles)
  .then(null, function(err) {
      // Log any errors.
      console.log(err);
  });
}

function handleProfiles(response) {
  // Handles the response from the profiles list method.
  if (response.result.items && response.result.items.length) {
    // Get the first View (Profile) ID.
    var firstProfileId = response.result.items[0].id;

    // Query the Core Reporting API.
    queryCoreReportingApi(firstProfileId);
  } else {
    console.log('No views (profiles) found for this user.');
  }
}

function queryCoreReportingApi(profileId) {
  // Query the Core Reporting API for the number sessions for
  // the past seven days.
  gapi.client.analytics.data.ga.get({
    'ids': 'ga:' + profileId,
    'start-date': '2016-01-01',
    'end-date': 'today',
    'metrics': 'ga:pageviews,ga:sessionDuration',
    'dimensions': 'ga:pagePath,ga:date,ga:fullReferrer',
    'sort':'-ga:date',
  })
  .then(function(response) {
    var formattedJson = JSON.stringify(response.result);
    var json_data = JSON.parse(formattedJson);
    var result = json_data.rows;
    var csrfToken = $('meta[name="csrf-token"]').attr("content");
      

    $.ajax({
        type: "POST",
        url: '<?php echo Url::toRoute("analytics/ajax_request"); ?>',
        data: {
            analytics : result,
            _csrf : csrfToken,
        },
        success: function(result){
            console.log(result['data']);
            if(result['data'] == 'Данные успешно загружены'){
                $("document").ready(function(){
                    notify("top", "right", "", "inverse", "animated fadeIn", "animated fadeOut", "" , result['data']);
                });
                $.pjax.reload({container:'#w0'});
            }
            
        }
    });

  })
  .then(null, function(err) {
    // Log any errors.
    console.log(err);
  });
}

// Add an event listener to the 'auth-button'.
document.getElementById('auth-button').addEventListener('click', authorize);
</script>

<script src="https://apis.google.com/js/client.js?onload=authorize"></script>
  


