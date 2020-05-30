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



    /*  Чистить базу данных после каждого запуска тестов, конечно, очень
        хорошо, но иметь действительно независимые друг от друга тесты
        — гораздо лучше. Крайне нежелательно, чтобы один тест опирался
        на результаты от предыдущих. Помимо этого, изменение порядка
        выполнения тестов также не должно влиять на результат. Как мы
        сейчас убедимся, наши тесты сейчас не соответствуют описанному
        выше условию.
        Переместите тест testConferencePage после testCommentSubmission :
    */

    public function testCommentSubmission()
    {
        $client = static::createClient();
        $client->request('GET', '/conference/amsterdam-2019');
        $client->submitForm('Submit', [
            'comment_form[author]' => 'Fabien',
            'comment_form[text]' => 'Some feedback from an automated functional test',
            'comment_form[email]' => 'me@automat.ed',
            'comment_form[photo]' => dirname(__DIR__, 2) . '/public/uploads/photos/0761adf91ac6.png',
        ]);
        $this->assertResponseRedirects();
        $client->followRedirect();
        $this->assertSelectorExists('div:contains("There are 2 comments")');
    }

    public function testConferencePage()
    {
        $client = static::createClient();

        // Как и в первом тесте, сначала переходим на главную страницу
        $crawler = $client->request('GET', '/');

        /*Метод request() возвращает экземпляр Crawler , с помощью
            которого можно найти нужные элементы на странице (например,
            ссылки, формы и всё остальное, что можно получить через
            селекторы CSS или XPath);*/

        /*Благодаря CSS-селектору проверяем, что на главной странице есть две конференции*/
        $this->assertCount(2, $crawler->filter('h4'));

        /*Далее кликаем по ссылке «View» (из-за того, что один вызов
            щёлкает только по одной ссылке, Symfony автоматически выберет
            первую найденную в разметке);*/
        $client->clickLink('View');

        /*Проверяем заголовок страницы, ответ и тег <h2> для того, чтобы
            знать наверняка, что мы находимся на нужной странице
            (дополнительно можно было проверить на совпадение маршрут);*/
        $this->assertPageTitleContains('Amsterdam');
        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h2', 'Amsterdam 2019');

        /*И последнее: проверяем, что на странице есть 1 комментарий. В
            Symfony кое-какие некорректные в  CSS селекторы позаимствованы из jQuery. Как раз один из таких селекторов мы используем — div:contains() */
        $this->assertSelectorExists('div:contains("There are 1 comments")');


        /*Опять же при помощи CSS-селектора вместо нажатия на текст ( View ), выбираем нужную ссылку:*/
        // $client->click($crawler->filter('h4 ++ p a')->link());

        // Проследите, чтобы новый тест выполнился успешно:
        // $ symfony run bin/phpunit tests/Controller/ConferenceControllerTest.php
    }

}