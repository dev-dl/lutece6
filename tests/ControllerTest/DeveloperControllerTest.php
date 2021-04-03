<?php

namespace App\Tests\ControllerTest;

use App\Repository\CommentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DeveloperControllerTest extends WebTestCase
{
    public function testSomething(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/developer');

        $this->assertSelectorTextContains('h2', 'Hello');
        $this->assertCount(1 , $crawler->filter('h4'));
        
        $client->clickLink('View');

        $this->assertPageTitleContains('Lin GUO');
        $this->assertResponseIssuccessful();
    }
}
