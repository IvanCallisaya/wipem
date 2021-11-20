<?php
namespace App\Http\Controllers\Donador;
use App\Http\Controllers\Controller;
use App\Models\PagoProyecto;

class PagoFacilCallback extends Controller
{

public function UrlCallback()
{
  $Venta = $_POST["PedidoId"];
  $Fecha =  $_POST["Fecha"];
  $nuevaFecha = date("Y-m-d", strtotime($Fecha));
  $Hora =  $_POST["Hora"];
  $MetodoPago =  $_POST["MetodoPago"];
  $Estado =  $_POST["Estado"];
  $ingreso=TRUE;  

  try{
    //-aqui veritico si tienen datos todos los parametros
    if( (isset ($Venta)) && (isset($Fecha)) && (isset($Hora)) && (isset($MetodoPago)) && (isset ($Estado)) )
    {
      //aqui verifica si existe la venta
      // el Mapi es un modelo que verifica si existe esa venta en la base de datos
      $laVentaObtenida = $this->Mapi->obtenerVenta($Venta);
      if(count($laVentaObtenida)<=0){
        $arreglo = array( 'error' =>1 , 'message' => 'No se encuentra la venta' , 'values' => FALSE );
        $ingreso = FALSE;
      }
      // aqui verifico si existe el metodo de pago que mando
      $metodopagoobtenido=$this->verificarmetodopago($MetodoPago);
      if(count($metodopagoobtenido) <=0)
      {
        $arreglo=array( 'error' =>1 , 'message' => 'No se encuentra la venta' , 'values' => FALSE );
      
      }
      if($ingreso == TRUE) 
      {
        // //aqui Llama at modelo Hapi y le manda los datos para cambiar el estado del pedido o venta 
        //metodo pagarventa actualiza los datos del ESTADO de esa venta o pedido en la base de datos
         $result=$this->pagarventa($Venta, $nuevaFecha, $MetodoPago, $Estado);
         if( $result == TRUE) {
           //Se guardo con exito
           $arreglo=array('error' => 0, 'status'=> 1, 'message' => "Pago realizado correctamente." , 'values'=> TRUE);
         }else {
          $arreglo=array('error' => 1, 'status'=> 1, 'message' => "No se pudo realizar el pago, por favor intente el pago, por intente de nuevo." , 'values'=> FALSE);
         }
      }
      } else {
        $arreglo=array('error' => 1, 'status'=> 1, 'message' => "Faltan datos." , 'values'=> FALSE);
        
      }
    }catch (\Throwable $th) {
      $arreglo = array('error' => 1, 'status' => 1, 'messageSistema' => "(TRY/CATCH]"  .$this->getMessage (), 'message'=> "No se pudo realizar el pago, por favor intente de nuevo. ", 'values'=>FALSE);
    }

    echo json_encode($arreglo);
  }
  
  public function obtenerVenta($venta) {
    $PagoProyecto =PagoProyecto::findOrFail($venta);
    return $PagoProyecto;
  }
  public function verificarmetodopago($MetodoPago) {
    if($MetodoPago >0 && $MetodoPago <=7) {
      return [1];
    }
    return [];
  }
  public function pagarventa($venta, $nuevaFecha, $metodoPago, $estado) {
    $PagoProyecto = PagoProyecto::find($venta);

    $PagoProyecto->fecha_pago = $nuevaFecha;
    $PagoProyecto->metodo_pago = $metodoPago;
    $PagoProyecto->estado = $estado;
    if(!$PagoProyecto->update())
        new \Exception('No se ha podido modificar la Carrera en la base de datos. Identificador Nº '.$venta);
    return $PagoProyecto;
  }
}









// if($result-TRUE){

// Sarregle-array('errore, 'status' 1. message Pago realizado correctamente." →TRUE); 'values' TRUE);

// Jelse(

// //existio algun error Sarreglowarray('error 1. 'status' - 1. No se pudo realizar el pago, por favor intente el pago, por intente de nuevo." values'FALSE

// )

// Jelse{

// Sarreglo-array('error 1, "status 1. 'essage "Faltan datos."values"FALSE): 'status'1.

// catch(Throwable Sth) (

// Sarreglo-array('error 1, 'status 1.'nessageSistema' (TRY/CATCH] .5th-getRessage (), message "No se pudo realizar el pago, por favor intente de nuevo. "values'FALSE):

// 54 )

// 51

// eche json_encode(Sarreglo)

