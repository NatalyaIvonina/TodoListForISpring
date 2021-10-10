<?php declare(strict_types=1);

namespace App\Components\Task\Controller;

use App\Components\Task\CompleteTaskHandler;
use App\Components\Task\Contracts\AddTaskRequest;
use App\Components\Task\AddTaskHandler;
use App\Components\Task\Contracts\UpdateTaskRequest;
use App\Components\Task\DeleteTaskHandler;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class TaskController extends AbstractController
{
    /** @var AddTaskHandler */
    private $addTask;
    /** @var CompleteTaskHandler */
    private $completeTask;
    /** @var DeleteTaskHandler */
    private $deleteTask;
    /** @var ValidatorInterface */
    private $validator;

    public function __construct(
        AddTaskHandler $addTask,
        CompleteTaskHandler $completeTask,
        DeleteTaskHandler $deleteTask,
        ValidatorInterface $validator
    ) {
        $this->addTask = $addTask;
        $this->completeTask = $completeTask;
        $this->deleteTask = $deleteTask;
        $this->validator = $validator;
    }

    /**
     * Add task
     *
     * @Rest\Post("/v1/task")
     * @Rest\View(statusCode=200)
     *
     * @param AddTaskRequest $req
     * @return Response
     */
    public function addTaskAction(AddTaskRequest $req): Response
    {
        return $this->addTask->handle($req);
    }

    /**
     * Complete task
     *
     * @Rest\Put("/v1/task/{taskId}")
     * @Rest\View(statusCode=204)
     *
     * @param UpdateTaskRequest $req
     * @param int $taskId
     */
    public function completeTaskAction(UpdateTaskRequest $req, int $taskId): void
    {
        $this->completeTask->handle($req, $taskId);
    }

    /**
     * Delete task
     *
     * @Rest\Delete("/v1/task/{taskId}")
     * @Rest\View(statusCode=204)
     *
     * @param int $taskId
     */
    public function deleteTaskAction(int $taskId): void
    {
        $this->deleteTask->handle($taskId);
    }
}