<?php
error_reporting (0);
$uri_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri_segments = explode('/', $uri_path);
if(json_encode($uri_segments[4]) == null){
	$segments = '';
}else{
	$segments = json_encode($uri_segments[4]);
}
?>
<script>
$(document).ready(function(){
	var eye = '<i class="fa fa-eye-slash" aria-hidden="true">';
	$('#eye').html(eye);
	var eyeLog = '<i class="fa fa-eye-slash" aria-hidden="true">';
	$('#eyeLog').html(eyeLog);
	var alerta = '';
	var nombre = "";
	var apPaterno = "";
	var celular = "";
	var password = "";
	var password_2 = "";
	
	$('#verPassLog').click(function () {
		if ($('#verPassLog').is(':checked')) {
			$('#eyeLog').html('');
			$('#pLog').attr('type', 'text');
			eyeLog = '<i class="fa fa-eye" aria-hidden="true"></i>';
		} else {
			$('#eyeLog').html('');
			$('#pLog').attr('type', 'password');
			eyeLog = '<i class="fa fa-eye-slash" aria-hidden="true">';
		}
		$('#eyeLog').html(eyeLog);
	});
	
	$('#verPass').click(function () {
		if ($('#verPass').is(':checked')) {
			$('#eye').html('');
			$('#p1').attr('type', 'text');
			$('#p2').attr('type', 'text');
			eye = '<i class="fa fa-eye" aria-hidden="true"></i>';
		} else {
			$('#eye').html('');
			$('#p1').attr('type', 'password');
			$('#p2').attr('type', 'password');
			eye = '<i class="fa fa-eye-slash" aria-hidden="true">';
		}
		$('#eye').html(eye);
	});
	var uri = <?= $segments ?>;
	if(uri == 1){
		$('#tab-login').removeClass('active');
		$('#lg1').removeClass('active');
		$('#tab-registro').addClass('active');
		$('#lg2').addClass('active');
	}
})
</script>
<section class="breadcrumb-area" style="background-image: url(../img/banners/banner_login.png)">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="breadcrumb-content">
                                <h1>Iniciar Sesión / Crear Cuenta</h1>
                                <ul class="breadcrumb-links">
                                    <li><?=$this->Html->link('Inicio',array('controller'=>'pages','action'=>'home'))?></li>
                                    <li>Iniciar Sesión / Crear Cuenta</li>
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
                                    <a id="tab-login" class="active" data-toggle="tab" href="#lg1">
                                        <h4>Iniciar Sesión</h4>
                                    </a>
                                    <a id="tab-registro" class="" data-toggle="tab" href="#lg2">
                                        <h4>Crear Cuenta</h4>
                                    </a>
                                </div>
                                <div class="tab-content">
                                    <div id="lg1" class="tab-pane active">
                                        <div class="login-form-container">
                                            <div class="login-register-form">
                                                <?= $this->Form->create('User',array('url'=>array('controller'=>'users','action'=>'login')))?>
                                                <?= $this->Form->input('email',array('required'=>true,'type'=>'email','placeholder'=>'Correo Electrónico','label'=>false))?>
                                                <?= $this->Form->input('password',array('required'=>true,'type'=>'password','placeholder'=>'Contraseña','label'=>false,'id'=>'pLog'))?>
												<div class="custom-control custom-switch">
												  <input type="checkbox" class="custom-control-input" id="verPassLog">
												  <label class="custom-control-label" for="verPassLog"><h5 id="eyeLog"></h5></label> 
												</div>
												<div class="button-box">
													<div class="login-toggle-btn">
														<?= $this->Html->link('Olvidé mi contraseña',array('controller'=>'users','action'=>'recuperar_password'))?>
													</div>
													<button type="submit"><span>Login</span></button>
												</div>
                                                <?= $this->Form->end()?>
                                            </div>
                                        </div>
                                    </div>
                                    <script>
                                        function validaPasswords(){  	 	 	 	
											var cadena = /[^a-zA-Z0-9]/;
											var cadenaNum = /^[0-9]+$/;
											$('#validador').html('');
											nombre = document.getElementById('nombres').value;
											apPaterno = document.getElementById('apPaterno').value;
											celular = document.getElementById('celular').value;
											password = document.getElementById('p1').value;
											password_2 = document.getElementById('p2').value;
											if(nombre.length < 3 || nombre.length > 20){
												alerta = '<div class="alert alert-danger" role="alert"><b>Error: </b>El nombre debe de ser mayor de 2 caracteres y menor a 20</div>'
												$('#validador').html(alerta);
												return false;
											}else if(apPaterno.length < 3 || apPaterno.length > 20){
												alerta = '<div class="alert alert-danger" role="alert"><b>Error: </b>El apellido paterno debe de ser mayor de 2 caracteres y menor a 20</div>'
												$('#validador').html(alerta);
												return false;
											}else if(celular.length != 10){
												alerta = '<div class="alert alert-danger" role="alert"><b>Error: </b>El numero de celular debe ser de 10 digitos</div>'
												$('#validador').html(alerta);
												return false;
											}else if(password.length < 8){ 
												alerta = '<div class="alert alert-danger" role="alert"><b>Error: </b>La contraseña debe de ser mayor a 8 digitos</div>'
												$('#validador').html(alerta);
												return false;
											}else if(cadena.test(password) == false){
												alerta = '<div class="alert alert-danger" role="alert"><b>Error: </b>La contraseña debe de tener mínimo un caracter especial</div>'
												$('#validador').html(alerta);
												return false;
											}else if(password != password_2){
												alerta = '<div class="alert alert-danger" role="alert"><b>Error: </b>Las contraseñas no coinciden</div>'
												$('#validador').html(alerta);
												return false;
											}
											if (document.getElementById('p1').value!="" && document.getElementById('p2').value!="" && document.getElementById('p1').value == document.getElementById('p2').value){
                                                if(document.getElementById('UserTyc').checked){
                                                    document.getElementById('submit_div').style.display='';
                                                }else{
                                                    document.getElementById('submit_div').style.display='none';
                                                    document.getElementById('tyc_aceptados').style.display='';
                                                }
											}
                                        } 
										 
                                    </script>
                                    <div id="lg2" class="tab-pane">
                                        <div class="login-form-container">
                                            <div class="login-register-form">
                                                <?= $this->Form->create('User',array('url'=>array('controller'=>'users','action'=>'crear_cuenta')))?>                                                
                                                <?= $this->Form->input('email',array('required'=>true,'type'=>'email','placeholder'=>'Correo Electrónico','label'=>false,'id'=>'mail'))?>
                                                <?= $this->Form->input('nombres',array('required'=>true,'type'=>'text','placeholder'=>'Nombres','label'=>false,'id'=>'nombres'))?>
                                                <?= $this->Form->input('apellido_paterno',array('required'=>true,'type'=>'text','placeholder'=>'Apellido Paterno','label'=>false,'id'=>'apPaterno'))?>
                                                <?= $this->Form->input('celular',array('required'=>true,'type'=>'number','placeholder'=>'Celular','label'=>false,'id'=>'celular'))?>
                                                <?= $this->Form->input('password',array('required'=>true,'type'=>'password','placeholder'=>'Contraseña','label'=>false,'id'=>'p1'))?>
                                                <?= $this->Form->input('password_2',array('required'=>true,'type'=>'password','placeholder'=>'Confirma Contraseña','label'=>false,'id'=>'p2','onchange'=>'javascript:validaPasswords()'))?>
												<div class="custom-control custom-switch">
												  <input type="checkbox" class="custom-control-input" id="verPass">
												  <label class="custom-control-label" for="verPass"><h5 id="eye"></h5></label> 
												</div>
                                                <?= $this->Form->input('tyc',array('required'=>true,'style'=>'height: 15px;width: 15px;','label'=>array('text'=>'Acepto los '.$this->Html->link('términos y condiciones',array('controller'=>'pages','action'=>'terminos'),array('target'=>'_blank')),'style'=>"margin-left:5px"),'type'=>"checkbox",'onclick'=>'javascript:validaPasswords()'))?>
                                                <div id="validador"></div>
                                                <div id="tyc_aceptados" class="warning-note" style="display:none">Debes Aceptar los Términos y Condiciones</div> 
                                                <div class="button-box" id='submit_div' style="display:none">
                                                    <button type="submit" id="validar_registro"><span>Crear Cuenta</span></button>
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
<script>
$('#validar_registro').on('click',function(){
	
	if($('#nombres').val().length() < 3 && $('#nombres').val().length() > 25){
		alert('El nombre debe de ser mayor a 3 caracteres y menor a 25');
		return;
	}else if($('#apPaterno').val().length() < 3 && $('#apPaterno').val().length() > 12){
		alert('El apellido paterno debe de ser mayor a 3 caracteres y menor a 12');
		return;
	}else if($('#apMaterno').val().length() < 3 && $('#apMaterno').val().length() > 12){
		alert('El apellido materno debe de ser mayor a 3 caracteres y menor a 12');
		return;
	}else if($('#celular').val().length() != 10){
		alert('El celular debe de ser mayor a 10 digitos');
		return;
	}else if($('#telefono').val().length() == ''){
		$('#telefono').val($('#celular').val());
	} 
})
</script>