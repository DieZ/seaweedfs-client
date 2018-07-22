<?php

namespace SeaweedFS\Model;

use SeaweedFS\SeaweedFS;

/**
 * Represents a Seaweedfs File
 *
 * @package SeaweedFS\Model
 */
class File extends Location {
    /**
     * @var string The file id.
     */
    public $fid;

    /**
     * @var int The file size.
     */
    public $size;

    /**
     * @var string The request scheme for building file urls.
     */
    public $scheme;

    /**
     * @var FileMeta
     */
    public $meta;

    /**
     * File constructor.
     * @param $obj
     * @param string $scheme
     */
    public function __construct($obj, $scheme = 'http') {
        parent::__construct($obj);

        $this->fid = $obj->fid;
        $this->scheme = $scheme;
    }

    /**
     * Build a URL to this file.
     *
     * @return string
     */
    public function getFileUrl() {
        return $this->scheme . '://' . $this->url . '/' . $this->fid;
    }

    /**
     * Return the information of this File as an array.
     *
     * @return array
     */
    public function toArray() {
        return [
            'url' => $this->url,
            'fid' => $this->fid
        ];
    }

    public function getMeta(SeaweedFS $client) {
        $this->meta ?: $client->meta($this->fid);
    }
}