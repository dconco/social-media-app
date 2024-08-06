<?php declare(strict_types=1);

namespace App\Controllers;

use PhpSlides\Http\Request;
use PhpSlides\Controller\Controller;

final class FormAuthController extends Controller
{
	public function index()
	{
		session_start();
		$request = new Request();

		$data['email'] = $request->post('email');
		$data['password'] = $request->post('password');

		return (object) $data;
	}
	public function login()
	{
		return '';
	}
	public function register()
	{
		$data = $this->index();
		$db = new DatabaseController();
	}
}
