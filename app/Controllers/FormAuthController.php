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
	private function index()
	{
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
		return $data;
	}

	/**
	 * Handle Login Form Controller
	 */
	public function login()
	{
		$this->url = '/login';
		$data = $this->index();
		$db = new DatabaseController();

		/* Get the user information */
		$user = $db->select(
			table: 'users',
			where: "email='{$data['email']}'",
			columns: 'user_id, email, password'
		);

		if (empty($user)) {
			$data['err'] = 'No user with this Email!';
			$this->dataError($data);
		}

		$user = $user[0];
		$pwd_verify = password_verify($data['password'], $user['password']);

		if (!$pwd_verify) {
			$data['err'] = 'Incorrect Password!';
			$this->dataError($data);
		}

		$_SESSION['__uid'] = $user['user_id'];
		header('Location: /index');
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
			where: "email='{$data['email']}'"
		);

		if (!empty($user)) {
			$data['err'] = 'This Email has been used!';
			$this->dataError($data);
		}

		/* Generate a random user_id */
		$id = mt_rand(1111111111, 9999999999);
		$id .= mt_rand(1111111111, 9999999999);

		$data['user_id'] = (int) $id;
		$data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

		/* Insert the user information to the database */
		$res = $db->insert(table: 'users', data: $data);

		/* If the information is'nt processed in the database */
		if (!$res) {
			$data['err'] = 'There was an error processing the request!';
			$this->dataError($data);
		}

		/* If registered successful! */
		$_SESSION['__uid'] = $id;
		header('Location: /index');
	}

	private function dataError(array $data)
	{
		if (isset($data['err'])) {
			$query = base64_encode(serialize($data));
			$_SESSION['_query_token'] = $query;

			header("Location: {$this->url}");
			exit();
		}
	}
}
