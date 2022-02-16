<?php

function Save($FileName, $data){
  $Path = $FileName."_".date('Y-m-d').".txt";
  $mode = (!file_exists($Path)) ? 'w':'a';
  $file = fopen($Path, $mode);
  fwrite($file, "\r\n". $data);
  fclose($file);
}


	include "../DBCon.php"; 
	$connectionInfo = array( "UID"=>$uid,                              
							 "PWD"=>$pwd,                              
							 "Database"=>$databaseName);   
		
	 
	$conn = sqlsrv_connect( $serverName, $connectionInfo);   

	if($conn == false){
		echo "Internal Server ERROR: Cannot connect to DB";
	}

	#MEMBER
	$sql = "Select MemberOid, AccountID, MemberID, JoinDate, DateOfBirth, City, Email, PhoneNumber, NoOfChild, YoungestKidDOB, EldestKidDOB, AcqChannel From dbo.V_AIMIA_MEMBER_DATA where dbo.getdateOnly(CreatedOn)<=dbo.GetDateOnly(getdate())";
	$stmt = sqlsrv_prepare($conn, $sql);

	if (!sqlsrv_execute($stmt)) {
		Save('Your code is fail!');
		die;}

	while( $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC) ) {	
	  	Save("1member", $row["MemberOid"]." | ".$row["AccountID"]." | ".$row["MemberID"]." | ".$row["JoinDate"]." | ".$row["DateOfBirth"]." | ".$row["City"]." | ".$row["Email"]." | ".$row["PhoneNumber"]." | ".$row["NoOfChild"]." | ".$row["YoungestKidDOB"]." | ".$row["EldestKidDOB"]." | ".$row["AcqChannel"]);
	}

	#CHILD
	$sql = "Select ChildOid, AccountID, ChildName, ProcomDate, BirthDate, ActualProduct, PrevProduct, PrevProdSegment, CreatedOn From V_AIMIA_CHILD_DATA";
	$stmt = sqlsrv_prepare($conn, $sql);

	if (!sqlsrv_execute($stmt)) {
		Save('Your code is fail!');
		die;}

	while( $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC) ) {	
	  	Save("1child", $row["ChildOid"]." | ".$row["AccountID"]." | ".$row["ChildName"]." | ".$row["ProcomDate"]."|".$row["BirthDate"]."|".$row["ActualProduct"]."|".$row["PrevProduct"]."|".$row["PrevProdSegment"]."|".$row["CreatedOn"]);
	}

	#POINTTRANS
	$sql = "Select Oid, FK_MEMBER_ID, FK_PERIOD_ID, FK_CHANNEL_ID, FK_SUBCHANNEL_ID, Source, Sub_Source, Outlet_Group_Id, Outlet_Id, FK_PRODUCT_ID, FK_PROD_GRAM_ID, Qty, Bonus_Point, CreatedOn, dbo.getDateOnly(Recv_Date) RecvDate, Trans_Date, PricePerUnit From T_LOYALTY_POINT_TRANS where dbo.getdateOnly(CreatedOn)<=dbo.GetDateOnly(getdate())";
	$stmt = sqlsrv_prepare($conn, $sql);

	if (!sqlsrv_execute($stmt)) {
		Save('Your code is fail!');
		die;}

	while( $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC) ) {	
	  	Save("1pointtrans", $row["Oid"]."|".$row["FK_MEMBER_ID"]."|".$row["FK_PERIOD_ID"]."|".$row["FK_CHANNEL_ID"]."|".$row["FK_SUBCHANNEL_ID"]."|".$row["Source"]."|".$row["Sub_Source"]."|".$row["Outlet_Group_Id"]."|".$row["Outlet_Id"]."|".$row["FK_PRODUCT_ID"]."|".$row["FK_PROD_GRAM_ID"]."|".$row["Qty"]."|".$row["Bonus_Point"]."|".date_format($row["CreatedOn"], 'Y-m-d H:i:s')."|".$row["RecvDate"]."|".date_format($row["Trans_Date"], 'Y-m-d H:i:s')."|".$row["PricePerUnit"]);
	}

	#REDEEM
	$sql = "Select Oid, FK_MEMBER_ID, FK_PERIOD_ID, ChannelID, SubChannelId, RewardId, Qty, TotalPoint, CreatedOn, _OldStatus, Status From T_LOYALTY_POINT_REDEEM where dbo.getdateOnly(CreatedOn)>=dbo.GetDateOnly(getdate()-7)";
	$stmt = sqlsrv_prepare($conn, $sql);

	if (!sqlsrv_execute($stmt)) {
		Save('Your code is fail!');
		die;}

	while( $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC) ) {	
	  	Save("1pointredeem", $row["Oid"]."|".$row["FK_MEMBER_ID"]."|".$row["FK_PERIOD_ID"]."|".$row["ChannelID"]."|".$row["SubChannelId"]."|".$row["RewardId"]."|".$row["Qty"]."|".$row["TotalPoint"]."|".$row["CreatedOn"]."|".$row["_OldStatus"]."|".$row["Status"]);
	}

	#PERIOD
	$sql = "Select Oid, PeriodName, StartDate, EndDate From M_LOYALTY_PERIOD";
	$stmt = sqlsrv_prepare($conn, $sql);

	if (!sqlsrv_execute($stmt)) {
		Save('Your code is fail!');
		die;}

	while( $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC) ) {	
	  	Save("1m_period", $row["Oid"]."|".$row["PeriodName"]."|".$row["StartDate"]."|".$row["EndDate"]);
	}

	#CHANNEL
	$sql = "Select Oid, ChannelName From M_LOYALTY_CHANNEL";
	$stmt = sqlsrv_prepare($conn, $sql);

	if (!sqlsrv_execute($stmt)) {
		Save('Your code is fail!');
		die;}

	while( $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC) ) {	
	  	Save("1m_channel", $row["Oid"]."|".$row["ChannelName"]);
	}

	#SUBCHANNEL
	$sql = "Select Oid, SubChannelName, ChannelID From M_LOYALTY_SUBCHANNEL";
	$stmt = sqlsrv_prepare($conn, $sql);

	if (!sqlsrv_execute($stmt)) {
		Save('Your code is fail!');
		die;}

	while( $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC) ) {	
	  	Save("1m_subchannel", $row["Oid"]."|".$row["SubChannelName"]."|".$row["ChannelID"]);
	}

	#SOURCE
	$sql = "Select Oid, GroupName, GroupType From OutletGroup";
	$stmt = sqlsrv_prepare($conn, $sql);

	if (!sqlsrv_execute($stmt)) {
		Save('Your code is fail!');
		die;}

	while( $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC) ) {	
	  	Save("1m_source", $row["Oid"]."|".$row["GroupName"]."|".$row["GroupType"]);
	}

	#SUBSOURCE
	$sql = "Select Oid, Location, OutletGroup From Outlet";
	$stmt = sqlsrv_prepare($conn, $sql);

	if (!sqlsrv_execute($stmt)) {
		Save('Your code is fail!');
		die;}

	while( $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC) ) {	
	  	Save("1m_subsource", $row["Oid"]."|".$row["Location"]."|".$row["OutletGroup"]);
	}

	#PRODUCT
	$sql = "Select Oid, ProductName, Category From M_LOYALTY_PRODUCT";
	$stmt = sqlsrv_prepare($conn, $sql);

	if (!sqlsrv_execute($stmt)) {
		Save('Your code is fail!');
		die;}

	while( $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC) ) {	
	  	Save("1m_product", $row["Oid"]."|".$row["ProductName"]."|".$row["Category"]);
	}

	#PRODUCTGRAMMAGE
	$sql = "Select Oid, ProductId, GrammageName, Point, Price From M_LOYALTY_PRODUCT_GRAMMAGE";
	$stmt = sqlsrv_prepare($conn, $sql);

	if (!sqlsrv_execute($stmt)) {
		Save('Your code is fail!');
		die;}

	while( $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC) ) {	
	  	Save("1m_prodgrammage", $row["Oid"]."|".$row["ProductId"]."|".$row["GrammageName"]."|".$row["Point"]."|".$row["Price"]);
	}

	#REDEEMSTAT
	$sql = "Select Oid, StatusName From M_PL_LOYALTY_REDEEM_STATUS";
	$stmt = sqlsrv_prepare($conn, $sql);

	if (!sqlsrv_execute($stmt)) {
		Save('Your code is fail!');
		die;}

	while( $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC) ) {	
	  	Save("1m_redeemstat", $row["Oid"]."|".$row["StatusName"]);
	}

	#REWARDITEM
	$sql = "Select Oid, RewardCode, RewardName, Point From M_REWARD_ITEM";
	$stmt = sqlsrv_prepare($conn, $sql);

	if (!sqlsrv_execute($stmt)) {
		Save('Your code is fail!');
		die;}

	while( $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC) ) {	
	  	Save("1m_prodgrammage", $row["Oid"]."|".$row["RewardCode"]."|".$row["RewardName"]."|".$row["Point"]);
	}

	#POINTBALANCE
	$sql = "Select ID as MemberOid, TotalPointEarning, TotalRedeem, TotalPointEarning-ISNULL(TotalRedeem,0) as PointBalance, getdate() as DateTimeRet From VL_MEMBER_POINT Where PeriodName='REGULAR PROGRAM' And TotalPointEarning>0";
	$stmt = sqlsrv_prepare($conn, $sql);

	if (!sqlsrv_execute($stmt)) {
		Save('Your code is fail!');
		die;}

	while( $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC) ) {	
	  	Save("1pointbalance", $row["MemberOid"]."|".$row["TotalPointEarning"]."|".$row["TotalRedeem"]."|".$row["PointBalance"]."|".$row["DateTimeRet"]);
	}

	#ENROLLMENTSEGMENT
	$sql = "Select FK_MEMBER_ID as MemberOid, GroupID, Format(CreatedOn, 'yyyy-MM-dd') as AssignedDate From T_A_MEMBER_SEGMENT Where FK_SUB_SEGMENT_ID=13";
	$stmt = sqlsrv_prepare($conn, $sql);

	if (!sqlsrv_execute($stmt)) {
		Save('Your code is fail!');
		die;}

	while( $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC) ) {	
	  	Save("1new_enrollment_whitelist", $row["MemberOid"]."|".$row["GroupID"]."|".$row["AssignedDate"]);
	}


?>
