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
		public function insertCashRecord(string $type, int $date, int $cashNumber, string $remark = '')
		{
			$sql = "INSERT INTO cashrecord(time,money,type,remark)"."VALUES ('$date','$cashNumber','$type','$remark')";
			$result = $this->db->query($sql);
			if($result)return 1;
			else return 0;
		}

		/**
		 * 得到所有的账单
		 * @return array
		 */
		public function getCashRecords() : array;
		{
			$sql = "SELECT * FROM cashrecord";
			$result = $this->db->query(sql);
			return $result->result_array();
		}

		/**
		 * 得到上个月的账单记录（先转换成上个月的开始和截止时间戳，然后使用WHERE查询）
		 * @return array
		 */
		public function getLastMonthlyRecords() : array;
		{
			//上当前月份
		    $month = date("m", strtotime("last month"));
    		//找到上个月份的开始时间戳和结束时间戳
    		$days = date("t", strtotime("last month"));
    		//mktime(hour,minute,second,month,day,year,is_dst);
    		$lastmonth_year = date("Y");
    		if ($month == 1) 
    		{
        		$year = date("Y");
        		$lastmonth_year = $year - 1;
    		}
    		//上个月开始的时间戳
    		$begin = mktime(0, 0, 0, $month, 1, $lastmonth_year);
    		//上个月结束的时间戳
    		$end = mktime(23, 59, 59, $month, $days, $lastmonth_year);
    		$sql = "SELECT * FROM cashrecord WHERE date >= begin AND date <= end";
    		$result = $this->db->query(sql);
    		return $result->result_array();
		}
	}

	class mCashRecord extends MY_Model implements iCashRecord {

	}