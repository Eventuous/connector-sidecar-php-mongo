<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: proto/project.proto

namespace Projection;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>projection.InsertOne</code>
 */
class InsertOne extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>.google.protobuf.Struct document = 1;</code>
     */
    protected $document = null;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type \Google\Protobuf\Struct $document
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Proto\Project::initOnce();
        parent::__construct($data);
    }

    /**
     * Generated from protobuf field <code>.google.protobuf.Struct document = 1;</code>
     * @return \Google\Protobuf\Struct|null
     */
    public function getDocument()
    {
        return $this->document;
    }

    public function hasDocument()
    {
        return isset($this->document);
    }

    public function clearDocument()
    {
        unset($this->document);
    }

    /**
     * Generated from protobuf field <code>.google.protobuf.Struct document = 1;</code>
     * @param \Google\Protobuf\Struct $var
     * @return $this
     */
    public function setDocument($var)
    {
        GPBUtil::checkMessage($var, \Google\Protobuf\Struct::class);
        $this->document = $var;

        return $this;
    }

}

