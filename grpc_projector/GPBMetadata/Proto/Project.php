<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: proto/project.proto

namespace GPBMetadata\Proto;

class Project
{
    public static $is_initialized = false;

    public static function initOnce() {
        $pool = \Google\Protobuf\Internal\DescriptorPool::getGeneratedPool();

        if (static::$is_initialized == true) {
          return;
        }
        \GPBMetadata\Google\Protobuf\Any::initOnce();
        \GPBMetadata\Google\Protobuf\Struct::initOnce();
        $pool->internalAddGeneratedFile(
            '
�
proto/project.proto
projectiongoogle/protobuf/struct.proto"�
ProjectionRequest
	eventType (	
eventId (	
stream (	-
eventPayload (2.google.protobuf.Struct=
metadata (2+.projection.ProjectionRequest.MetadataEntry/
MetadataEntry
key (	
value (	:8"�
ProjectionResponse
eventId (	\'
	operation (2.google.protobuf.Any>
metadata (2,.projection.ProjectionResponse.MetadataEntry/
MetadataEntry
key (	
value (	:8"
Ignore"6
	InsertOne)
document (2.google.protobuf.Struct"]
	UpdateOne\'
filter (2.google.protobuf.Struct\'
update (2.google.protobuf.Struct"4
	DeleteOne\'
filter (2.google.protobuf.Struct2Z

ProjectionL
Project.projection.ProjectionRequest.projection.ProjectionResponse(0bproto3'
        , true);

        static::$is_initialized = true;
    }
}

