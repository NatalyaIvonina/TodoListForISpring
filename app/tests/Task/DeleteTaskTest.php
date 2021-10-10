<?php

namespace App\Tests\Task;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DeleteTaskTest extends WebTestCase
{
    private $client;

    public function __construct(?string $name = null, array $data = [], $dataName = '')
    {
        $this->client = static::createClient();
        parent::__construct($name, $data, $dataName);
    }

    /** @test */
    public function deleteTask(): void
    {
        $this->client->request('DELETE', 'api/v1/task/26');

        $this->assertEquals(204, $this->client->getResponse()->getStatusCode());
    }

    /** @test */
    public function deleteNotFoundTask(): void
    {
        $this->client->request('DELETE', 'api/v1/task/26');

        $this->assertEquals(404, $this->client->getResponse()->getStatusCode());
    }
}
