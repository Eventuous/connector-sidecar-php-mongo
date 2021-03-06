<?php
// GENERATED CODE -- DO NOT EDIT!

namespace Projection;

/**
 */
class ProjectionClient extends \Grpc\BaseStub {

    /**
     * @param string $hostname hostname
     * @param array $opts channel options
     * @param \Grpc\Channel $channel (optional) re-use channel object
     */
    public function __construct($hostname, $opts, $channel = null) {
        parent::__construct($hostname, $opts, $channel);
    }

    /**
     * @param array $metadata metadata
     * @param array $options call options
     * @return \Grpc\BidiStreamingCall
     */
    public function Project($metadata = [], $options = []) {
        return $this->_bidiRequest('/projection.Projection/Project',
        ['\Projection\ProjectionResponse','decode'],
        $metadata, $options);
    }

}
