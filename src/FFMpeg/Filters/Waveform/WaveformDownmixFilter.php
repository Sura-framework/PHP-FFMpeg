<?php

namespace FFMpeg\Filters\Waveform;

use FFMpeg\Exception\RuntimeException;
use FFMpeg\Media\Waveform;

class WaveformDownmixFilter implements WaveformFilterInterface
{

    /** @var bool */
    private $downmix;
    /** @var int */
    private $priority;

    // By default, the downmix value is set to FALSE.
    public function __construct($downmix = FALSE, $priority = 0)
    {
        $this->downmix = $downmix;
        $this->priority = $priority;
    }

    /**
     * {@inheritdoc}
     */
    public function getDownmix()
    {
        return $this->downmix;
    }

    /**
     * {@inheritdoc}
     */
    public function getPriority()
    {
        return $this->priority;
    }

    /**
     * {@inheritdoc}
     */
    public function apply(Waveform $waveform)
    {
        $commands = array();

        foreach ($waveform->getAudio()->getStreams() as $stream) {
            if ($stream->isAudio()) {
                try {
                    
                    // If the downmix parameter is set to TRUE, we add an option to the FFMPEG command
                    if($this->downmix == TRUE) {
                        $commands[] = '"aformat=channel_layouts=mono"';
                    }
                    
                    break;

                } catch (RuntimeException $e) {

                }
            }
        }

        return $commands;
    }
}
