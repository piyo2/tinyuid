<?php

namespace piyo2\util\tinyuid;

use ErrorException;
use piyo2\util\base\Base;

final class TinyUID
{
	/** @var string */
	const BASE_DEFAULT = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';

	public static function generate(int $length = 14, string $base = self::BASE_DEFAULT): string
	{
		$byteLength = ceil($length * log(strlen($base)) / log(2) / 8);

		if (\is_callable('random_bytes')) {
			$bytes = random_bytes($byteLength);
		} elseif (\is_callable('openssl_random_pseudo_bytes')) {
			$bytes = \openssl_random_pseudo_bytes($byteLength);
		} else {
			throw new ErrorException('No cryptographically secure random function available');
		}

		return \substr(Base::convert(\bin2hex($bytes), '0123456789abcdef', $base), -$length);
	}
}
