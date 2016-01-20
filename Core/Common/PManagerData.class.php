<?php
class PManagerData extends CodonData
{
	public function pilots()
	{
		$sql="SELECT * FROM phpvms_pilots";
		
		return DB::get_results($sql);
	}
	
	public function getpilotbyemail($email)
	{
		$sql="SELECT * FROM phpvms_pilots WHERE email = '$email' ";
		
		return DB::get_row($sql);
	}
	
	public function checkpilot($id)
	{
		$sql="SELECT * FROM pilot_manager WHERE pid = '$id' ";
		
		return DB::get_row($sql);
	}
	
	public function createpilot($pid, $pfname, $plname)
	{
		$sql = "INSERT INTO pilot_manager (pid, pfname, plname, blank, warning, welcome, message, datesent) 
								  VALUES ('$pid', '$pfname', '$plname', '0', '0', '0', 'welcome', '')";
			DB::query($sql);
	}
	
	public function param($pid)
	{
		$sql="SELECT * FROM pilot_manager WHERE pid = '$pid'";
		
		return DB::get_row($sql);
	}
	
	public function getpirep($pilotid)
	{
		$sql="SELECT * FROM phpvms_pireps WHERE pilotid = '$pilotid' ORDER BY submitdate DESC";
		
		return DB::get_row($sql);
	}
	
	public function warningsent($pilot, $message)
		{
			$sent = self::param($pilot);
			$sen = $sent->warning;
			$sql = "UPDATE pilot_manager SET warning='$sen' + '1', message='$message', datesent=NOW() WHERE pid='$pilot'";
			
			DB::query($sql);
		}
		
	public function welcomesent($pilot, $message)
		{
			$sent = self::param($pilot);
			$sen = $sent->welcome;
			$sql = "UPDATE pilot_manager SET welcome='$sen' + '1', message='$message', datesent=NOW() WHERE pid='$pilot'";
			DB::query($sql);
		}
	
	public function blanksent($pilot, $message)
		{
			$sent = self::param($pilot);
			$sen = $sent->blank;
			$sql = "UPDATE pilot_manager SET blank='$sen' + '1', message='$message', datesent=NOW() WHERE pid='$pilot'";
			DB::query($sql);
		}
}
?>