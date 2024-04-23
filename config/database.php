<?php
	class Database{
		private static function connect(){
			$config = parse_ini_file('.env');

			$conn = new PDO('mysql:host=' . $config['DB_HOST'] . ';port=' . $config['DB_PORT'] . ';dbname=' . $config['DB_NAME'], $config['DB_USERNAME'], $config['DB_PASSWORD']);
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			return $conn;
		}
		
		public static function execute_query($query, $params){
			$conn = self::connect();

			try {
				$stmt = $conn->prepare($query);

				if ($params !== null) {
					foreach($params as $key => $value) {
						$stmt->bindValue(":{$key}", $value);
					}
				}

				if (!$stmt->execute()) {
					throw new Exception("Failed to execute query");
				}

				$numRows = $stmt->rowCount();
				$result = ['success' => true, 'data' => []];

				if ($numRows > 0) {
					if ($numRows === 1) {
						$result['data'] = $stmt->fetch(PDO::FETCH_ASSOC);
					} else {
						$result['data'] = $stmt->fetchAll(PDO::FETCH_ASSOC);
					}
				}

				return $result;
			} catch(Exception $e) {
				http_response_code(400);
				$result = ['success' => false, 'message' => $e->getMessage()];
				die(json_encode($result));
			}
		}
	}