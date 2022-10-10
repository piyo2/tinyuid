<?php

namespace piyo2\util\tinyuid;

use ErrorException;

final class TinyUID
{
	public static function generate(int $length = 14): string
	{
		if (\is_callable('random_bytes')) {
			$bytes = random_bytes(ceil($length / 2));
		} elseif (\is_callable('openssl_random_pseudo_bytes')) {
			$bytes = openssl_random_pseudo_bytes(ceil($length / 2));
		} else {
			throw new ErrorException('No cryptographically secure random function available');
		}
		return substr(bin2hex($bytes), 0, $length);
	}
}
