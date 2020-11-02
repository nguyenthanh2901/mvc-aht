<?php
namespace MVC\Models;
use MVC\Models\TaskResourceModel;

class TaskRepository
{
    private $taskResourceModel;
    
    public function __construct()
    {
        $this->taskResourceModel = new TaskResourceModel();
    }
    function add($model)
    {
        return $this->taskResourceModel->save($model);
    }

    public function getAll() {
        return $this->taskResourceModel->getAll();
    }

    public function get($id)
    {
        return $this->taskResourceModel->get($id);
    }

    public function delete($id)
    {
        return $this->taskResourceModel->delete($id);
    }
}
