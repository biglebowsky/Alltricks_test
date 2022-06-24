<?php


namespace App\Serializer;

use App\Entity\Article;
use App\Repository\SourceRepository;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

/**
 * Class ArticleNormalizer
 * @package App\Serializer
 */
class ArticleNormalizer implements NormalizerInterface, DenormalizerInterface
{
    /**
     * @var ObjectNormalizer
     */
    private $normalizer;
    /**
     * @var SourceRepository
     */
    private SourceRepository $sourceRepository;

    /**
     * ArticleNormalizer constructor.
     * @param ObjectNormalizer $normalizer
     * @param SourceRepository $sourceRepository
     */
    public function __construct(ObjectNormalizer $normalizer, SourceRepository $sourceRepository)
    {
        $this->normalizer = $normalizer;
        $this->sourceRepository = $sourceRepository;
    }

    /**
     * @param Article $article
     * @param string|null $format
     * @param array $context
     * @return array|\ArrayObject|bool|float|int|mixed|string|null
     */
    public function normalize($article, string $format = null, array $context = [])
    {
        return [
            'id' => $article->getId(),
            'title' => $article->getName(),
            'content' => $article->getContent(),
            'source' => [
                'id' => $article->getSource()?->getId(),
                'name' => $article->getSource()->getName(),
                'sourceType' => $article->getSource()?->getSourceType()?->getName()
            ],
        ];
    }

    /**
     * @param $data
     * @param string|null $format
     * @param array $context
     * @return bool
     */
    public function supportsNormalization($data, string $format = null, array $context = [])
    {
        return $data instanceof Article;
    }

    /**
     * @param mixed $data
     * @param string $type
     * @param string|null $format
     * @param array $context
     * @return array
     */
    public function denormalize(mixed $data, string $type, string $format = null, array $context = [])
    {
        $items = $data['channel']['item'];
        $source = $this->sourceRepository->findOneBy(['name' => $data['channel']['title']]);
        $arrayArticles = [];
        foreach ($items as $item) {
            $article = new Article();
            $article->setName($item['title'])
                ->setContent($item['link'])
                ->setSource($source);
            $arrayArticles[] = $article;
        }

        return $arrayArticles;
    }

    /**
     * @param mixed $key
     * @param array $array
     * @return bool
     */
    protected function arrayCheck(mixed $key, array $array): bool
    {
        return array_key_exists($key, $array);
    }

    /**
     * @param mixed $data
     * @param string $type
     * @param string|null $format
     * @return bool
     */
    public function supportsDenormalization(mixed $data, string $type, string $format = null)
    {
        return is_array($data) &&
            ($this->arrayCheck('channel', $data) && $this->arrayCheck('item', $data['channel'])) &&
            ($this->arrayCheck('channel', $data) && $this->arrayCheck('title', $data['channel']));
    }
}
