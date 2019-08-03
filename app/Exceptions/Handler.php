<?php

namespace App\Exceptions;

use App\Http\Middleware\Authenticate;
use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;

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
        // return just the first error
      if($request->isJson()){
          $message = $exception->getMessage();
          $status = 500;
          if($exception instanceof  ValidationException){
              $message = $exception->validator->errors()->first();
              $status = STATUS_INVALID_VALIDATION;
          }
          return response()->api($message , $status);
      }
        return parent::render($request, $exception);
    }
}
