
<div class="container wow fadeInDown" data-wow-duration="1s" data-wow-delay="0.5s">
    <div class="row">
        <div class="col-10 mx-auto">
            <div class="row">
                <div class="col-lg-4  col-md-8 col-sm-12  mx-auto login_image login_section login_section_top">
                    <div class="login_logo login_border_radius1">
                        <h3 class="text-center text-white">
                            <?= $this->Html->image('/admin/img/Isotipo-1.png',array('class'=>'admire_logo'))?>
                        </h3>
                    </div>
                    <div class="row m-t-20">
                        <div class="col-12">
                            <a class="text-success m-r-20 font_18">INICIAR SESIÓN</a>
                        </div>
                    </div>
                    <div class="m-t-15">
                        <?= $this->Form->create('User')?>
                            <div class="form-group">
                                <label for="email" class="col-form-label text-white">Usuario</label>
                                <?= $this->Form->input('email',array('class'=>'form-control b_r_20','label'=>false))?>
                            </div>
                            <div class="form-group">
                                <label for="password" class="col-form-label text-white">Password</label>
                                <?= $this->Form->input('password',array('class'=>'form-control b_r_20','label'=>false))?>
                            </div>
                            <div class="text-center login_bottom">
                                <button type="submit" class="btn btn-mint btn-block b_r_20 m-t-10 m-r-20">Iniciar Sesión</button>
                            </div>
                        <?= $this->Form->end()?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>