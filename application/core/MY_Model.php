<?php

class MY_Model extends CI_Model
{
	/**
	 * @var string 数据表名
	 */
	protected $_table_name = '';
	/**
	 * @var string 数据表前缀，建表时注意
	 */
	protected $_table_prefix = 'jdglxt';
	/**
	 * @var string 主键名
	 */
	protected $_pk = '';

	/**
	 * MY_Model constructor.
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * 根据指定的Where条件组合判断数据表的记录是否存在
	 * @param array $where_segment_array
	 * @return bool
	 */
	protected function _exists(array $where_segment_array): bool
	{
		foreach ($where_segment_array as $field => $value) {
			$this->db->where($field, $value);
		}
		$this->db->select('COUNT(*)');
		$query = $this->db->get($this->_table());
		$result = $query->row_array();
		return intval($result['COUNT(*)']) === 1;
	}

	/**
	 * 得到当前Model的数据表
	 * @return string
	 */
	protected function _table(): string
	{
		return $this->_table_prefix . '_' . $this->_table_name;
	}

	/**
	 * 增加表前缀得到完整的表明
	 * @param string $table_name
	 * @return string
	 */
	public function make_table(string $table_name): string
	{
		return $table_name . '_' . $table_name;
	}

	/**
	 * 从数据表中获取全部数据
	 * @param array $where_segment_array
	 * @param string $order_field
	 * @param string $order_direction
	 * @param int $start
	 * @param int $limit
	 * @return array
	 */
	protected function _fetch_all(array $where_segment_array = array(), string $order_field = '', string $order_direction = '', int $start = 0, int $limit = 0): array
	{
		$this->_pack_query_args(
			$where_segment_array,
			$order_field,
			$order_direction,
			$start,
			$limit
		);
		$query_result = $this->db->get($this->_table());
		if (empty($query_result->result_array())) {
			return array();
		}
		return $query_result->result_array();
	}

	/**
	 * 包装查询参数
	 * @param array $where_segment_array
	 * @param string $order_field
	 * @param string $order_direction
	 * @param int $start
	 * @param int $limit
	 */
	private function _pack_query_args(array $where_segment_array = array(), string $order_field = '', string $order_direction = '', int $start = 0, int $limit = 0): void
	{
		foreach ($where_segment_array as $field => $value) {
			$this->db->where($field, $value);
		}
		$order_field !== '' && $order_direction !== '' && $this->db->order_by($order_field, $order_direction);
		$limit !== 0 && $this->db->limit($limit, $start);
		return;
	}

	/**
	 * 从数据库中取一条数据
	 * @param array $where_segment_array
	 * @param string $order_field
	 * @param string $order_direction
	 * @return array
	 */
	protected function _fetch_first(array $where_segment_array = array(), string $order_field = '', string $order_direction = ''): array
	{
		$this->_pack_query_args(
			$where_segment_array,
			$order_field,
			$order_direction,
			0,
			1
		);
		$query_result = $this->db->get($this->_table());
		if (empty($query_result->row_array())) {
			return array();
		}
		return $query_result->row_array();
	}

	/**
	 * 使用原始的数据库查询语句查询并取所有记录。
	 * @param string $query_str
	 * @param array $parameters
	 * @return array
	 */
	protected function _fetch_all_raw(string $query_str, array $parameters = array()): array
	{
		$qr = $this->db->query($query_str, $parameters);
		if (empty($qr->result_array())) {
			return array();
		}
		return $qr->result_array();
	}

	/**
	 * @param $query_str
	 * @param array $parameters
	 * @return array
	 */
	protected function _fetch_first_raw($query_str, $parameters = array()): array
	{
		$qr = $this->db->query($query_str, $parameters);
		if (empty($qr->row_array())) {
			return array();
		}
		return $qr->row_array();
	}

	/**
	 * 根据主键获取数据
	 * @param string $pk_val
	 * @return array
	 */
	public function get(string $pk_val): array
	{
		$this->db->where($this->_pk, $pk_val);
		$query_result = $this->db->get($this->_table(), 1);
		if (empty($query_result->row_array())) {
			return array();
		}
		return $query_result->row_array();
	}

	/**
	 * 判断当前主键的记录是否存在
	 * @param string $pk_val
	 * @return bool
	 */
	public function exist(string $pk_val): bool
	{
		$this->db->where($this->_pk, $pk_val);
		$this->db->select('COUNT(1)');
		$query_result = $this->db->get($this->_table(), 1);
		return intval($query_result->row_array()['COUNT(1)']) !== 0;
	}

	/**
	 * 执行update操作，根据主键
	 * @param string $pk_val
	 * @param array $data
	 */
	public function set(string $pk_val, array $data = array()) : void
	{
		$this->db->where($this->_pk, $pk_val);
		$this->db->update($this->_table(), $data);
	}
}
