<?php

namespace App\Exceptions;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Session\TokenMismatchException;
use Throwable;

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
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
        });
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request                   $request
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $e)
    {
        if ($request->is('api/*')) {
            $response = [
                'success' => false,
                'message' => $e->getMessage(),
            ];
            if (is_object($e) && method_exists($e, 'errors')) {
                $response['errors'] = $e->errors();
            }
            if (config('app.debug')) {
                $response['detail'] = $e;
            }
            // Set an appropriate status code
            $status = match (true) {
                $e instanceof AuthenticationException => 401,
                $e instanceof AuthorizationException  => 403,
                $e instanceof ModelNotFoundException  => 404,
                $e instanceof TokenMismatchException  => 419,
                default                               => 400,
            };

            return response()->json($response, $status);
        }

        return parent::render($request, $e);
    }
}
