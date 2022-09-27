<!doctype html>
<html class="no-js" lang="es">

<head>
    <meta charset="UTF-8">
    <title>DUKI | Panel de Control</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="img/logo1.ico"/>
    <!-- global styles-->
    <?= $this->Html->css(array('/admin/css/components','/admin/css/custom'))?>
    <!--end of global styles-->
    <?php echo $this->fetch('css');?>
    
</head>
<body onload="window.print()">
<?php echo $this->fetch('content'); ?>
<!-- global scripts-->
<?= $this->Html->script(array('/admin/js/components','/admin/js/custom'))?>
<!-- end of global scripts-->
<?php echo $this->fetch('script');?>
</body>
</html>