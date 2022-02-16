<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mpartnership extends CI_Model{

    function Auth($Auth){
        $this->db->reconnect();
        $qry="EXEC SP_Partnership_Auth '".$Auth."'";
        $res = $this->db->query($qry);

        if ($res->num_rows() > 0)
            return $res->result();
        else
            return array();
    }

    #1 API Verification
    function Verification($PartnerID, $Ip){
        $qryProc="EXEC SP_Partnership_Verification ".$PartnerID.", '".$Ip."'";
        $this->db->query($qryProc);

        $qry ="
		SELECT  
		DISTINCT BatchName BatchNo, A.PartnerMemberID MemberCardID FROM T_Partnership A 
		where dbo.getDateOnly(a.CreatedOn)>='2021-03-01' and PartnershipName=".$PartnerID." and ValidationStatus=2
 		and FK_MEMBER_ID IN (SELECT FK_MEMBER_ID FROM T_OPT_INOUT where OptType=7)
		and FK_MEMBER_ID NOT IN (SELECT FK_MEMBER_ID FROM T_OPT_INOUT where OptType=8)  
	";
        $res = $this->db->query($qry);

        $qryDone="Update T_Partnership set ValidationStatus=null where ValidationStatus=2";
        $this->db->query($qryDone);

        if ($res->num_rows() > 0)
            return $res->result();
        else
            return array();
    }

    #2 API Update Member
    function UpdateMember($PartnerID, $MemberCardID, $Status, $SCVFilename, $Ip){
        $qryProc="EXEC SP_Partnership_Insert_UpdateMemberStatus ".$PartnerID.", '".$MemberCardID."', '', '".$Status."', '', '".$SCVFilename."', '".$Ip."'";
        $this->db->query($qryProc);

        $qry ="
		Select Top 1 TransNo from T_Partnership_UpdateMemberStatus where MemberCardID='".$MemberCardID."' Order By Oid Desc
	";
        $res = $this->db->query($qry);

        if ($res->num_rows() > 0)
            return $res->result();
        else
            return array();
    }

    #3 API Member Campaign
    function Campaign($PartnerID){
        $qryProc="EXEC SP_Partnership_GetCampaign ".$PartnerID."";
        $this->db->query($qryProc);

        $qry ="
		 SELECT A.MemberCardID,B.MappingCampaign,dbo.getdateonly(B.StartingDate)StartingDate,dbo.getdateonly(B.EndingDate)EndingDate FROM T_Campaign_Voucher A
		 JOIN T_PartnershipCampaign B ON B.OID=A.CampaignID                
 		 WHERE A.PartnerID=".$PartnerID." and A.VoucherCode is null and A.redeem=9 
	";
        $res = $this->db->query($qry);

        $qryDone="Update T_Campaign_Voucher set Redeem=null where redeem=9";
        $this->db->query($qryDone);

        if ($res->num_rows() > 0)
            return $res->result();
        else
            return array();
    }
    function GetSKU($PartnerID, $CampaignCode){
        $qry ="EXEC SP_Partnership_GetSKU ".$PartnerID.", '".$CampaignCode."'";
        $res = $this->db->query($qry);

        if ($res->num_rows() > 0)
            return $res->result();
        else
            return array();
    }



    #4 API Update Campaign
    function UpdateCampaign($PartnerID, $FileName, $MemberCardID, $VoucherID, $CampaignCode){
        $qryProc="EXEC SP_Partnership_InsertConvirmationVoucher_v2 ".$PartnerID.", '".$FileName."', '".$MemberCardID."', '".$VoucherID."', '".$CampaignCode."'";
        $this->db->query($qryProc);

        $qry ="
		SELECT Top 1 TransNo FROM T_Partnership_ConfirmationVoucher where MemberID='".$MemberCardID."' and PartnerID=".$PartnerID." And CampaignID='".$CampaignCode."' Order By Oid Desc";
        $res = $this->db->query($qry);

        if ($res->num_rows() > 0)
            return $res->result();
        else
            return array();
    }


}