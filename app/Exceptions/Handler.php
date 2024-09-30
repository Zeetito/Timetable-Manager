<?php

namespace App\Exceptions;

use Throwable;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];


        /**
         * Render an exception into an HTTP response.
         *
         * @param  \Illuminate\Http\Request  $request
         * @param  \Throwable  $exception
         * @return \Illuminate\Http\Response
         */
    // public function render($request, Throwable $exception)
    // {
    //     // Handle 404 errors (Model or Route not found)
    //     if ($exception instanceof ModelNotFoundException || $exception instanceof NotFoundHttpException) {
    //         return response()->json([
    //             'error' => 'Resource not found',
    //             'message' => 'The requested resource could not be found on the server.'
    //         ], 404);
    //     }

    //     // Handle 500 Internal Server Error (for any unhandled server-side errors)
    //     if ($exception instanceof \Exception) {
    //         return response()->json([
    //             'error' => 'Internal Server Error',
    //             'message' => 'Something went wrong on the server. Please try again later.'
    //         ], 500);
    //     }

    //     // For all other exceptions, call the parent render method
    //     return parent::render($request, $exception);
    // }
    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }


}
