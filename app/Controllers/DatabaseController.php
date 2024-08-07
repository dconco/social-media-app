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
		$this->connection = new mysqli($db_host, $db_user, $db_pass, $db_base);

		if (!$this->connection || $this->connection->connect_error) {
			throw new Exception(
				'Error while connecting to Database: ' .
					$this->connection->connect_error
			);
		}
	}

	public function insert(string $table, array $data): bool
	{
		$columns = implode(', ', array_keys($data));
		$values = implode(
			', ',
			array_map([$this, 'quoteValue'], array_values($data))
		);
		$query = "INSERT INTO $table ($columns) VALUES ($values)";

		return $this->executeQuery($query);
	}

	public function update(string $table, array $data, string $where): bool
	{
		$set = implode(
			', ',
			array_map(
				function ($key, $value) {
					return "$key = " . $this->quoteValue($value);
				},
				array_keys($data),
				$data
			)
		);

		$query = "UPDATE $table SET $set WHERE $where";

		return $this->executeQuery($query);
	}

	public function delete(string $table, string $where): bool
	{
		$query = "DELETE FROM $table WHERE $where";

		return $this->executeQuery($query);
	}

	public function select(
		string $table,
		string $where = '1',
		string $columns = '*'
	): array {
		$query = "SELECT $columns FROM $table WHERE $where";
		$result = $this->connection->query($query);

		if ($result === false) {
			throw new Exception(
				'Error executing query: ' . $this->connection->error
			);
		}

		$data = [];
		while ($row = $result->fetch_assoc()) {
			$data[] = $row;
		}

		return $data;
	}

	private function quoteValue($value): string
	{
		return "'" . $this->connection->real_escape_string((string) $value) . "'";
	}

	private function executeQuery(string $query): bool
	{
		if ($this->connection->query($query) === true) {
			return true;
		} else {
			throw new Exception(
				'Error executing query: ' . $this->connection->error
			);
		}
	}

	public function __destruct()
	{
		$this->connection->close();
	}
}
?>
