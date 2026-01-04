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
class redis_peer
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

	public function next_id()
	{
		return $this->get_connection()->inc($this->name_space . 'pk');
	}

	public function last_id()
	{
		return $this->get_connection()->get($this->name_space . 'pk');
	}

	public function insert( $data )
	{
		$data['id'] = $this->next_id();
		$this->get_connection()->set($this->name_space . 'item' . $data['id'], $data);
		return $data['id'];
	}

	public function update( $id, $data )
	{
		$data = array_merge($this->get_by_id($id), $data);
		$this->get_connection()->set($this->name_space . 'item' . $id, $data);
	}

	public function get_by_id( $id )
	{
		return $this->get_connection()->get($this->name_space . 'item' . $id);
	}

	public function delete( $id )
	{
		return $this->get_connection()->delete($this->name_space . 'item' . $id);
	}
}