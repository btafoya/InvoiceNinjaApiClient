<?php
/**
 * Invoice Ninja Api Client for PHP
 *
 * @package   btafoya
 * @link      https://github.com/btafoya/InvoiceNinjaApiClient The SqueakyMindsPhpHelper GitHub project
 * @author    Brian Tafoya <btafoya@briantafoya.com>
 * @copyright 2018, Brian Tafoya.
 * @license   MIT
 * @license   https://opensource.org/licenses/MIT The MIT License
 * @category  InvoiceNinjaApiClient
 *
 * Copyright (c) 2018, Brian Tafoya
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 */

namespace btafoya;

use \Curl\Curl;

/**
 * Class InvoiceNinjaApiClientException
 * @package btafoya
 */
class InvoiceNinjaApiClientException extends \Exception {}

/**
 * Class InvoiceNinjaApiClient
 * @package btafoya
 */
class InvoiceNinjaApiClient {

	/**
	 * @var string
	 */
	public $apiUrl;

	/**
	 * @var string
	 */
	public $ninjaApiToken;

	/**
	 * @var bool
	 */
	public $verbose = false;

	/**
	 * InvoiceNinjaApiClient constructor.
	 *
	 * @param $apiUrl
	 * @param $ninjaApiToken
	 */
	private function __construct($apiUrl, $ninjaApiToken)
	{
		// Your "heavy" initialization stuff here
		$this->curl = new Curl();
		$this->apiUrl = $apiUrl;
		$this->ninjaApiToken = $ninjaApiToken;
	}

	/**
	 * @throws InvoiceNinjaApiClientException
	 */
	public function getProducts()
	{
		try {
			$this->get($this->apiUrl . "/api/v1/products");
		} catch (InvoiceNinjaApiClientException $e) {
			throw new InvoiceNinjaApiClientException("getProducts error: " . $e->getMessage());
		}
	}

	/**
	 * @param $url
	 *
	 * @return null
	 * @throws InvoiceNinjaApiClientException
	 */
	private function get($url) {
		$curl = new Curl();

		$curl->setHeader("X-Ninja-Token", $this->ninjaApiToken);

		$curl->get($url);

		if ($curl->error) {
			throw new InvoiceNinjaApiClientException('Error: ' . $curl->errorCode . ': ' . $curl->errorMessage);
		}

		return $curl->response;
	}

	/**
	 * @param bool $state
	 */
	public function verbose($state = true) {
		$this->verbose = $state;
	}
}