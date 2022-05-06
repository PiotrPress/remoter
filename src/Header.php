<?php declare( strict_types = 1 );

namespace PiotrPress\Remoter;

class Header {
    protected array $headers = [];

    public function __construct( array $headers = [], bool $associative = false ) {
        $this->fromArray( $headers, $associative );
    }

    static protected function normalize( string $value ) : string {
        return \strtolower( \trim( $value ) );
    }

    static public function parse( array $headers ) : array {
        foreach ( $headers as $key => $value ) {
            $header = \explode( ':', $value, 2 );
            if ( isset( $header[ 1 ] ) ) {
                $headers[ self::normalize( $header[ 0 ] ) ] = \trim( $header[ 1 ] );
                unset( $headers[ $key ] );
            } elseif ( 'http' === \substr( self::normalize( $value ), 0, 4 ) ) {
                $header = \explode( ' ', $value, 3 );
                $headers[ 'protocol' ] = $header[ 0 ];
                $headers[ 'code' ] = $header[ 1 ] ?? '';
                $headers[ 'message' ] = $header[ 2 ] ?? '';
                unset( $headers[ $key ] );
            }
        }

        return $headers;
    }

    static public function build( array $headers ) : array {
        if ( isset( $headers[ 'protocol' ] ) )
            $array[ 0 ] = $headers[ 'protocol' ] .
                ( isset( $headers[ 'code' ] ) ? ' ' . $headers[ 'code' ] : '' ) .
                ( isset( $headers[ 'message' ] ) ? ' ' . $headers[ 'message' ] : '' );
        else $array = [];

        unset( $headers[ 'protocol' ] );
        unset( $headers[ 'code' ] );
        unset( $headers[ 'message' ] );

        foreach ( $headers as $key => $value )
            $array[] = "$key: $value";

        return $array;
    }

    public function has( string $key ) : bool {
        return isset( $this->headers[ self::normalize( $key ) ] );
    }

    public function get( string $key ) : string {
        return $this->headers[ self::normalize( $key ) ] ?? '';
    }

    public function set( string $key, string $value ) : self {
        $this->headers[ self::normalize( $key ) ] = $value;
        return $this;
    }

    public function unset( string $key ) : self {
        unset( $this->headers[ self::normalize( $key ) ] );
        return $this;
    }

    public function fromArray( array $headers, bool $associative = false ) : self {
        $this->headers = $associative ? $headers : self::parse( $headers );
        return $this;
    }

    public function toArray( bool $associative = false ) : array {
        return $associative ? $this->headers : self::build( $this->headers );
    }
}