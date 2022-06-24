<?php

namespace App\Controller;

use App\Agregator\ArticleAggregator;
use App\Interfaces\RssHandlerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    /**
     * @param ArticleAggregator $aggregator
     * @param RssHandlerInterface $rssHandler
     * @return Response
     * @Route("/articles", name="display_articles")
     */
    public function getArticleAction(ArticleAggregator $aggregator, RssHandlerInterface $rssHandler): Response
    {
        $aggregator->appendRss($rssHandler);
        $aggregator->appendDatabase();

        $articles = ($aggregator->getArticles());

        return $this->render("articles.html.twig", ["articles" => $articles]);
    }
}
