<?php
namespace App\Interfaces;

/**
 * Interface RssHandlerInterface
 */
interface RssHandlerInterface
{
    /**
     * @return string
     */
    public function getName():string;

    /**
     * @return string
     */
    public function getUrl(): string;

    /**
     * @return string
     */
    public function getContent(): string;

    /**
     * @param string $string
     * @return mixed
     */
    public function setContent(string $string);

}
