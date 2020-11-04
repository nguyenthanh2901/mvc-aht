<?php

namespace MVC\Core;

use MVC\Core\ResourceModelInterface;
use MVC\Core\Model;
use MVC\Config\Database;

class ResourceModel implements ResourceModelInterface
{
    private $id;
    private $table;
    private $model;

    public function _init($table, $id, $model)
    {
        $this->table = $table;
        $this->id = $id;
        $this->model = $model;
    }
    public function getAll()
    {
        $sql = "SELECT * FROM $this->table";
        $req = Database::getBdd()->prepare($sql);
        $req->execute();
        return $req->fetchAll();
    }
    public function get($id)
    {
        $sql = "SELECT * FROM $this->table WHERE id = $id";
        $req = Database::getBdd()->prepare($sql);
        $req->execute();
        return $req->fetch();
    }
    public function delete($id)
    {
        $sql = "DELETE FROM $this->table WHERE $this->id = $id";
        $req = Database::getBdd()->prepare($sql);
        return $req->execute();
    }
    public function save($model)
    {
        $models = new Model;
        $arrProp = $models->getProperties($model);
        $strKey = '';
        $strValue = '';
        $sql = '';
        if ($model->getId()==null) {
            unset($arrProp['id']);
            foreach ($arrProp as $key => $value) {
                $strKey .= $key . ', ';
                $strValue .= ':' . $key . ', ';
            }
            $strKey = trim($strKey, ', ');
            $strValue = trim($strValue, ', ');
            $sql = "INSERT INTO $this->table ($strKey) VALUES ($strValue)";
        } else {
            unset($arrProp['created_at']);
            foreach ($arrProp as $key => $value) {
                $strValue .= $key . '=' . ':' . $key . ', ';
            }
            $strValue = trim($strValue, ', ');
            $sql = "UPDATE $this->table SET " . $strValue . " WHERE id=:id";
        }
       
        $req = Database::getBdd()->prepare($sql);
        return  $req->execute($arrProp);
    }
}
