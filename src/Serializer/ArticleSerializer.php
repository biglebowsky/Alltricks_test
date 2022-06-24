<?php


namespace App\Serializer;

use App\Entity\Article;
use Serializable;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Serializer;

/**
 * Class ArticleSerializer
 * @package App\Serializer
 */
class ArticleSerializer implements Serializable
{
    /**
     * @var ArticleNormalizer
     */
    protected ArticleNormalizer $normalizer;

    /**
     * ArticleSerializer constructor.
     * @param ArticleNormalizer $normalizer
     */
    public function __construct(ArticleNormalizer $normalizer)
    {
        $this->normalizer = $normalizer;
    }


    /**
     * @return string|void|null
     */
    public function serialize()
    {

    }

    /**
     * @param string $serialized
     */
    public function unserialize($serialized)
    {
        $encoder = [new XmlEncoder()];

        $serializer = new Serializer([$this->normalizer], $encoder);

        return $serializer->deserialize($serialized, Article::class, 'xml');
    }
}
