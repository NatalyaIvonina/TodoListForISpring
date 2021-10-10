<?php

namespace App\Tests\Task;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class GetTaskListTest extends WebTestCase
{
    private $client;

    public function __construct(?string $name = null, array $data = [], $dataName = '')
    {
        $this->client = static::createClient();
        parent::__construct($name, $data, $dataName);
    }

    /** @test */
    public function getTaskList(): void
    {
        $this->client->request('GET', 'api/v1/tasks?completed=true');

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
    }

    /** @test */
    public function getTaskListWithOffsetAndLimit(): void
    {
        $this->client->request('GET', 'api/v1/tasks?completed=true&offset=2&limit=2');

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
    }

    /** @test */
    public function getTaskListIncorrectLimit(): void
    {
        $this->client->request('GET', 'api/v1/tasks?completed=true&offset=2&limit=200');

        $this->assertEquals(400, $this->client->getResponse()->getStatusCode());
    }
}
