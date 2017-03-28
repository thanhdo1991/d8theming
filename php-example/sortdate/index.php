<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sap xep date</title>
  <link rel="stylesheet" href="css/jquery-ui.css">
  <link rel="stylesheet" href="css/style.css">
  <script src="js/jquery-1.12.4.js"></script>
  <script src="js/jquery-ui.js"></script>
  <script>
  $( function() {
    $( "#datepicker" ).datepicker({
      dateFormat: "dd/mm/yy",
      showOn: "button",
      buttonImage: "images/calendar.gif",
      buttonImageOnly: true,
      buttonText: "Select date"
      onSelect: function(date) {
        if($('.before').text() != '') {
          $('.before').append(',' + date);
        } else {
          $('.before').append(date);
        }

        $(this).val('');
      }
    });
  } );
  </script>
</head>
<body>
<?php
  $before = $after = '';
  $after_arr = array();
  if (isset($_POST['sort'])) {
    $before = !empty($_POST['before']) ? $_POST['before'] : '';

    if (!empty($before)) {
      $before_arr = explode(',', $before);
      foreach ($before_arr as $key => $value) {
        $date = str_replace('/', '-', $value);
        $new_value =  date('Y-m-d', strtotime($date));

        $after_arr[] = strtotime($new_value);
      }

      arsort($after_arr);
    }
  }
  if (isset($_POST['clear'])) {
    unset($_POST);
  }
?>
  <h1>Sap xep date</h1>
  <p>Date: <span id="datepicker" size="30"></span></p>
  <form method="post">
    <p>Before</p>
    <textarea name="before" class="before" cols="50" rows="10" readonly=""><?php echo $before; ?></textarea>
    <br />
    <input type="submit" name="sort" value="sort">
    <input type="submit" name="clear" value="clear">
  </form>
  <div class="after">
    <p>After</p>
    <?php
      if (isset($_POST['sort'])) {
        foreach ($after_arr as $value) {
          $after = date("d/m/Y", $value);
          echo $after;
          print '<br />';
          print '<br />';
        }
      }
     ?>
  </div>
</body>
</html>
