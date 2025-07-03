<?php
class ServiceUsuarios
{
    public $database;

    public function __construct($table, $bean)
    {
        header('Content-Type: application/json');
        $database = new Hibernate();
        $database->table = "usuarios";
        $database->bean = cast("usuarios", $bean);
        $this->database = $database;
    }

    public function listar()
    {
        return json($this->database->findAll());
    }

    public function checkIfUsuarioExists()
    {
        $bean = $this->database->bean;
        return json($this->database->checkDuplication(array(
          "email" => $bean->email
        )));
    }
}
