<?php

namespace App\Tests\Task;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AddTaskTest extends WebTestCase
{
    private $client;

    public function __construct(?string $name = null, array $data = [], $dataName = '')
    {
        $this->client = static::createClient();
        parent::__construct($name, $data, $dataName);
    }

    /** @test */
    public function addNewTask(): void
    {
        $data = array(
            'description' => 'New task'
        );
        $this->client->request('POST', 'api/v1/task', $data);

        $this->assertEquals(201, $this->client->getResponse()->getStatusCode());
    }

    /** @test */
    public function addNewTaskMoreLengthDescription(): void
    {
        $data = array(
            'description' => random_bytes(1001)
        );
        $this->client->request('POST', 'api/v1/task', $data);

        $this->assertEquals(400, $this->client->getResponse()->getStatusCode());
    }

    /** @test */
    public function addNewTaskNullDescription(): void
    {
        $data = array(
            'description' => null
        );
        $this->client->request('POST', 'api/v1/task', $data);

        $this->assertEquals(400, $this->client->getResponse()->getStatusCode());
    }

    /** @test */
    public function addNewTaskWithoutDescription(): void
    {
        $this->client->request('POST', 'api/v1/task', []);

        $this->assertEquals(400, $this->client->getResponse()->getStatusCode());
    }
}
