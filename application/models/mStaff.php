<?php
	/**
	 * Created by PhpStorm.
	 * User: 52297
	 * Date: 2018/12/26
	 * Time: 22:23
	 */

	interface iStaff {

		/**
		 * 插入一条员工信息
		 * @param string $password
		 * @param int $deptId
		 * @param string $name
		 * @param int $age
		 * @param string $sex
		 * @param string $tel
		 * @param string $remark
		 * @return bool
		 */
		public function insertStaff(string $password, int $deptId, string $name, int $age, string $sex, string $tel,string $remark):bool;

		/**
		 * 更新员工信息。如果该参数为null则该项不更新。
		 * @param string|null $password
		 * @param int|null $deptId
		 * @param int|null $age
		 * @param int|null $sex
		 * @param string|null $tel
		 * @param string|null $remark
		 * @return bool
		 */
		public function updateStaff(string $password = null, int $deptId = null, int $age = null, int $sex = null, string $tel = null, string $remark = null) : bool;
		public function deleteStaff(int $staffId);
	}

	class mStaff extends MY_Model implements iStaff {

	}
