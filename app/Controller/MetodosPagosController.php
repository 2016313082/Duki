<?php
class MetodosPagosController extends AppController {
    
    var $name = 'MetodosPagos';

    const METHOD = 'aes-256-ctr';

    function beforeFilter(){
        parent::beforeFilter();
    }
    
    public function add(){
        if ($this->request->is('post')){
            $this->request->data['MetodosPago']['user_id'] = $this->Session->read('Auth.User.id');
            $this->request->data['MetodosPago']['cvv'] = $this->encrypt($this->request->data['MetodosPago']['cvv'],$this->encryptKey,true);
            $this->request->data['MetodosPago']['numero_tarjeta'] = $this->encrypt($this->request->data['MetodosPago']['numero_tarjeta'],$this->encryptKey,true);
            if($this->MetodosPago->save($this->request->data)){
                $this->Session->setFlash('Tu metodo de pago se ha registrado exitosamente','default',array('class'=>'success'));
                $this->redirect(array('action' => 'mi_cuenta','controller'=>'users'));
            }
       }
    }
	
	public function addViewPagar(){
        if ($this->request->is('post')){
            $this->request->data['MetodosPago']['user_id'] = $this->Session->read('Auth.User.id');
            $this->request->data['MetodosPago']['cvv'] = $this->encrypt($this->request->data['MetodosPago']['cvv'],$this->encryptKey,true);
            $this->request->data['MetodosPago']['numero_tarjeta'] = $this->encrypt($this->request->data['MetodosPago']['numero_tarjeta'],$this->encryptKey,true);
            if($this->MetodosPago->save($this->request->data)){
                $data['resultado'] = true;
            }else{
                $data['resultado'] = false;
            }
       }
        $this->response->type('json');
        $this->response->body(json_encode($data));
        return $this->response;
    }

    public function edit(){
        if ($this->request->is('post')){
            $this->request->data['MetodosPago']['cvv'] = $this->encrypt($this->request->data['MetodosPago']['cvv'],$this->encryptKey,true);
            if($this->MetodosPago->save($this->request->data)){
                $this->Session->setFlash('Tu metodo de pago se ha registrado exitosamente','default',array('class'=>'success'));
                $this->redirect(array('action' => 'mi_cuenta','controller'=>'users'));
            }
       }
    }

    public function pagar(){
        $tarjeta = $this->MetodosPago->read(null,4);
        $this->set('cvv',$this->decrypt($tarjeta['MetodosPago']['cvv'],$this->encryptKey,true));
        $this->set('numero_tarjeta',$this->decrypt($tarjeta['MetodosPago']['numero_tarjeta'],$this->encryptKey,true));
    }


    public static function encrypt($message, $key, $encode = false)
    {
        $nonceSize = openssl_cipher_iv_length(self::METHOD);
        $nonce = openssl_random_pseudo_bytes($nonceSize);

        $ciphertext = openssl_encrypt(
            $message,
            self::METHOD,
            $key,
            OPENSSL_RAW_DATA,
            $nonce
        );

        // Now let's pack the IV and the ciphertext together
        // Naively, we can just concatenate
        if ($encode) {
            return base64_encode($nonce.$ciphertext);
        }
        return $nonce.$ciphertext;
    }

    public static function decrypt($message, $key, $encoded = false)
    {
        if ($encoded) {
            $message = base64_decode($message, true);
            if ($message === false) {
                throw new Exception('Encryption failure');
            }
        }

        $nonceSize = openssl_cipher_iv_length(self::METHOD);
        $nonce = mb_substr($message, 0, $nonceSize, '8bit');
        $ciphertext = mb_substr($message, $nonceSize, null, '8bit');

        $plaintext = openssl_decrypt(
            $ciphertext,
            self::METHOD,
            $key,
            OPENSSL_RAW_DATA,
            $nonce
        );

        return $plaintext;
    }

    function delete($id = null) {
        if (!$id) {
            $this->Session->setFlash(__('MetodosPago invalida', true));
            $this->redirect(array('action'=>'index'));
        }
        if ($this->MetodosPago->delete($id)) {
            $this->Session->setFlash(__('La tarjeta ha sido eliminada exitosamente', true), 'default' ,array('class'=>'success'));
            $this->redirect(array('action' => 'mi_cuenta','controller'=>'users'));
        }
    }
}
?>