<?php
/**
 * Copyright 2026 ShopeX (https://www.shopex.cn)
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
class redis_set_peer
{
	protected $name_space;

    /**
     * __construct
     * @return mixed 返回值
     */
    public function  __construct()
	{
		$this->name_space = get_class($this);
	}

	/**
	 * @return php_redis
	 */
	public function get_connection()
	{
		return redis_pool::get('master');
	}

	public function clear($key)
	{
		$this->get_connection()->delete($this->name_space . $key);
	}

	public function add( $key, $value )
	{
		return $this->get_connection()->add_member($this->name_space . $key, $value);
	}

	public function remove( $key, $value )
	{
		return $this->get_connection()->remove_member($this->name_space . $key, $value);
	}

	public function is_member( $key, $value )
	{
		return $this->get_connection()->is_member($this->name_space . $key, $value);
	}

	public function get_all( $key )
	{
		return $this->get_connection()->get_members($this->name_space . $key);
	}

	public function get_count( $key )
	{
		return $this->get_connection()->get_members_count($this->name_space . $key);
	}
}