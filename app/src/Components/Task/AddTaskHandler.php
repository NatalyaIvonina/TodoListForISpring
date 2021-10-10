<?php declare(strict_types=1);

namespace App\Components\Task;

use App\Components\Task\Contracts\AddTaskRequest;
use App\Components\Task\Contracts\AddTaskResponse;
use App\Entity\Task;
use App\Repository\TaskRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;

class AddTaskHandler
{
    /** @var TaskRepository */
    private $repository;

    /** @var EntityManagerInterface */
    private $entityManager;

    public function __construct(
        TaskRepository $repository,
        EntityManagerInterface $entityManager
    ) {
        $this->repository = $repository;
        $this->entityManager = $entityManager;
    }

    public function handle(AddTaskRequest $addTaskRequest): Response
    {
        $task = new Task($addTaskRequest->getDescription());
        $this->entityManager->persist($task);
        $this->entityManager->flush();

        return new Response(json_encode((new AddTaskResponse($task->getId()))));
    }
}