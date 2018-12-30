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
		public function insertUser(string $password,string $name,int $age,string $sex,string $tel,string $remark)
		{
			$data = array('password'=> $password, 'name' => $name, 'age' => $age,'tel' => $tel,'remark' => $remark);
			return $this->db->insert_id('user',$data);
		}

		/**
		 * 根据ID号查找住客
		 * @param int $Id
		 * @return array
		 */
		public function findUser(int $Id):array
		{
			$sql = "SELECT * FROM user WHERE ID = $ID";
			$rs = $this->db->query($sql);
			$result = $rs->result();
			return $result;
		}

		/**
		 * 根据电话号码查找用户
		 * @param string $tel
		 * @return array
		 */
		public function findUserByTel(string $tel):array
		{
			$sql = "SELECT * FROM user WHERE tel = $tel";
			$rs = $this->db->query($sql);
			$result = $rs->result();
			return $result;
		}

		/**
		 * 客户预定房间
		 * @param int $userID 客户ID
		 * @param int $roomID 房间ID
		 * @param int $startTime 预定的开始日期
		 * @param int $endTime 预定的结束日期
		 * @return bool
		 */
		public function bookRoom(int $userID, int $roomID, int $startTime, int $endTime) : bool;
		{
			$sql = "INSERT INTO book(roomID,userID,checkstate,starttime,endtime)"."VALUES ('$roomID','$userID','预定','$startTime','$endTime')";
			$result = $this->db->query($sql);
			if($result)return 1;
			else return 0;
		}

		/**
		 * 办理住客入住，如果房间已经预定过，$timeLength设置为默认的0表示按照预定的时间进行
		 * 如果没有预定，那么需要提供该参数来直接入住。
		 * @param int $userId
		 * @param int $roomId
		 * @param int $timeLength
		 * @return bool
		 */
		public function confirmRoom(int $userId, int $roomId, int $timeLength = 0) : bool;
		{
			if($timeLength == 0)
			{
				$sql = "UPDATE book SET checkstate = '入住' WHERE userID = $userId AND roomID = $roomId";
				$result = $this->db->query(sql);
				if($result)return 1;
				else return 0;
			}
			else
			{
				//当前
				$month = date("m",time())
		    	$day = date("d",time());
    			$year =date("Y",time());
    			$begin = mktime(0, 0, 0, $month,$day, $year);
    			$day = $day + $timeLength;
    			if (($year % 4 == 0 && $year % 100 != 0)||$year % 400 == 0)
    			{
        			if($month == 1||$month == 3||$month == 5||$month == 7||$month == 8||$month == 10||$month == 12)
        				if($day > 31)
        				{
        					$day = $day - 31;
        					$month = $month + 1;
        				}
        			if($month == 4||$month == 6||$month == 9||$month == 11)
        				if($day > 30)
        				{
        					$day = $day - 30;
        					$month = $month + 1;
        				}
        			if($month == 2)
        				if ($day > 29) 
        				{
        					$day = $day - 29;
			        		$month = $month + 1;
		        		}
		    		}
		    		else 
		    		{
		        		if($month == 1||$month == 3||$month == 5||$month == 7||$month == 8||$month == 10||$month == 12)
		        			if($day > 31)
	        				{
		        				$day = $day - 31;
	        					$month = $month + 1;
	        				}
	        			if($month == 4||$month == 6||$month == 9||$month == 11)
	        				if($day > 30)
	        				{
	        					$day = $day - 30;
	        					$month = $month + 1;
	        				}
	        			if($month == 2)
	        				if ($day > 28) 
	        				{
	        					$day = $day - 28;
	        					$month = $month + 1;
	        				}
	    			}
	    		}
	    		if($month > 12)
	    		{
	    			$month = $month -12;
	    			$year = $year + 1;
	    		}
    			//结束的时间戳
    			$end = mktime(23, 59, 59, $month, $days, $year);
				$sql = "INSERT INTO book(roomID,userID,checkstate,starttime,endtime)"."VALUES ('$roomID','$userID','入住','$begin','$end')";
				$result = $this->db->query(sql);
				if($result)return 1;
				else return 0;
			}
		}

		/**
		 * 住客退房
		 * @param int $roomId
		 * @return bool
		 */
		public function vacateRoom(int $roomId) : bool;
		{
			$sql = "SELECT roomID,customerID,starttime,endtime,remark FROM book WHERE roomID = $roomId";
			$data = $this->db->query(sql);
			$sql = "DELETE FROM book WHERE roomID = $roomId";
			$this->db->query(sql);
			if($this-db->insert_id('roomrecod',$data))return 1;
			else return 0;
		}
	}

	class mCustomer extends MY_Model implements iCustomer {

	}
