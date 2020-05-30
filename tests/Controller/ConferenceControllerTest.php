<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ConferenceControllerTest extends WebTestCase
{

    // Первый тест проверяет, что главная страница возвращает статус 200 в HTTP-ответе.
    public function testIndex()
    {
        $client = static::createClient(); // Переменная $client предназначена для имитации браузера.
        $client->request('GET', '/');
        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h2', 'Give your feedback');
    }
}