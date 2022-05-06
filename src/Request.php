<?php declare( strict_types = 1 );

namespace PiotrPress\Remoter;

class Request {
    protected Url $url;
    protected string $method = 'GET';
    protected ?Header $header = null;
    protected string $content = '';

    public function __construct( Url $url, string $method = 'GET', ?Header $header = null, string $content = '' ) {
        $this->setUrl( $url );
        $this->setMethod( $method );
        $this->setHeader( $header );
        $this->setContent( $content );
    }

    public function setUrl( Url $url ) : self {
        $this->url = $url;
        return $this;
    }

    public function getUrl() : Url {
        return $this->url;
    }

    public function setMethod( string $method ) : self {
        $this->method = \strtoupper( $method );
        return $this;
    }

    public function getMethod() : string {
        return $this->method;
    }

    public function setHeader( ?Header $header ) : self {
        $this->header = $header;
        return $this;
    }

    public function getHeader() : ?Header {
        return $this->header;
    }

    public function setContent( string $content ) : self {
        $this->content = $content;
        return $this;
    }

    public function getContent() : string {
        return $this->content;
    }

    public function send() : Response {
        return new Response( \file_get_contents( (string)$this->getUrl(), false, \stream_context_create( [
            'http' => \array_merge( [
                'ignore_errors' => true,
                'user_agent' => ''
            ],
                $this->getMethod() ? [ 'method' => $this->getMethod() ] : [],
                $this->getHeader() ? [ 'header' => $this->getHeader()->toArray() ] : [],
                $this->getContent() ? [ 'content' => $this->getContent() ] : []
            )
        ] ) ), new Header( $http_response_header ) );
    }
}