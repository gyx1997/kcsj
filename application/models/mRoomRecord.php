<?php
	/**
	 * Created by PhpStorm.
	 * User: 52297
	 * Date: 2018/12/27
	 * Time: 16:00
	 */

	interface iRoomRecord {

		/**
		 * 查找指定时间的入住记录
		 * @param int $beginTime
		 * @param int $endTime
		 * @return array
		 */
		public function getRoomRecord(int $beginTime, int $endTime) : array;

		/**
		 * 得到某个住客的所有入住记录
		 * @param int $userId
		 * @return array
		 */
		public function getUserRoomRecord(int $userId) : array;

	}

	class mRoomRecord extends MY_Model implements iRoomRecord {

	}
