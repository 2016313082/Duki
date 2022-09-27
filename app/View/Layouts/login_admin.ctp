<!DOCTYPE html>
<html>
<head>
    <title>Login 2 | Admire</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="shortcut icon" href="img/logo1.ico"/>
    <!--Global styles -->
    <?= $this->Html->css('/admin/css/components')?>
    <?= $this->Html->css('/admin/css/custom')?>
    <!--End of Global styles -->
    <!--Plugin styles-->
    <?= $this->Html->css('/admin/vendors/bootstrapvalidator/css/bootstrapValidator.min')?>
    <?= $this->Html->css('/admin/vendors/wow/css/animate')?>
    <!--End of Plugin styles-->
    <?= $this->Html->css('/admin/css/pages/login2')?>
</head>
<body class="login_background">
<div class="preloader" style=" position: fixed;
  width: 100%;
  height: 100%;
  top: 0;
  left: 0;
  z-index: 100000;
  backface-visibility: hidden;
  background: #ffffff;">
    <div class="preloader_img" style="width: 200px;
  height: 200px;
  position: absolute;
  left: 48%;
  top: 48%;
  background-position: center;
z-index: 999999">
        <?= $this->Html->image('/admin/img/loader.gif',array('style'=>'width: 40px;','alt'=>'Cargando....'))?>
    </div>
</div>

    <?php echo $this->Flash->render(); ?>
    <?php echo $this->fetch('content'); ?>

    <!-- global js -->
<?php
    echo $this->Html->script(
        array(
            '/admin/js/jquery.min',
            '/admin/js/index',
            '/admin/js/bootstrap.min',
            '/admin/vendors/bootstrapvalidator/js/bootstrapValidator.min',
            '/admin/vendors/wow/js/wow.min',
            '/admin/vendors/jquery.backstretch/js/jquery.backstretch',
            '/admin/js/pages/login2'
        )
    );
?>
</body>

</html>