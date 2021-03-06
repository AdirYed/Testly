<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Exception\RouteNotFoundException;
use Throwable;

class Handler extends ExceptionHandler
{
  /**
   * A list of the exception types that are not reported.
   *
   * @var array
   */
  protected $dontReport = [
    ModelNotFoundException::class,
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
   * @param \Exception $exception
   * @throws Exception
   */
  public function report(Throwable $exception)
  {
    parent::report($exception);
  }

  /**
   * Render an exception into an HTTP response.
   *
   * @param \Illuminate\Http\Request $request
   * @param \Exception $exception
   *
   * @return \Illuminate\Http\Response|\Symfony\Component\HttpFoundation\Response
   * @throws Exception
   */
  public function render($request, Throwable $exception)
  {
    if (in_array('api', $request->route()->middleware())) {
      $request->headers->add([
        'Accept' => 'application/json',
        'Content-Type' => 'application/json',
      ]);
    }

    if ($exception instanceof NotFoundHttpException || $exception instanceof ModelNotFoundException || $exception instanceof RouteNotFoundException) {
      return response()->view('app');
    }

    return parent::render($request, $exception);
  }
}
