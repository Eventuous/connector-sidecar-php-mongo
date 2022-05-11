<?php
require dirname(__FILE__) . '/MongoProjector.php';

class BookingDocument
{
    public string $_id;
    public string $guestId;
    public string $roomId;
    public float $outstandingAmount;
}

class BookingProjection extends MongoProjector
{
    public function __construct()
    {
        parent::__construct();

        // RoomBooked inserts a new document to the collection
        $this->InsertOneOn("V1.RoomBooked", function ($evt) {
            $doc = new BookingDocument();
            $doc->_id = $evt->bookingId;
            $doc->guestId = $evt->guestId;
            return $doc;
        });

        // PaymentRegistered updates an existing document
        $this->UpdateOneOn("V1.PaymentRegistered", function ($evt) {
            $filter = new BookingDocument();
            $filter->_id = $evt->bookingId;
            $update = new stdClass();
            $doc = new BookingDocument();
            $doc->outstandingAmount = $evt->amount;
            $update->{'$set'} = $doc;
            $result = new stdClass();
            $result->filter = $filter;
            $result->update = $update;
            return $result;
        });
    }
}