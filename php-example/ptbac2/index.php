<!DOCTYPE html>
<html>
<head>
  <title>Giai phuong bac 2</title>
  <style type="text/css">
    textarea {
      font-size: 20px;
    }
  </style>
</head>
<body>
<h1>Giai Phuong trinh</h1>
<?php
  $calc = "";
  $a = $b = $c = 0;

  if (isset($_POST['calc'])) {
    $a = !empty($_POST['a']) ? $_POST['a'] : 0;
    $b = !empty($_POST['b']) ? $_POST['b'] : 0;
    $c = !empty($_POST['c']) ? $_POST['c'] : 0;

    if ($a == 0) {
      $calc = 'Day la phuong tring bac nhat 1 an.';

      if ($b == 0 && $c == 0) {
        $calc .= ' Phuong trinh co vo so nghiem';
      }

      if ($b == 0 && $c != 0) {
        $calc .= ' Phuong trinh vo nghiem';
      }

      if ($b != 0) {
        $calc .= ' Phuong trinh co nghiem x = ' . -($c / $b);
      }
    } else {
      $calc = 'Day la phuong tring bac hai 1 an.';
      $delta = $b**2 - 4 * $a * $c;
      if ($delta < 0) {
        $calc .= ' Phuong tring vo nghiem';
      } elseif ($delta == 0) {
        $calc .= ' Phuong trinh co nghiem kep x = ' . -($b / (2 * $a));
      } else {
        $calc .= ' Phuong trinh co 2 nghiem phan biet';
        $calc .= ' x1 = ' . -(($b + sqrt($delta)) / (2 * $a));
        $calc .= ' ,x2 = ' . -(($b - sqrt($delta)) / (2 * $a));
      }
    }
  }
?>
<form method="post">
  <input type="number" min="-100" max="100" name="a" value="<?php echo $a; ?>">x<sup>2</sup>
  + <input type="number" min="-100" max="100" name="b" value="<?php echo $b; ?>">x
  + <input type="number" min="-100" max="100" name="c" value="<?php echo $c; ?>"> = 0
  <br/>
  <br/>
  <input type="submit" name="calc" value="calc">
  <br/>
  <br/>
  <textarea cols="50" rows="10" readonly="" disabled><?php echo $calc; ?></textarea>
</form>
</body>
</html>
