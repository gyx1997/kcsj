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
		{
			$data = array('name'=> $deptName,'salary' => 0);
			return $this->db->insert_id('user',$data);
		}

		/**
		 * 修改部门负责人
		 * @param int $deptId
		 * @param int $staffId
		 * @return bool
		 */
		public function setManager(int $deptId, int $staffId) : bool;
		{
			$sql = "UPDATE department SET sataffID = $staffId WHERE ID = $deptId";
			$rs = $this->db->query($sql);
			if($rs)return 1;
			else return 0;
		}	

		/**
		 * 修改部门的薪水
		 * @param int $deptId
		 * @param int $salary
		 * @return bool
		 */
		public function setDeptSalary(int $deptId, int $salary) : bool;
		{
			$sql = "UPDATE department SET salary = $salary WHERE ID = $deptId";
			$rs = $this->db->query($sql);
			if($rs)return 1;
			else return 0;
		}

		public function deleteDepartment(int $deptId) : bool;
		{
			$sql = "DELETE FROM department WHERE ID = $deptId";
			$rs = $this->db->query($sql);
			if($rs)return 1;
			else return 0;
		}
	}

	class mDepartment {

	}
