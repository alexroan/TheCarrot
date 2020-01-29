<?php

namespace App\Exceptions;

use App\Mail\ExceptionOccured;
use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\Debug\Exception\FlattenException;
use Symfony\Component\Debug\ExceptionHandler as SymfonyExceptionHandler;

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
     * @param  \Exception $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        if ($this->shouldReport($exception)) {
            $this->sendEmail($exception); // sends an email
        }

        parent::report($exception);
    }

    /**
     * Send email
     *
     * @param Exception $exception
     */
    private function sendEmail(Exception $exception)
    {
        if (App::environment('local')) {
            return;
        }
        $error = FlattenException::create($exception);
        $handler = app(SymfonyExceptionHandler::class);
        $html = $handler->getHtml($error);
        $to = [
            [
                'email' => config('mail.from.address'),
                'name' => 'Signup Carrot'
            ]
        ];
        Mail::to($to)->send(new ExceptionOccured($html));
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Exception               $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        return parent::render($request, $exception);
    }
}
