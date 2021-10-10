<?php declare(strict_types=1);

namespace App\Components\Task;

use App\Components\Task\Contracts\TaskItem;
use App\Components\Task\Contracts\TaskListRequest;
use App\Repository\TaskRepository;
use Symfony\Component\HttpFoundation\Response;

class TaskListHandler
{
    /** @var TaskRepository */
    private $repository;

    public function __construct(
        TaskRepository $repository
    )
    {
        $this->repository = $repository;
    }

    public function handle(TaskListRequest $req): Response
    {
        $taskList = $this->repository->getTaskList($req->isCompleted(), $req->getLimit(), $req->getOffset());

        $response = [];
        foreach ($taskList as $task) {
            $response[] = new TaskItem($task);
        }
        //var_dump($response);
        return new Response(json_encode(($response)));
    }
}