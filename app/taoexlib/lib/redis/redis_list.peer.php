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
class redis_list_peer
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

	public function insert( $pk, $params, $at_bottom = true )
	{
		if ( $at_bottom )
		{
			$this->get_connection()->append($this->name_space . $pk, $params);
		}
		else
		{
			$this->get_connection()->prepend($this->name_space . $pk, $params);
		}
	}

	public function length( $pk )
	{
		return $this->get_connection()->get_list_length($this->name_space . $pk);
	}

	public function clear( $pk )
	{
		$this->get_connection()->delete($this->name_space . $pk);
	}

	public function delete( $pk, $params )
	{
		$this->get_connection()->remove_by_filter($this->name_space . $pk, $params);
	}

	public function truncate( $pk, $limit, $offset = 0 )
	{
		$this->get_connection()->truncate_list($this->name_space . $pk, $limit, $offset);
	}

	public function get_list( $pk, $params = array(), $limit = null, $offset = 0 )
	{
		if ( !$limit )
		{
			$limit = $this->get_connection()->get_list_length($this->name_space . $pk);
		}

		if ( $params )
		{
			return $this->get_connection()->get_filtered_list($this->name_space . $pk, $params, $limit, $offset);
		}

		return $this->get_connection()->get_list($this->name_space . $pk, $limit, $offset);
	}
}