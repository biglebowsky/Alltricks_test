<?php
namespace App\Handlers;
use App\Interfaces\RssHandlerInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

/**
 * Class RssHandler
 */
class RssHandler implements RssHandlerInterface
{
    /**
     * @var string
     */
    private string $name;
    /**
     * @var string
     */
    private string $url;
    /**
     * @var string
     */
    private string $path;
    /**
     * @var string
     */
    private string $content;

    /**
     * RssHandler constructor.
     * @param ParameterBagInterface $bag
     */
    public function __construct(ParameterBagInterface $bag)
    {
        $this->name = (string) $bag->get('rssName');
        $this->url = (string) $bag->get('rssUrl');
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return RssHandler
     */
    public function setName(string $name): RssHandler
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @param string $url
     * @return RssHandler
     */
    public function setUrl(string $url): RssHandler
    {
        $this->url = $url;
        return $this;
    }

    /**
     * @param string $path
     * @return $this
     */
    public function setPath(string $path): RssHandler
    {
        $this->path = $path;

        return $this;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @param string $content
     * @return RssHandler
     */
    public function setContent(string $content): RssHandler
    {
        $this->content = $content;
        return $this;
    }

}
