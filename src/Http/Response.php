<?php
/**
 *  Copyright (C) 2016 SURFnet.
 *
 *  This program is free software: you can redistribute it and/or modify
 *  it under the terms of the GNU Affero General Public License as
 *  published by the Free Software Foundation, either version 3 of the
 *  License, or (at your option) any later version.
 *
 *  This program is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU Affero General Public License for more details.
 *
 *  You should have received a copy of the GNU Affero General Public License
 *  along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

namespace SURFnet\VPN\Common\Http;

class Response
{
    /** @var int */
    private $statusCode;

    /** @var array */
    private $headers;

    /** @var string */
    private $body;

    public function __construct($statusCode = 200, $contentType = 'text/plain')
    {
        $this->statusCode = $statusCode;
        $this->headers = [
            'Content-Type' => $contentType,
        ];
        $this->body = '';
    }

    public function addHeader($key, $value)
    {
        $this->headers[$key] = $value;
    }

    public function getHeader($key)
    {
        if (array_key_exists($key, $this->headers)) {
            return $this->headers[$key];
        }
    }

    public function setBody($body)
    {
        $this->body = $body;
    }

    public function getStatusCode()
    {
        return $this->statusCode;
    }

    public function getBody()
    {
        return $this->body;
    }

    public function send()
    {
        http_response_code($this->statusCode);
        foreach ($this->headers as $key => $value) {
            header(sprintf('%s: %s', $key, $value));
        }

        echo $this->body;
    }
}
