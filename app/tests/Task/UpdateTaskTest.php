<?php

namespace App\Tests\Task;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UpdateTaskTest extends WebTestCase
{
    private $client;

    public function __construct(?string $name = null, array $data = [], $dataName = '')
    {
        $this->client = static::createClient();
        parent::__construct($name, $data, $dataName);
    }

    /** @test */
    public function updateTask(): void
    {
        $data = array(
            'isCompleted' => true
        );
        $this->client->request('PUT', 'api/v1/task/27', $data);

        $this->assertEquals(204, $this->client->getResponse()->getStatusCode());
    }

    /** @test */
    public function updateNotFoundTask(): void
    {
        $data = array(
            'isCompleted' => true
        );
        $this->client->request('PUT', 'api/v1/task/1000', $data);

        $this->assertEquals(404, $this->client->getResponse()->getStatusCode());
    }

    /** @test */
    public function updateTaskWithoutBody(): void
    {
        $this->client->request('PUT', 'api/v1/task/1000');

        $this->assertEquals(400, $this->client->getResponse()->getStatusCode());
    }
}
