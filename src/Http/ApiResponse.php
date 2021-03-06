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

use InvalidArgumentException;

class ApiResponse extends Response
{
    /**
     * @param string $wrapperKey
     * @param bool   $isOkay
     * @param mixed  $responseData
     * @param int    $responseCode
     */
    public function __construct($wrapperKey, $responseData = null, $responseCode = 200)
    {
        if (!is_string($wrapperKey)) {
            throw new InvalidArgumentException('parameter must be string');
        }
        if (!is_int($responseCode)) {
            throw new InvalidArgumentException('parameter must be integer');
        }

        $responseBody = [
            $wrapperKey => [
                'ok' => true,
            ],
        ];

        if (!is_null($responseData)) {
            $responseBody[$wrapperKey]['data'] = $responseData;
        }

        parent::__construct($responseCode, 'application/json');
        $this->setBody(json_encode($responseBody));
    }
}
