<?php namespace App;

/**
 * Copyright (C) 2014, 2015 Olav Schettler https://cis.pm
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */  

/**
 * Base class for HTTP/JSON-based APIs
 */
class API {

    const ROOT_URL = 'http://api.chefkoch.de/v2';
    const USER_AGENT = 'CIS';

    /**
     * Call REST API, using file_get_contents
     * and a stream_context for POST data or additional headers.
     *
     * Does not use CURL as libcurl has disabled https for PUT
     * in many installations.
     */
    static function call($url, $post=false, $headers=array()) {
        $context_opt = array();

        if (strpos($url, ' ') !== false) {
            list($verb, $url) = explode(' ', $url);
        }
        else {
            $verb = 'GET';
        }

        //$scheme = parse_url($url, PHP_URL_SCHEME);
        $scheme = 'http'; // This needs to be "http" even for "https"
        $context_opt = array($scheme => array());

        if ($post) {

            if (is_string($post)) {
                $context_opt[$scheme] = array(
                    'method' => 'POST',
                    'content' => $post,
                );
                $headers[] = 'Content-Type: application/x-www-form-urlencoded';
            }
            else {
                $context_opt[$scheme] = array(
                    'method' => 'POST',
                    'content' => json_encode($post),
                );
                $headers[] = 'Content-Type: application/json';
            }
        }

        if ($verb != 'GET') {
            $context_opt[$scheme]['method'] = $verb;
        }

        $headers[] = 'Accept: application/json';
        $headers[] = 'User-Agent: ' . self::USER_AGENT;

        if(!empty($_SESSION['access_token'])) {
            $headers[] = 'Authorization: Bearer ' . $_SESSION['access_token'];
        }

        $context_opt[$scheme] += array(
            'header' => join('', array_map(function ($h) {
                return "$h\r\n";
            }, $headers))
        );

        $context = stream_context_create($context_opt);

        try {
            $response = file_get_contents($url, /*include_path*/false, $context);
            return [
                'status' => 'success',
                'content' => json_decode($response)
            ];
        }
        catch (\Exception $e) {
            $response = [ 'status' => 'error' ];
            if (preg_match('#(\S+)\s+(\d+)\s+(.*)$#', $e->getMessage(), $values)) {
                return $response + [
                    'code' => $values[2],
                    'message' => $values[3],
                ];
            }
            else {
                return $response + [
                    'code' => 999,
                    'message' => 'Unknown reason',
                ];
            }
        }
    }
}
