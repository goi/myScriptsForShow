<?php
if(!class_exists('Database')){
	
class Database extends PDO {
	
    private $host      = HOST;
    private $user      = USER;
    private $pass      = PASSWORD;
    private $dbname    = DB;
 
    private $dbh;
    private $error;
	
	private $stmt;
 
    public function __construct(){
        // Установка DSN
        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;
        // Установка опций
        $options = array(
            PDO::ATTR_PERSISTENT    => true,
            PDO::ATTR_ERRMODE       => PDO::ERRMODE_EXCEPTION
        );
        // Создание объекта PDO
        try{
            $this->dbh = new PDO($dsn, $this->user, $this->pass, $options);
        }
        // Ловим ошибку
        catch(PDOException $e){
            $this->error = $e->getMessage();
        }
    }
	
	
	public function query($query){
		$this->stmt = $this->dbh->prepare($query);
	}
	
	// Параметры (bind)
	public function bind($param, $value, $type = null){
		if (is_null($type)) {
			switch (true) {
				case is_int($value):
					$type = PDO::PARAM_INT;
					break;
				case is_bool($value):
					$type = PDO::PARAM_BOOL;
					break;
				case is_null($value):
					$type = PDO::PARAM_NULL;
					break;
				default:
					$type = PDO::PARAM_STR;
			}
		}
		$this->stmt->bindValue($param, $value, $type);
	}
	
	// Выполнение запроса
	public function execute(){
		return $this->stmt->execute();
	}
	
	public function resultset(){
		$this->execute();
		return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
	}
	
	// Single
	public function single(){
		$this->execute();
		return $this->stmt->fetch(PDO::FETCH_ASSOC);
	}
	
	// Подссчет строк
	public function rowCount(){
		return $this->stmt->rowCount();
	}
	
	// Получить последний вставленный Id
	public function lastInsertId(){
		return $this->dbh->lastInsertId();
	}
	
	
	// Транзакции
	public function beginTransaction(){
		return $this->dbh->beginTransaction();
	}
	
	public function endTransaction(){
		return $this->dbh->commit();
	}
	
	public function cancelTransaction(){
		return $this->dbh->rollBack();
	}

    // Отладка дампа параметров
	public function debugDumpParams(){
		return $this->stmt->debugDumpParams();
	}
	
}
}