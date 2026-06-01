<?php

declare(strict_types=1);

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

class BaseController extends Controller
{
	protected $helpers = [];

	public function initController(
		RequestInterface $request,
		ResponseInterface $response,
		LoggerInterface $logger
	): void {
		parent::initController($request, $response, $logger);
	}

	/**
	 * Renderiza el layout completo: html_top + vista + html_bottom.
	 */
	protected function renderLayout(string $view, array $data = []): string
	{
		return view('@shell/html_top', $data)
			 . view($view, $data)
			 . view('@shell/html_bottom');
	}
}
