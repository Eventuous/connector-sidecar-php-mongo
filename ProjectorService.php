<?php

use Google\Protobuf\Internal\Message;
use Projection\ProjectionRequest;

class ProjectorService extends \Projection\ProjectionStub
{
    private MongoProjector $projector;

    public function __construct(MongoProjector $projector)
    {
        $this->projector = $projector;
    }

    public function Project(
        \Grpc\ServerCallReader $reader,
        \Grpc\ServerCallWriter $writer,
        \Grpc\ServerContext    $context): void
    {
        $ignored = $this->ToAny(new Projection\Ignore());

        /** @var ProjectionRequest $ctx */
        while ($ctx = $reader->read()) {
            $eventType = $ctx->getEventType();
            print("Received " . $eventType . "\r\n");

            $resp = $this->projector->Project($eventType, $ctx->getEventPayload());
            $response = new Projection\ProjectionResponse();
            $response->setEventId($ctx->getEventId());
            $response->setOperation($this->ToAny($resp));
            $writer->write($response);
        }
    }

    function ToAny(Message $message): \Google\Protobuf\Any {
        $any = new \Google\Protobuf\Any();
        $any->pack($message);
        return $any;
    }
}
