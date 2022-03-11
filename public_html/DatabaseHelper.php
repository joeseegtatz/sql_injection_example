<?php

class DatabaseHelper
{
    const username = ''; // use a + your matriculation number
    const password = ''; // use your oracle db password
    const con_string = 'oracle-lab.cs.univie.ac.at:1521/lab';

    protected $conn;

    public function __construct()
    {
        try {
            $this->conn = @oci_connect(
                DatabaseHelper::username,
                DatabaseHelper::password,
                DatabaseHelper::con_string
            );

            if (!$this->conn) {
                die("DB error: Connection can't be established!");
            }

        } catch (Exception $e) {
            die("DB error: {$e->getMessage()}");
        }
    }

    public function __destruct()
    {
        @oci_close($this->conn);
    }
    public function selectPizzasWherePizzaName($pizzaname)
    {
        $sql = "SELECT * FROM pizzaangebot WHERE pizzaname LIKE '%{$pizzaname}%'";
        $statement = @oci_parse($this->conn, $sql);
        @oci_execute($statement);
        @oci_fetch_all($statement, $res, 0, 0, OCI_FETCHSTATEMENT_BY_ROW);
        @oci_free_statement($statement);
        return $res;
    }
    public function checkUserInformation($username, $password){
        $sql="SELECT COUNT(*) as COUNT from pizzauser where pizzausername='{$username}' and pizzapassword='{$password}'";
        $statement = @oci_parse($this->conn, $sql);
        @oci_execute($statement);
        @oci_fetch_all($statement, $res, 0, 0, OCI_FETCHSTATEMENT_BY_ROW);
        @oci_free_statement($statement);
        return $res[0]['COUNT']>0;
    }

    public function insertIntoUser($username, $mail, $password, $creditcard){
        $sql="Insert into PIZZAUSER(PIZZAUSERNAME, PCREDITCARDNUMBER, PEMAIL, PIZZAPASSWORD) values('{$username}', '{$creditcard}', '{$mail}', '{$password}')";
        $statement = @oci_parse($this->conn, $sql);
        $success = @oci_execute($statement) && @oci_commit($this->conn);
        @oci_free_statement($statement);
        return $success;
    }

}
