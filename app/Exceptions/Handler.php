<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use App\Helpers\ResultManager;
use App\Helpers\ResponseManager;


class Handler extends ExceptionHandler
{
	protected $dontFlash = [
		'current_password',
		'password',
		'password_confirmation',
	];


	public function register(): void
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		$this->reportable(function (Throwable $e) {
			//
		});

	}


	public function render($oRequest, Throwable $oException)
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oResult	= [];
		$oResponse	= [];


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		if ( $oException instanceof NotFoundHttpException )
		{
			$oResult	= ResultManager::Result(2001, "global");
			$oResponse	= ResponseManager::Response($oResult, null);
		}
		else if( $oException instanceof MethodNotAllowedHttpException )
		{
			$oResult	= ResultManager::Result(2002, "global");
			$oResponse	= ResponseManager::Response($oResult, null);
		}
		else
		{
			$oResponse	= parent::render($oRequest, $oException);
		}


		//------------------------------------------------------------------------------
		//	RESPONSE
		//------------------------------------------------------------------------------
		return $oResponse;

	}
}
