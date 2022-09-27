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
	<?= $this->Html->script('plugins/jquery.min.js'); ?>
    <script>var base_url = "<?= Router::url('/', true); ?>"; </script>
	<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="fixedNav_position fixedMenu_left">

<div id="wrap">
    <div id="top" class="fixed">
        <!-- .navbar -->
        <nav class="navbar navbar-static-top">
            <div class="container-fluid m-0">
                <?= $this->Html->image('logo/logo.png',array('class'=>'admin_img'))?>
                <div class="menu mr-sm-auto">
                    <span class="toggle-left" id="menu-toggle">
                        <i class="fa fa-bars"></i>
                    </span>
                </div>
                <div class="topnav dropdown-menu-right">
                   <div class="btn-group">
                        <div class="user-settings no-bg">
                            <button type="button" class="btn btn-default no-bg micheal_btn" data-toggle="dropdown">
                                <img src="img/admin.jpg" class="admin_img2 img-thumbnail rounded-circle avatar-img"
                                     alt="avatar"> <strong><?= $this->Session->read('Auth.User.nombres')?></strong>
                                <span class="fa fa-sort-down white_bg"></span>
                            </button>
                            <div class="dropdown-menu admire_admin">
                                <?= $this->Html->link('<i class="fa fa-lock"></i> Cambiar Password',array('controller'=>'users','action'=>'edit_password_admin'),array('class'=>'dropdown-item','escape'=>false))?>
                                <?= $this->Html->link('<i class="fa fa-sign-out"></i> Cerrar Sesión',array('controller'=>'users','action'=>'logout'),array('class'=>'dropdown-item','escape'=>false))?>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <!-- /.container-fluid -->
        </nav>
        <!-- /.navbar -->
        <!-- /.head -->
    </div>
    <!-- /#top -->
    <div class="wrapper fixedNav_top">
        <div id="left" class="fixed">
            <div class="menu_scroll left_scrolled">
                <ul id="menu">
                    <?php if($this->Session->read('Auth.User.link_clientes')==1){?>
                        <li>
                            <?= $this->Html->link('<i class="fa fa-user"></i><span class="link-title menu_hide">&nbsp;Clientes</span>',array('controller'=>'users','action'=>'clientes'),array('escape'=>false)) ?>
                        </li>
                    <?php } ?>
                    <?php if($this->Session->read('Auth.User.link_productos')==1){?>
                    <li>
                        <?= $this->Html->link('<i class="fa fa-cubes"></i><span class="link-title menu_hide">&nbsp;Productos</span>',array('controller'=>'productos','action'=>'index'),array('escape'=>false)) ?>
                    </li>
                    <?php } ?>
                    <li class="dropdown_menu">
                    <?= $this->Html->link('<i class="fa fa-file-text"></i><span class="link-title menu_hide">&nbsp;Pedidos</span><span class="fa arrow menu_hide"></span>','javascript:;',array('escape'=>false)) ?>
                        <ul class="sub-menu">
                            <li><?= $this->Html->link('<i class="fa fa-file-text"></i><span class="link-title menu_hide">&nbsp;Ver todos los Pedidos</span>',array('controller'=>'pedidos','action'=>'index'),array('escape'=>false)) ?></li>
                            <?php if($this->Session->read('Auth.User.p2')==1){?>
                                <li><?= $this->Html->link('<i class="fa fa-file-text"></i><span class="link-title menu_hide">&nbsp;Pedidos por Confirmar</span>',array('controller'=>'pedidos','action'=>'index',2),array('escape'=>false)) ?></li>
                            <?php } ?>
                            <?php if($this->Session->read('Auth.User.p2')==1){?>
                                <li><?= $this->Html->link('<i class="fa fa-file-text"></i><span class="link-title menu_hide">&nbsp;Pedidos por Surtir</span>',array('controller'=>'pedidos','action'=>'index',3),array('escape'=>false)) ?></li>
                            <?php } ?>
                            <?php if($this->Session->read('Auth.User.p3')==1){?>
                                <li><?= $this->Html->link('<i class="fa fa-file-text"></i><span class="link-title menu_hide">&nbsp;Pedidos por Enviar</span>',array('controller'=>'pedidos','action'=>'index',4),array('escape'=>false)) ?></li>
                            <?php } ?>
                            <?php if($this->Session->read('Auth.User.p4')==1){?>
                                <li><?= $this->Html->link('<i class="fa fa-file-text"></i><span class="link-title menu_hide">&nbsp;Pedidos Enviados</span>',array('controller'=>'pedidos','action'=>'index',5),array('escape'=>false)) ?></li>
                            <?php } ?>
                            <?php if($this->Session->read('Auth.User.p5')==1){?>
                                <li><?= $this->Html->link('<i class="fa fa-file-text"></i><span class="link-title menu_hide">&nbsp;Pedidos Finalizados</span>',array('controller'=>'pedidos','action'=>'index',6),array('escape'=>false)) ?></li>
                            <?php } ?>
                            <?php if($this->Session->read('Auth.User.p6')==1){?>
                                <li><?= $this->Html->link('<i class="fa fa-file-text"></i><span class="link-title menu_hide">&nbsp;Pedidos Cancelados</span>',array('controller'=>'pedidos','action'=>'index',9),array('escape'=>false)) ?></li>
                            <?php } ?>
                        </ul>
                    </li>
                    
                    <?php if($this->Session->read('Auth.User.link_cupones')==1){?>
                        <li>
                            <?= $this->Html->link('<i class="fa fa-ticket"></i><span class="link-title menu_hide">&nbsp;Cupones</span>',array('controller'=>'cupons','action'=>'index'),array('escape'=>false)) ?>
                        </li>
                    <?php } ?>
                    <?php if($this->Session->read('Auth.User.link_banners')==1){?>
                        <li>
                            <?= $this->Html->link('<i class="fa fa-file-image-o"></i><span class="link-title menu_hide">&nbsp;Banners</span>',array('controller'=>'banners','action'=>'index'),array('escape'=>false)) ?>
                        </li>
                    <?php } ?>
                    <?php if($this->Session->read('Auth.User.link_newsletters')==1){?>
                        <li>
                            <?= $this->Html->link('<i class="fa fa-group"></i><span class="link-title menu_hide">&nbsp;Inscritos Newsletters</span>',array('controller'=>'newsletters','action'=>'index'),array('escape'=>false)) ?>
                        </li>
                    <?php } ?>
                    <?php if($this->Session->read('Auth.User.link_usuarios')==1){?>
                        <li>
                            <?= $this->Html->link('<i class="fa fa-group"></i><span class="link-title menu_hide">&nbsp;Administrar Usuarios</span>',array('controller'=>'users','action'=>'index'),array('escape'=>false)) ?>
                        </li>
                    <?php } ?>
					<?php if($this->Session->read('Auth.User.link_categorias')==1){?>
                        <li>
                            <?= $this->Html->link('<i class="fa fa-tags" aria-hidden="true"></i><span class="link-title menu_hide">&nbsp;Categorias</span>',array('controller'=>'categorias','action'=>'categorias_view'),array('escape'=>false)) ?>
                        </li>
                    <?php } ?>
					<?php if($this->Session->read('Auth.User.link_mercadito')==1){?>
                        <li>
                            <?= $this->Html->link('<i class="fa fa-shopping-basket" aria-hidden="true"></i><span class="link-title menu_hide">&nbsp;Mercadito</span>',array('controller'=>'productos','action'=>'promociones_view'),array('escape'=>false)) ?>
                        </li>
                    <?php } ?>
					
					<?php if($this->Session->read('Auth.User.link_cps')==1){?>
                        <li>
                            <?= $this->Html->link('<i class="fa fa-map-marker" aria-hidden="true"></i><span class="link-title menu_hide">&nbsp;Codigos Postales</span>',array('controller'=>'cps','action'=>'cps_view'),array('escape'=>false)) ?>
                        </li>
                    <?php } ?>
					
					<?php if($this->Session->read('Auth.User.link_configuracion')==1){?>
                        <li>
                            <?= $this->Html->link('<i class="fa fa-cog" aria-hidden="true"></i><span class="link-title menu_hide">&nbsp;Configuracion</span>',array('controller'=>'configuracion','action'=>'configuracion_view'),array('escape'=>false)) ?>
                        </li>
                    <?php } ?>
					
                </ul>
                <!-- /#menu -->
            </div>
        </div>
        <!-- /#left -->

        <?php echo $this->Flash->render(); ?>
		<?php echo $this->fetch('content'); ?>

        </div>
    <!--wrapper-->
    <div id="request_list">
        <div class="request_scrollable">
            <ul class="nav nav-tabs m-t-15">
                <li class="nav-item">
                    <a class="nav-link active text-center" href="#settings" data-toggle="tab">Settings</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-center" href="#favourites" data-toggle="tab">Favorites</a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="settings">
                    <div id="settings_section">
                        <div class="layout_styles mx-3">
                            <div class="row">
                                <div class="col-12 m-t-35">
                                    <h4>Layout settings</h4>
                                </div>
                            </div>
                            <form autocomplete="off">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="float-left m-t-20">Fixed Header</div>
                                        <div class="float-right m-t-15">
                                            <div id="setting_fixed_nav">
                                                <input class="make-switch" data-on-text="ON" data-off-text="OFF" type="checkbox"
                                                       data-size="small" checked>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="float-left m-t-20">Fixed Menu</div>
                                        <div class="float-right m-t-15">
                                            <div id="setting_fixed_menunav">
                                                <input class="make-switch" data-on-text="ON" data-off-text="OFF" name="radioBox" type="checkbox"
                                                       data-size="small" checked>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <div class="float-left m-t-20">No Breadcrumb</div>
                                        <div class="float-right m-t-15">
                                            <div id="setting_breadcrumb">
                                                <input class="make-switch" data-on-text="ON" data-off-text="OFF" type="checkbox"
                                                       data-size="small">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="mx-3">
                            <div class="row">
                                <div class="col-12 m-t-35">
                                    <h4 class="setting_title">General Settings</h4>
                                </div>
                            </div>
                            <div class="data m-t-5">
                                <div class="row">
                                    <div class="col-2"><i class="fa fa-bell-o setting_ions text-info"></i></div>
                                    <div class="col-7">
                                        <span class="chat_name">Notifications</span><br/>
                                        Get new notifications
                                    </div>
                                    <div class="col-2 checkbox float-right">
                                        <label class="text-info">
                                            <input type="checkbox" value="" checked>
                                            <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="data">
                                <div class="row">
                                    <div class="col-2"><i class="fa fa-envelope-o setting_ions text-danger"></i>
                                    </div>
                                    <div class="col-7">
                                        <span class="chat_name">Messages</span><br/>
                                        Get new messages
                                    </div>
                                    <div class="col-2 checkbox float-right">
                                        <label class="text-danger">
                                            <input type="checkbox" value="" checked>
                                            <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="data">
                                <div class="row">
                                    <div class="col-2">
                                        <i class="fa fa-exclamation-triangle setting_ions text-warning"></i>
                                    </div>
                                    <div class="col-7">
                                        <span class="chat_name">Warnings</span><br/>
                                        Get new warnings
                                    </div>
                                    <div class="col-2 checkbox float-right">
                                        <label class="text-warning">
                                            <input type="checkbox" value="" checked>
                                            <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="data">
                                <div class="row">
                                    <div class="col-2">
                                        <i class="fa fa-calendar texlayout_stylest-primary setting_ions"></i>
                                    </div>
                                    <div class="col-7">
                                        <span class="chat_name">Events</span><br/>
                                        Show new events
                                    </div>
                                    <div class="col-2 checkbox float-right">
                                        <label class="text-primary">
                                            <input type="checkbox" value="" >
                                            <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="favourites">
                    <div id="requests" class="mx-3">
                        <div class="m-t-35">
                            <h4 class="setting_title">Favorites</h4>
                        </div>
                        <div class="data m-t-10">
                            <div class="row">
                                <div class="col-2">
                                    <img src="img/images1.jpg" class="message-img avatar rounded-circle" alt="avatar1"></div>
                                <div class="col-8 message-data"><span class="chat_name">Philip J. Webb</span><br/>
                                    Available
                                </div>
                                <div class="col-1">
                                    <i class="fa fa-circle text-success"></i>
                                </div>
                            </div>
                        </div>
                        <div class="data">
                            <div class="row">
                                <div class="col-2">
                                    <img src="img/mailbox_imgs/8.jpg" class="message-img avatar rounded-circle" alt="avatar1">
                                </div>
                                <div class="col-8 message-data">
                                    <span class="chat_name">Nancy T. Strozier</span><br/>
                                    Away
                                </div>
                                <div class="col-1">
                                    <i class="fa fa-circle text-warning"></i>
                                </div>
                            </div>
                        </div>
                        <div class="data">
                            <div class="row">
                                <div class="col-2">
                                    <img src="img/mailbox_imgs/3.jpg" class="message-img avatar rounded-circle" alt="avatar1">
                                </div>
                                <div class="col-8 message-data">
                                    <span class="chat_name">Robbinson</span><br/>
                                    Offline
                                </div>
                                <div class="col-1">
                                    <i class="fa fa-circle"></i>
                                </div>
                            </div>
                        </div>
                        <h4 class="setting_title">Contacts</h4>
                        <div class="data m-t-10">
                            <div class="row">
                                <div class="col-2">
                                    <img src="img/mailbox_imgs/7.jpg" class="message-img avatar rounded-circle" alt="avatar1">
                                </div>
                                <div class="col-8 message-data">
                                    <span class="chat_name">Chester Hardesty</span><br/>
                                    Busy
                                </div>
                                <div class="col-1">
                                    <i class="fa fa-circle text-warning"></i>
                                </div>
                            </div>
                        </div>
                        <div class="data">
                            <div class="row">
                                <div class="col-2">
                                    <img src="img/mailbox_imgs/2.jpg" class="message-img avatar rounded-circle"
                                         alt="avatar1"></div>
                                <div class="col-8 message-data">
                                    <span class="chat_name">Peter</span><br/>
                                    Online
                                </div>
                                <div class="col-1">
                                    <i class="fa fa-circle text-warning"></i>
                                </div>
                            </div>
                        </div>
                        <div class="data">
                            <div class="row">
                                <div class="col-2">
                                    <img src="img/mailbox_imgs/6.jpg" class="message-img avatar rounded-circle" alt="avatar1">
                                </div>
                                <div class="col-8 message-data">
                                    <span class="chat_name">Devin Hartsell</span><br/>
                                    Available
                                </div>
                                <div class="col-1">
                                    <i class="fa fa-circle text-success"></i>
                                </div>
                            </div>
                        </div>
                        <div class="data">
                            <div class="row">
                                <div class="col-2">
                                    <img src="img/mailbox_imgs/4.jpg" class="message-img avatar rounded-circle"
                                         alt="avatar1"></div>
                                <div class="col-8 message-data">
                                    <span class="chat_name">Kimy Zorda</span><br/>
                                    Available
                                </div>
                                <div class="col-1">
                                    <i class="fa fa-circle text-success"></i>
                                </div>
                            </div>
                        </div>
                        <div class="data">
                            <div class="row">
                                <div class="col-2">
                                    <img src="img/mailbox_imgs/5.jpg" class="message-img avatar rounded-circle"
                                         alt="avatar1"></div>
                                <div class="col-8 message-data">
                                    <span class="chat_name">Jessica Bell</span><br/>
                                    Offline
                                </div>
                                <div class="col-1">
                                    <i class="fa fa-circle"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /#wrap -->


<!-- global scripts-->
<?= $this->Html->script(array('/admin/js/components','/admin/js/custom'))?>
<!-- end of global scripts-->
<?php echo $this->fetch('script');?>
</body>
</html>