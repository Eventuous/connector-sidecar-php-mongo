<?php

use Google\Protobuf\Internal\Message;
use Google\Protobuf\Struct;
use Projection\DeleteOne;
use Projection\InsertOne;
use Projection\UpdateOne;

abstract class MongoProjector
{
    public function __construct()
    {
        $this->projectors = new \Aimeos\Map();
    }

    /**
     * This function should only be called by the projector service
     * @param string $eventType Event type string
     * @param Struct $evt Event payload as it comes in Protobuf
     * @return Message The response operation message
     */
    public function Project(string $eventType, Struct $evt): Message
    {
        $handler = $this->projectors[$eventType];
        if ($handler == null) {
            return new \Projection\Ignore();
        }

        $payload = json_decode($evt->serializeToJsonString());
        return $handler($payload);
    }

    /**
     * @param string $eventType Event type string
     * @param callable $handler Projection handler returning a complete document to insert
     * @return void
     */
    protected function InsertOneOn(string $eventType, callable $handler): void
    {
        $this->projectors->set($eventType, function ($evt) use ($handler) {
            return $this->InsertOne($evt, $handler);
        });
    }

    /**
     * @param string $eventType Event type string
     * @param callable $handler Projection handler returning a complete document
     * @return void
     */
    protected function UpdateOneOn(string $eventType, callable $handler): void
    {
        $this->projectors->set($eventType, function ($evt) use ($handler) {
            return $this->UpdateOne($evt, $handler);
        });
    }

    /**
     * @param string $eventType Event type string
     * @param callable $handler Projection handler returning a filter for deletion
     * @return void
     */
    protected function DeleteOneOn(string $eventType, callable $handler): void
    {
        $this->projectors->set($eventType, function ($evt) use ($handler) {
            return $this->DeleteOne($evt, $handler);
        });
    }

    /**
     * @param object $evt Deserialized event
     * @param callable $projection Projection handler returning a complete document
     * @return InsertOne
     * @throws Exception
     */
    private function InsertOne(object $evt, callable $projection): InsertOne
    {
        $doc = $projection($evt);
        $op = new Struct();
        $op->mergeFromJsonString(json_encode($doc));
        $result = new InsertOne();
        $result->setDocument($op);
        return $result;
    }

    /**
     * @param object $evt Deserialized event
     * @param callable $projection Projection handler returning an object with filter and update fields
     * @return UpdateOne
     * @throws Exception
     */
    private function UpdateOne(object $evt, callable $projection): UpdateOne
    {
        $r = $projection($evt);
        $filter = new Struct();
        $filter->mergeFromJsonString(json_encode($r->filter));
        $update = new Struct();
        $update->mergeFromJsonString(json_encode($r->update));
        $result = new UpdateOne();
        $result->setFilter($filter);
        $result->setUpdate($update);
        return $result;
    }

    /**
     * @param object $evt
     * @param callable $projection
     * @return DeleteOne
     * @throws Exception
     */
    private function DeleteOne(object $evt, callable $projection): DeleteOne {
        $r = $projection($evt);
        $filter = new Struct();
        $filter->mergeFromJsonString(json_encode($r->filter));
        $result = new DeleteOne();
        $result->setFilter($filter);
        return $result;
    }

    private \Aimeos\Map $projectors;
}