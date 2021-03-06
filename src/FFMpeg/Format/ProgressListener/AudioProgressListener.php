<?php

namespace FFMpeg\Format\ProgressListener;

/**
 * Parses ffmpeg stderr progress information. An example:
 *
 * <pre>
 *       size=    3552kB time=00:03:47.29 bitrate= 128.0kbits/s
 * </pre>
 *
 * @author Robert Gruendler <r.gruendler@gmail.com>
 */
class AudioProgressListener extends AbstractProgressListener
{
    public function getPattern()
    {
        return '/size=(.*?) time=(.*?) /';
    }
}
