<?php
namespace App\Http\Controllers\Donador;
use App\Http\Controllers\Controller;

class PagoFacilCheckoutClient extends Controller
{
    
    public function inicio(){
        
        return view('PagoFacilCheckout');
    }


    public function Encript(){

        parse_str( $_POST['goFormularioCliente'], $loFormDatos);
		 // campos del formulario del cliente
		 $lcPedidoID=$loFormDatos['Proyecto'] ;
		 $lcEmail= $loFormDatos['Email'] ;
		 $lnTelefono=$loFormDatos['Celular'] ;
		 $lnMonto=$loFormDatos['Monto'] ; 
		 $lcMoneda=$loFormDatos['MonedaVenta'] ;
		 $lcParametro1="https://wipem.com.bo/CallBack";
		 $lcParametro2="https://wipem.com.bo/PagoRealizado";

         //  aqui vendra el listado de productos que viene en la compra , 
         //en caso de que no tenga , solo se colocara el producto   a vender 
         //es un arrar de objetos el cual se le aplica un json_encode(Propio de php)
		 $laProduct_Detalle=array(
            "Producto"=>$loFormDatos['slug'] ,
            );
        $lcParametro3= json_encode($laProduct_Detalle);
         $lcParametro4="11";// este parametro es estatco para este tipo de integracion se debe mantener en 11 nomas
		$tcCommerceID ="9bdb2af6799204a299c603994b8e400e4b1fd625efdb74066cc869fee42c9df3";
        $lcTokenServicio="51247fae280c20410824977b0781453df59fad5b23bf2a0d14e884482f91e09078dbe5966e0b970ba696ec4caf9aa5661802935f86717c481f1670e63f35d50442fe895d1fe73fd015131d087428f3be32ae5e41461d5675d86e9aebe10f30ddb03676866103f0dc9a8317adf9b8829fd3d8399bbc4723afd35965830b60845b";
        $lcTokenSecret="971B209E94134097AB891AA6";
        
        try {
            
            $lcCadenaAFirmar= "$lcTokenServicio|$lcEmail|$lnTelefono|$lcPedidoID|$lnMonto|$lcMoneda|$lcParametro1|$lcParametro2|$lcParametro3|$lcParametro4" ;
		 
            // aqui se genera la firma  con la variable $lcCadenaAFirmar
            $lcFirma= hash('sha256', $lcCadenaAFirmar);
    
            // aqui  se concatena de nuevo pero utilizando la firma al comienzo 
            $lcDatosPago="$lcFirma|$lcEmail|$lnTelefono|$lcPedidoID|$lnMonto|$lcMoneda|$lcParametro1|$lcParametro2|$lcParametro3|$lcParametro4" ;
            
            //Esto es el proceso de encriptacion que ocupa php 
            $lnSizeDatosPago=strlen($lcDatosPago);

            $lcDatosPago=str_pad($lcDatosPago,($lnSizeDatosPago+8-($lnSizeDatosPago%8)), "\0");
            //aqui se genera y se guarda  la variable tcparametros, resultado de la encriptacion de los datos con 3DES

            $tcParametros =   openssl_encrypt($lcDatosPago, "DES-EDE3", $lcTokenSecret ,OPENSSL_ZERO_PADDING);

            $laData['tcParametros']= base64_encode($tcParametros);
            $laData['tcCommerceID']=$tcCommerceID;
            //este codigo solo sirve para verificar si lo que estan encriptando esta bien 
            $tcParametrosDesencriptado= openssl_decrypt($tcParametros, 'DES-EDE3', $lcTokenSecret,  OPENSSL_ZERO_PADDING);
            $laData['tcParametrosDesencriptado']= $tcParametrosDesencriptado;
            ///////////////////////////////////////////////////////////////////////////
            return response()->json($laData);
        } catch (\Throwable $th) {
            return null;
        }
    }
}
