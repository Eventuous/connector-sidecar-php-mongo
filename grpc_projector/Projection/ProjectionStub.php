<?php
// GENERATED CODE -- DO NOT EDIT!

namespace Projection;

/**
 */
class ProjectionStub {

    /**
     * @param \Grpc\ServerCallReader $reader read client request data of \Projection\ProjectionRequest
     * @param \Grpc\ServerCallWriter $writer write response data of \Projection\ProjectionResponse
     * @param \Grpc\ServerContext $context server request context
     * @return void
     */
    public function Project(
        \Grpc\ServerCallReader $reader,
        \Grpc\ServerCallWriter $writer,
        \Grpc\ServerContext $context
    ): void {
        $context->setStatus(\Grpc\Status::unimplemented());
        $writer->finish();
    }

    /**
     * Get the method descriptors of the service for server registration
     *
     * @return array of \Grpc\MethodDescriptor for the service methods
     */
    public final function getMethodDescriptors(): array
    {
        return [
            '/projection.Projection/Project' => new \Grpc\MethodDescriptor(
                $this,
                'Project',
                '\Projection\ProjectionRequest',
                \Grpc\MethodDescriptor::BIDI_STREAMING_CALL
            ),
        ];
    }

}
