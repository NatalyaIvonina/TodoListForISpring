<?php declare(strict_types=1);

namespace App\Components\Task\Controller;

use App\Components\Task\Contracts\TaskListRequest;
use App\Components\Task\TaskListHandler;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;

class TaskListController extends AbstractController
{
    /** @var TaskListHandler */
    private $listHandler;

    public function __construct(
        TaskListHandler $listHandler
    )
    {
        $this->listHandler = $listHandler;
    }

    /**
     * Get task list
     *
     * @Rest\Get("/v1/tasks")
     * @Rest\View(statusCode=200)
     *
     * @param TaskListRequest $req
     * @return Response
     */
    public function getTaskListAction(TaskListRequest $req): Response
    {
        return $this->listHandler->handle($req);
    }
}