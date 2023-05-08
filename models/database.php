<?php
class Database {
  protected $connection = null;

  public function __construct() {
    try {
      $this->connection = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DATABASE_NAME);

      if (mysqli_connect_errno()) {
        throw new Exception("Could not connect to database.");
      }
    } catch (Exception $e) {
      throw new Exception($e->getMessage());
    }
  }
  
  public function create($query = "")
  {
    try {
      if($query != "")
      {
        $stmt = $this->executeStatement($query);
        $Output = $stmt->affected_rows;
        $stmt->close();

        return $Output;
      }
      else
      {
        return 0;
      }
    }
    catch (Exception $e)
    {
      throw new Exception($e->getMessage());
    }
  }

  public function select($query = "") {
    try {
      $stmt = $this->executeStatement($query);
      $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
      $stmt->close();

      return $result;
    } catch (Exception $e) {
      throw new Exception($e->getMessage());
    }
  }

  public function update($query = "") {
    try {
      $stmt = $this->executeStatement($query);
      $result = $stmt->affected_rows;
      $stmt->close();

      return $result;
    } catch (Exception $e) {
      throw new Exception($e->getMessage());
    }
  }

  private function executeStatement($query = "") {
    try {
      $stmt = $this->connection->prepare($query);

      if ($stmt === false) {
        throw new Exception("Unable to do prepared statement: " . $query);
      }

      $stmt->execute();

      return $stmt;
    } catch (Exception $e) {
      throw new Exception($e->getMessage());
    }
  }

}
?>