<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use App\Exceptions\BaseException;
use Illuminate\Support\Facades\Log;
class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
       // return parent::render($request, $exception);
        if(config('app.debug')){
            return parent::render($request, $exception);
        }else{
           return $this->handle($request, $exception);
        }
    }
    
    public function handle($request, Exception $e){
        // 只处理自定义的APIException异常
        if($e instanceof BaseException) {
            $result = [
                "msg"    => $e->msg,
                "errorcode" => $e->errorcode,
            ];            
            return response()->json($result,$e->code);
        }else{
            $this->code=500;
            $this->msg='服务器内部错误';
            $this->errorcode=99999;
            $this->errorLog($e);
        }
    }
    
    
    private function errorLog(\Exception $e){
        return Log::error($e->getMessage()); 
    }

}
