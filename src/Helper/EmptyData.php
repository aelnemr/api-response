<?php
/**
 * User: elnemr
 * Date: 6/25/2020
 */

namespace AElnemr\RestFulResponse\Helper;


class EmptyData
{
    /**
     * @return object
     */
    public static function object(): ?object
    {
        return null;
    }

    /**
     * @return string
     */
    public static function string(): string
    {
        return (string)'';
    }

    /**
     * @return bool
     */
    public static function boolean(): bool
    {
        return (bool)false;
    }

    /**
     * @return int
     */
    public static function numeric(): int
    {
        return (int)0;
    }

    /**
     * @return array
     */
    public static function array(): array
    {
        return (array)[];
    }
}
