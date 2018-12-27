<?php
	/**
	 * Created by PhpStorm.
	 * User: 52297
	 * Date: 2018/12/26
	 * Time: 22:05
	 */

	interface iCustomer {
		/**
		 * 添加一个住客的信息
		 * @param string $password
		 * @param string $name
		 * @param int $age
		 * @param string $sex
		 * @param string $tel
		 * @param string $remark
		 * @return int 返回MySQL的AUTO_INCREMENT列的值（使用$this->db->insert_id()获取）
		 */
		public function insertUser(string $password,string $name,int $age,string $sex,string $tel,string $remark): int;

		/**
		 * 根据ID号查找住客
		 * @param int $Id
		 * @return array
		 */
		public function findUser(int $Id):array;

		/**
		 * 根据电话号码查找用户
		 * @param string $tel
		 * @return array
		 */
		public function findUserByTel(string $tel):array;

		/**
		 * 客户预定房间
		 * @param int $userID 客户ID
		 * @param int $roomID 房间ID
		 * @param int $startTime 预定的开始日期
		 * @param int $endTime 预定的结束日期
		 * @return bool
		 */
		public function bookRoom(int $userID, int $roomID, int $startTime, int $endTime) : bool;

		/**
		 * 办理住客入住，如果房间已经预定过，$timeLength设置为默认的0表示按照预定的时间进行
		 * 如果没有预定，那么需要提供该参数来直接入住。
		 * @param int $userId
		 * @param int $roomId
		 * @param int $timeLength
		 * @return bool
		 */
		public function confirmRoom(int $userId, int $roomId, int $timeLength = 0) : bool;

		/**
		 * 住客退房
		 * @param int $roomId
		 * @return bool
		 */
		public function vacateRoom(int $roomId) : bool;
	}

	class mCustomer extends MY_Model implements iCustomer {

	}
