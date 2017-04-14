<?php

namespace AdminBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ArticleControllerTest extends WebTestCase
{
    public function testAdd()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/article/add');
    }

    public function testList()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/articles');
    }

    public function testDelete()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/article/delete/{id}');
    }

}
