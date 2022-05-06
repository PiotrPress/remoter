<?php declare( strict_types = 1 );

namespace PiotrPress\Remoter;

class Url {
    protected string $url = '';

    public function __construct( string $url = '' ) {
        $this->set( $url );
    }

    static public function build( array $components ) : string {
        $url = isset( $components[ 'scheme' ] ) ? ( $components[ 'scheme' ] . '://' ) : '';
        $url .= $components['user'] ?? '';
        $url .= isset( $components[ 'pass' ] ) ? ( ':' . $components[ 'pass' ] ) : '';
        $url .= ( isset( $components[ 'user' ] ) or isset( $components[ 'pass' ] ) ) ? '@' : '';
        $url .= $components[ 'host' ] ?? '';
        $url .= isset( $components[ 'port' ] ) ? ( ':' . $components[ 'port' ] ) : '';
        $url .= $components['path'] ?? '';
        $url .= isset( $components[ 'query' ] ) ? ( '?' . $components[ 'query' ] ) : '';
        $url .= isset( $components[ 'fragment' ] ) ? ( '#' . $components[ 'fragment' ] ) : '';

        return $url;
    }

    static public function parse( string $url ) : array {
        return \array_merge( [
            'scheme' => '',
            'user' => '',
            'pass' => '',
            'host' => '',
            'port' => '',
            'path' => '',
            'query' => '',
            'fragment' => ''
        ], \parse_url( $url ) );
    }

    public function set( string $url ) : self {
        $this->url = $url;
        return $this;
    }

    public function get() : string {
        return $this->url;
    }

    public function setScheme( string $scheme ) : self {
        $this->url = self::build( \array_merge( self::parse( $this->url ), [ 'scheme' => $scheme ] ) );
        return $this;
    }

    public function getScheme() : string {
        return self::parse( $this->url )[ 'scheme' ];
    }

    public function setUser( string $user ) : self {
        $this->url = self::build( \array_merge( self::parse( $this->url ), [ 'user' => $user ] ) );
        return $this;
    }

    public function getUser() : string {
        return self::parse( $this->url )[ 'user' ];
    }

    public function setPass( string $pass ) : self {
        $this->url = self::build( \array_merge( self::parse( $this->url ), [ 'pass' => $pass ] ) );
        return $this;
    }

    public function getPass() : string {
        return self::parse( $this->url )[ 'pass' ];
    }

    public function setHost( string $host ) : self {
        $this->url = self::build( \array_merge( self::parse( $this->url ), [ 'host' => $host ] ) );
        return $this;
    }

    public function getHost() : string {
        return self::parse( $this->url )[ 'host' ];
    }

    public function setPort( string $port ) : self {
        $this->url = self::build( \array_merge( self::parse( $this->url ), [ 'port' => $port ] ) );
        return $this;
    }

    public function getPort() : string {
        return self::parse( $this->url )[ 'port' ];
    }

    public function setPath( string $path ) : self {
        $this->url = self::build( \array_merge( self::parse( $this->url ), [ 'path' => $path ] ) );
        return $this;
    }

    public function getPath() : string {
        return self::parse( $this->url )[ 'path' ];
    }

    public function setQuery( string $query ) : self {
        $this->url = self::build( \array_merge( self::parse( $this->url ), [ 'query' => $query ] ) );
        return $this;
    }

    public function getQuery() : string {
        return self::parse( $this->url )[ 'query' ];
    }

    public function setFragment( string $fragment ) : self {
        $this->url = self::build( \array_merge( self::parse( $this->url ), [ 'fragment' => $fragment ] ) );
        return $this;
    }

    public function getFragment() : string {
        return self::parse( $this->url )[ 'fragment' ];
    }

    public function toArray() : array {
        return self::parse( $this->url );
    }

    public function __toString() : string {
        return $this->url;
    }
}