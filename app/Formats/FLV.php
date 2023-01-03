<?php

/*
 * This file is part of PHP-FFmpeg.
 *
 * Modified to add FLV support.
 *
 * (c) Alchemy <info@alchemy.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Formats;

/**
 * The FLV video format.
 */
class FLV extends \FFMpeg\Format\Video\DefaultVideo
{
    public function __construct($audioCodec = 'mp3', $videoCodec = 'flv1')
    {
        $this
            ->setAudioCodec($audioCodec)
            ->setVideoCodec($videoCodec);
    }

    /**
     * {@inheritDoc}
     */
    public function supportBFrames()
    {
        return false;
    }

    /**
     * {@inheritDoc}
     */
    public function getAvailableAudioCodecs()
    {
        return ['mp3'];
    }

    /**
     * {@inheritDoc}
     */
    public function getAvailableVideoCodecs()
    {
        return ['flv1'];
    }
}
