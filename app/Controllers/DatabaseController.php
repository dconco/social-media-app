<?php declare(strict_types=1);

namespace App\Controllers;

use mysqli;
use PhpSlides\Exception;
use PhpSlides\Controller\Controller;

final class DatabaseController extends Controller
{
	private mysqli $connection;

	public function __construct()
	{
		$db_host = getenv('DB_HOST');
		$db_user = getenv('DB_USER');
		$db_pass = getenv('DB_PASS');
		$db_base = getenv('DB_BASE');
		$connection = new mysqli($db_host, $db_user, $db_pass, $db_base);

		if (!$connection || $connection->connect_error) {
			throw new Exception(
				'Error while connecting to Database: ' . $connection->connect_error
			);
		}
		echo 'connected successfully!';
	}
}
