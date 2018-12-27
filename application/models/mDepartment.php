<?php
	/**
	 * Created by PhpStorm.
	 * User: 52297
	 * Date: 2018/12/26
	 * Time: 22:28
	 */

	interface iDepartment {

		/**
		 * 创建一个部门
		 * @param string $deptName
		 * @return int
		 */
		public function insertDepartment(string $deptName) : int;

		/**
		 * 修改部门负责人
		 * @param int $deptId
		 * @param int $staffId
		 * @return bool
		 */
		public function setManager(int $deptId, int $staffId) : bool;

		/**
		 * 修改部门的薪水
		 * @param int $deptId
		 * @param int $salary
		 * @return bool
		 */
		public function setDeptSalary(int $deptId, int $salary) : bool;

		public function deleteDepartment(int $deptId) : bool;
	}

	class mDepartment {

	}
