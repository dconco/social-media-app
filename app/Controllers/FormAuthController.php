<?php declare(strict_types=1);

namespace App\Controllers;

use PhpSlides\Http\Request;
use PhpSlides\Controller\Controller;

final class FormAuthController extends Controller
{
	private string $url;

	/**
	 * Handle Form Validation
	 */
	public function index()
	{
		session_start();
		$request = new Request();

		$data['email'] = $request->post('email');
		$data['password'] = $request->post('password');

		if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
			$data['err'] = 'Email is not in the correct format!';
		}
		if ($data['password'] === null || strlen($data['password']) < 6) {
			$data['err'] = 'The password must be greater than 5!';
		}

		$this->dataError($data);
		return (object) $data;
	}

	/**
	 * Handle Login Form Controller
	 */
	public function login()
	{
		$this->url = '/login';
		$data = $this->index();
		$db = new DatabaseController();

		return $db;
	}

	/**
	 * Handle Register Form Controller
	 */
	public function register()
	{
		/**
		 * Get the validated requests
		 */
		$this->url = '/register';
		$data = $this->index();
		$db = new DatabaseController();

/* Check if email is already existed */
		$user = $db->select(
			table: 'users',
			columns: 'email',
			where: "email='{$data->email}'"
		);

		if (!empty($user)) {
			$data['err'] = 'This Email has been used!';
			$this->dataError($data);
		}

		return $user;
	}

	private function dataError(array $data)
	{
		if (isset($data['err'])) {
			$query = base64_encode(serialize($data));
			header("Location: {$this->url}?q=$query");
			exit();
		}
	}
}
