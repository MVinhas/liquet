<?php

use PHPUnit\Framework\TestCase;
use \models\Article as Article;

final class ArticleTest extends TestCase
{

    public function testGetCurrentArticlesWithDefaults(): void
    {
        $mock = $this->createMock(Article::class);

        $mock->method('getCurrentArticles')->willReturn(true);

        $result = $mock->getCurrentArticles();

        $this->assertTrue($result);
    }

    public function testGetCurrentARticlesWithoutDefaults(): void
    {
        $mock = $this->createMock(Article::class);

        $mock->method('getCurrentArticles')->willReturn(true);
        $month = '12';
        $year = 2020;
        $result = $mock->getCurrentArticles($month, $year);

        $this->assertTrue($result);
    }
    
    public function testArticlesByCategory(): void
    {
        $mock = $this->createMock(Article::class);

        $mock->method('getArticlesByCategory')->willReturn(true);
        $category = 'Entrepreneurship';
        $result = $mock->getArticlesByCategory($category);

        $this->assertTrue($result);
    }

}