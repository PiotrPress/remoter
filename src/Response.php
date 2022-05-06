<?php declare( strict_types = 1 );

namespace PiotrPress\Remoter;

class Response {
    protected string $content = '';
    protected ?Header $header = null;

    public function __construct( string $content = '', ?Header $header = null ) {
        $this->setContent( $content );
        $this->setHeader( $header );
    }

    public function setContent( string $content ) : self {
        $this->content = $content;
        return $this;
    }

    public function getContent() : string {
        return $this->content;
    }

    public function setHeader( ?Header $header ) : self {
        $this->header = $header;
        return $this;
    }

    public function getHeader() : ?Header {
        return $this->header;
    }
}