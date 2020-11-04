<?php

namespace MVC\Controllers;

use MVC\Core\Controller;
use MVC\Models\TaskModel;
use MVC\Models\TaskRepository;

class TasksController extends Controller
{
    public function index()
    {
        $taskRepo = new TaskRepository;
        $d['tasks'] = $taskRepo->getAll();
        $this->set($d);
        $this->render("index");
    }

    public function create()
    {
        if (isset($_POST["title"])) {
            $taskModel = new TaskModel;
            $taskModel->setTitle($_POST["title"]);
            $taskModel->setDescription($_POST["description"]);
            $taskModel->setCreatedAt(date('Y-m-d H:i:s'));
            $taskRepo = new TaskRepository;
            if ($taskRepo->add($taskModel)) {
                header("Location: " . WEBROOT . "tasks/index");
            }
        }
        $this->render("create");
    }

    public function edit($id)
    {
        $taskRepo = new TaskRepository();
        $d["task"] = $taskRepo->get($id);
        if (isset($_POST["title"])) {
            $taskModel = new TaskModel;
            $taskModel->setId($id);
            $taskModel->setTitle($_POST["title"]);
            $taskModel->setDescription($_POST["description"]);
            $taskModel->setUpdatedAt(date('Y-m-d H:i:s'));

            if ($taskRepo->add($taskModel)) {
                header("Location: " . WEBROOT . "tasks/index");
            }
        }
        $this->set($d);
        $this->render("edit");
    }

    public function delete($id)
    {
        $taskRepo = new TaskRepository;
        if ($taskRepo->delete($id)) {
            header("Location: " . WEBROOT . "tasks/index");
        }
    }
}
