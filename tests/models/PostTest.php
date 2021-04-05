<?php

use PHPUnit\Framework\TestCase;

final class PostTest extends TestCase
{

    public function testGetCurrentPostsWithDefaults(): void
    {
        $mock = $this->createMock(\models\Post::class);

        $mock->method('getCurrentPosts')->willReturn(true);

        $result = $mock->getCurrentPosts();

        $this->assertTrue($result);
    }

    public function testGetCurrentPostsWithoutDefaults(): void
    {
        $mock = $this->createMock(\models\Post::class);

        $mock->method('getCurrentPosts')->willReturn(true);
        $month = '12';
        $year = 2020;
        $result = $mock->getCurrentPosts($month, $year);

        $this->assertTrue($result);
    }
    
    public function testPostsByCategory(): void
    {
        $mock = $this->createMock(\models\Post::class);

        $mock->method('getPostsByCategory')->willReturn(true);
        $category = 'Entrepreneurship';
        $result = $mock->getPostsByCategory($category);

        $this->assertTrue($result);
    }

}