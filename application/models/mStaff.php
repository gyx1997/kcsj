
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
		public function insertStaff(string $password, int $deptId, string $name, int $age, string $sex, string $tel,string $remark):bool
		{
			$sql = "INSERT INTO staff(password,departmentID,age,sex,tel,remark)"."VALUES ('$password','$deptId','$age','$sex','$tel','$remark')";
				$rs = $this-db->query($sql);
				if($rs)return 1;
				else return 0;
		}

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
		public function updateStaff(int $staffId,string $password = null, int $deptId = null, int $age = null, int $sex = null, string $tel = null, string $remark = null) : bool;
		{
			$arr = array();
			if($password != null)
				$temp = array('password' => $password );
			$arr = $array_merge($arr,$temp);
			if($deptId != null)
				$temp = array('departmentID' => $deptId );
			$arr = $array_merge($arr,$temp);
			if($age != null)
				$temp = array('age' => $age);
			$arr = $array_merge($arr,$temp);
			if($sex != null)
				$temp = array('sex' => $sex );
			$arr = $array_merge($arr,$temp);
			if($tel != null)
				$temp = array('tel' => $tel );
			$arr = $array_merge($arr,$temp);
			if($remark != null)
				$temp = array('remark' => $remark );
			$arr = $array_merge($arr,$temp);
			$sql = "DELETE FROM department WHERE ID = $staffId";
			$this->db->query($sql);
			if($this->db->insert_id('department',$arr))
			{
				return 1;
			}
			else return 0;
		}
		public function deleteStaff(int $staffId)
		{
			$sql = "DELETE FROM staff WHERE ID = $staffId";
			$re = $this->db->query($sql);
			if($re)return 1;
			else return 0;
		}
	}

	class mStaff extends MY_Model implements iStaff {

	}

