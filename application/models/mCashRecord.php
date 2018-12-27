<?php
	/**
	 * Created by PhpStorm.
	 * User: 52297
	 * Date: 2018/12/27
	 * Time: 15:58
	 */

	interface iCashRecord {
		/**
		 * 插入一条账单记录
		 * @param string $type
		 * @param int $date
		 * @param int $cashNumber
		 * @param string $remark
		 * @return int
		 */
		public function insertCashRecord(string $type, int $date, int $cashNumber, string $remark = '') : int;

		/**
		 * 得到所有的账单
		 * @return array
		 */
		public function getCashRecords() : array;

		/**
		 * 得到上个月的账单记录（先转换成上个月的开始和截止时间戳，然后使用WHERE查询）
		 * @return array
		 */
		public function getLastMonthlyRecords() : array;
	}

	class mCashRecord extends MY_Model implements iCashRecord {

	}
