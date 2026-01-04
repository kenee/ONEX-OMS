<?php
/**
 * Copyright 2012-2026 ShopeX (https://www.shopex.cn)
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */
class redis_pool
{
	private static $connections = array();
	private static $servers = array();

	public static function add_servers( $list )
	{
		foreach ( $list as $alias => $data )
		{
			self::$servers[$alias] = $data;
		}
	}

	public static function get( $alias )
	{
		if ( !array_key_exists($alias, self::$connections) )
		{
			self::$connections[$alias] = new php_redis(self::$servers[$alias][0], self::$servers[$alias][1]);
		}

		return self::$connections[$alias];
	}
}