<?php /* the php */ ?>
<?php
print_r($_POST) ;
?>


 <?php /* and the html */ ?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>teszt</title>
    </head>
    <body>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
            <textarea id="contact_list" name="contact_list"></textarea>
            <input type="submit" name="submit" value="Send" id="submit"/>
        </form>
    </body>
</html>
