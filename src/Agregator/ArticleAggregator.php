<?php
namespace App\Agregator;

use App\Entity\Article;
use App\Serializer\ArticleSerializer;
use App\Interfaces\RssHandlerInterface;
use \Doctrine\Persistence\ManagerRegistry;

/**
 * Class ArticleAggregator
 */
class ArticleAggregator
{

    protected ManagerRegistry $registry;
    private ArticleSerializer $serializer;
    protected array $articles;

    /**
     * ArticleAggregator constructor.
     * @param ManagerRegistry $registry
     * @param ArticleSerializer $serializer
     */
    public function __construct(ManagerRegistry $registry, ArticleSerializer $serializer)
    {
        $this->registry = $registry;
        $this->serializer = $serializer;
        $this->articles = [];
    }

    /**
     * @return void
     */
    public function appendDatabase(): void
    {
       $articleRepository = $this->registry->getRepository(Article::class);

        $this->mergeArticles($articleRepository->findAll());
    }

    /**
     * @param array $array
     */
    private function mergeArticles(array $array): void
    {
        foreach ($array as $item) {
            $this->articles[] = $item;
        }
    }
    /**
     * @param RssHandlerInterface $rssHandler
     */
    public function appendRss(RssHandlerInterface $rssHandler): void
    {
        $xml = simplexml_load_file($rssHandler->getUrl(), "SimpleXMLElement", LIBXML_NOCDATA);
        $this->mergeArticles($this->serializer->unserialize($xml->asXML()));
    }

    /**
     * @return array
     */
    public function getArticles(): array
    {
        return $this->articles;
    }
}
