<?php


namespace App\Core\Utils;


class CoreResponse
{
    public static $CODE_SUCCESSFUL = 0;
    public static $CODE_ERROR = 1;
    public static $CODE_WARNING = 2;

    private static $SUCCESSFUL = "OK";
    private static $WARNING = "WARNING";
    private static $ERROR = "ERROR";

    private static $MESSAGE_SUCCESSFUL = "Su solicitud se proceso con éxito.";
    private static $MESSAGE_ERROR = "Su solicitud no se pudo procesar intente nuevamente.";

    private static $STATUS_HTTP_OK = 200;
    private static $STATUS_HTTP_ERROR = 202;


    public static function formatResponse($response)
    {
        if($response['code'] == self::$CODE_SUCCESSFUL)
            return response(['status'=>self::$SUCCESSFUL, 'message'=>self::$MESSAGE_SUCCESSFUL, 'data'=>$response['data']], self::$STATUS_HTTP_OK);
        if($response['code'] == self::$CODE_WARNING)
            return response(['status'=>self::$WARNING, 'message'=>$response['error'], 'error'=>$response['error'], 'data'=>null], self::$STATUS_HTTP_ERROR);
        return response(['status'=>self::$ERROR, 'message'=>self::$MESSAGE_ERROR, 'error'=>$response['error'], 'data'=>null], self::$STATUS_HTTP_ERROR);
    }

    public static function responseView($response, $path)
    {
        if($response['code'] == self::$CODE_SUCCESSFUL)
            return view($path, ['data'=>$response['data'], 'message'=>self::$MESSAGE_SUCCESSFUL]);
        if($response['code'] == self::$CODE_WARNING)
            return redirect()->back()->withErrors($response['error']);
        return redirect()->back()->withErrors(self::$MESSAGE_ERROR);
    }

    public static function responseRoute($response, $path)
    {
        if($response['code'] == self::$CODE_SUCCESSFUL)
            return redirect()->route($path);
        if($response['code'] == self::$CODE_WARNING)
            return redirect()->back()->withErrors($response['error']);
        return redirect()->back()->withErrors(self::$MESSAGE_ERROR);
    }

}
