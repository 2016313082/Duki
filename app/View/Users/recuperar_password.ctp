<section class="breadcrumb-area" style="background-image: url(../img/banners/banner_login.png)">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="breadcrumb-content">
                                <h1 class="breadcrumb-hrading">Recuperar Contraseña</h1>
                                <ul class="breadcrumb-links">
                                    <li><?=$this->Html->link('Inicio',array('controller'=>'pages','action'=>'home'))?></li>
                                    <li>Recuperar Contraseña</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Breadcrumb Area End -->
            <!-- login area start -->
            <div class="login-register-area mb-60px mt-53px">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-7 col-md-12 ml-auto mr-auto">
                            <div class="login-register-wrapper">
                                <div class="login-register-tab-list nav">
                                    <a class="active" data-toggle="tab" href="#lg1">
                                        <h4>Solicitar nueva contraseña</h4>
                                    </a>
                                </div>
                                <div class="tab-content">
                                    <div id="lg1" class="tab-pane active">
                                        <div class="login-form-container">
                                            <div class="login-register-form">
                                                <?= $this->Form->create('User')?>
                                                <?= $this->Form->input('email',array('required'=>true,'type'=>'email','placeholder'=>'Correo Electrónico','label'=>'Ingresa el email asociado a tu cuenta. Tu nueva contraseña se enviará al correo ingresado.'))?>
                                                <div class="button-box">
                                                    <button type="submit"><span>Solicitar nueva contraseña</span></button>
                                                </div>
                                                <?= $this->Form->end()?>
                                            </div>
                                        </div>
                                    </div>
                                    <script>
                                        function validaPasswords(){
                                            //alert(document.getElementById('p1').value == document.getElementById('p2').value);
                                            if (document.getElementById('p1').value == document.getElementById('p2').value){
                                                document.getElementById('submit_div').style.display='';
                                                document.getElementById('no_coinciden').style.display='none';
                                            }else{
                                                document.getElementById('submit_div').style.display='none';
                                                document.getElementById('no_coinciden').style.display='';
                                            }
                                        }
                                    </script>
                                    <div id="lg2" class="tab-pane">
                                        <div class="login-form-container">
                                            <div class="login-register-form">
                                                <?= $this->Form->create('User',array('url'=>array('controller'=>'users','action'=>'crear_cuenta')))?>                                                
                                                <?= $this->Form->input('email',array('required'=>true,'type'=>'email','placeholder'=>'Correo Electrónico','label'=>false))?>
                                                <?= $this->Form->input('nombres',array('required'=>true,'type'=>'text','placeholder'=>'Nombres','label'=>false))?>
                                                <?= $this->Form->input('apellido_paterno',array('required'=>true,'type'=>'text','placeholder'=>'Apellido Paterno','label'=>false))?>
                                                <?= $this->Form->input('apellido_materno',array('required'=>true,'type'=>'text','placeholder'=>'Apellido Materno','label'=>false))?>
                                                <?= $this->Form->input('password',array('required'=>true,'type'=>'password','placeholder'=>'Contraseña','label'=>false,'id'=>'p1'))?>
                                                <?= $this->Form->input('password_2',array('required'=>true,'type'=>'password','placeholder'=>'Confirma Contraseña','label'=>false,'id'=>'p2','onchange'=>'javascript:validaPasswords()'))?>
                                                <div id="no_coinciden" class="warning-note" style="display:none">Las Contraseñas no coinciden</div>
                                                <div class="button-box" id='submit_div' style="display:none">
                                                    <button type="submit"><span>Crear Cuenta</span></button>
                                                </div>
                                                <?= $this->Form->end()?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>