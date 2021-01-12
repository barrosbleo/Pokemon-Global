<?php

    // Returns user stats
    function getUserStats($userID){        
    	$userStats = array();        
    	$expQuery = mysql_query("SELECT SUM(`exp`) AS `total_exp` FROM `user_pokemon` WHERE `uid`='{$userID}'");        $getUsers = mysql_query("SELECT * FROM users WHERE id='{$userID}'");		$userStats['total_exp'] = $expQuery ? end(mysql_fetch_assoc($expQuery)) : 0;		
        while($userInfo = mysql_fetch_assoc($getUsers)){            
	        $userStats['username'] = $userInfo['username'];            
	        $userStats['money'] = $userInfo['money'] + $userInfo['bank'];            
	        $userStats['battles_won'] = $userInfo['won'];            
	        $userStats['battles_lost'] = $userInfo['lost'];        
        }        
        return $userStats;    
    }

	// Join Clan
    function joinClan($userID, $clanID){
        $query = mysql_query("SELECT * FROM clan_members WHERE members_id='{$userID}'");
        $numRows = mysql_num_rows($query);
        
        if($numRows == 0){
            $query = mysql_query("SELECT * FROM clans WHERE id='{$clanID}'");
            $claninfo = mysql_fetch_assoc($query);
            $userStats = getUserStats($userID);
            $totalExp  = $userStats['total_exp'];
            $totalMoney  = $userStats['money'];
            $userName  = $userStats['username'];
            $clanName = $claninfo['clan_name'];
            
            
            $query = mysql_query("INSERT INTO clan_members SET clan_id='{$clanID}', members_id='{$userID}', clan_name='{$clanName}', members_name='{$userName}', members_money='{$totalMoney}', members_exp='{$totalExp}', clan_access='0'");
            
            if($query){
                $query = mysql_query("SELECT * FROM clans WHERE id='{$clanID}'");
                $queryData = mysql_fetch_assoc($query);
                $totalMoney += $queryData['total_money'];
                $totalExp += $queryData['total_exp'];
                $totalMembers = $queryData['total_members'] + 1;
                
                $query = mysql_query("UPDATE clans SET total_money='{$totalMoney}', total_exp='{$totalExp}', total_members='{$totalMembers}' WHERE id='{$clanID}'");
                
                if($query){
                    echo "<center><b>".$lang['func_inc_00']." ".$clanName."! <a href='./clanpage.php?cid=".$clanID."'>".$lang['func_inc_01']."</a></b></center>";
                
                }
                
            }
            
        } else echo $lang['func_inc_02'];
    
    }

    // Returns total exp and total money for clan
    function clanTotals($clanID){		

    	$moneyQuery = mysql_query("SELECT SUM(`members_money`) AS `total_money` FROM `clan_members` WHERE `clan_id`='{$clanID}'");        
    	$expQuery = mysql_query("SELECT SUM(`members_exp`) AS `total_exp` FROM `clan_members` WHERE `clan_id`='{$clanID}'");        
    	$totalarray = mysql_fetch_assoc($moneyQuery);        
    	$totalMoney = $totalarray['total_money'];        
    	$totalarray = mysql_fetch_assoc($expQuery);        
    	$totalexp = $totalarray['total_exp'];
        return array($totalexp, $totalMoney);    
    }



    function validateCreation($formData){        
    	$clanName = mysql_real_escape_string($formData['clan_name']);        
    	$clanPass = mysql_real_escape_string($formData['clan_password']);        
    	$confirmPass = mysql_real_escape_string($formData['confirm_clan_password']);
    	
    	$requiredMoney = 100000;        
    	$userID = (int) $formData['user_id'];
    	$query = mysql_query("SELECT * FROM clan_admin WHERE admin_uid='{$userID}'");
    	$rows = mysql_num_rows($query);
    	if(!$rows){
    	
	        if(!empty($clanName)&&!empty($clanPass)&&!empty($confirmPass)){
	
	            if($clanPass === $confirmPass){                
		            $hashedPass = md5($clanPass);                
		            $userStats = getUserStats($userID);                
		            $totalExp = $userStats['total_exp'];                
		            $userName = $userStats['username'];                
		            $totalMoney = $userStats['money'];                
		            $battlesWon = $userStats['battles_won'];                
		            $battlesLost = $userStats['battles_lost'];				
		            $success = array();
		            if($totalMoney < $requiredMoney){
		            
			            $query = mysql_query("INSERT INTO clans SET clan_name='{$clanName}', leader_id='{$userID}', clan_leader='{$userName}', total_money='{$totalMoney}', total_exp='{$totalExp}',  total_members='1'");                
			            if($query){					
			            	$success[] = true;                    
			            	
			            	$query = mysql_query("SELECT * FROM clans WHERE clan_name='{$clanName}'");                    
			            	$clans = mysql_fetch_assoc($query);                    
			            	$clanID = $clans['id'];
			                $clanNameAdmin = strtolower($clanName);
			            	$query = mysql_query("INSERT INTO clan_admin SET clan_id='{$clanID}', clan_name='{$clanNameAdmin}', clan_password='{$hashedPass}', admin_uid='{$userID}'");
			            
			            	if($query){						
			           		$success[] = true;                        
			           	 	$query = mysql_query("INSERT INTO clan_members SET clan_id='{$clanID}', members_id='{$userID}', clan_name='{$clanName}', members_name='{$userName}', members_money='{$totalMoney}', members_exp='{$totalExp}', clan_access='2'");						
			                  
				        	if($query){	
				        		echo $lang['func_inc_03'];						
				       	 		return true;
				                        
				         	} else $success[] = false;
				
			       		} else $success[] = false;
			
			            } else $success[] = false;
			     } else echo $lang['func_inc_04']." $".number_format($requiredMoney)." ".$lang['func_inc_05'];
	
	        	} else echo $lang['func_inc_06'];
	
	    	} else echo $lang['func_inc_07'];
	    	
	    } else echo $lang['func_inc_08'];		
	
    }
    function generateClansTable($userID, $clanID, $tableName, $enablePagination){
    	if($enablePagination){
	        $pagination = tablePagination("SELECT COUNT('id') FROM ".$tableName);
	        $start = $pagination[0];
	        $clansPerPage = $pagination[3];
	}

        if($tableName == "clans"){


            $query = ($enablePagination) ? mysql_query("SELECT * FROM `clans` LIMIT $start, $clansPerPage") : mysql_query("SELECT * FROM `clans`");

            
            if($query){
                echo '<link rel="stylesheet" href="./css/clans.css" type="text/css">';
                echo '<br /><br /><br /><center><table width="98%" cellpadding="0" cellspacing="0" class="t">';
                echo '<tr><th>'.$lang['func_inc_09'].'</th><th>'.$lang['func_inc_10'].'</th><th>'.$lang['func_inc_11'].'</th><th>'.$lang['func_inc_12'].'</th><th>'.$lang['func_inc_13'].'</th><th>'.$lang['func_inc_14'].'</th></tr>';
                while($clan = mysql_fetch_assoc($query)){
                    echo '<tr>';

                    foreach($clan as $key => $clanInfo){

                        switch($key){
                            case "id":
                                //$clanStats = clanTotals($clanID);
                                $clanID   = $clanInfo;
                                //$clanStats = clanTotals($clanID);
                                $joinClan = "http://www.pkmnplanet.net/rpg/joinclan.php?cid=".$clanInfo;
                                $viewClan = "http://www.pkmnplanet.net/rpg/clanpage.php?cid=".$clanInfo;
                                break;

                            case "clan_name":
                                echo '<td><center>'.$clanInfo.'</center></td>';
                                break;

                            case "clan_leader":
                                echo '<td><center>'.$clanInfo.'</center></td>';
                                break;

                            case "total_money":
                                echo '<td><center>'.$clanInfo.'</center></td>';
                                break;

                            case "total_exp":
                                echo '<td><center>'.$clanInfo.'</center></td>';
                                break;

                            case "total_members":
                                echo '<td><center>'.$clanInfo.'</center></td>';
                                break;

                            case "joinable";
                                echo '<td><br /><center><form method="post" action='.$joinClan.' style="display:inline; padding:5px"><input type="hidden" name="cid" value="'.$clanID.'"/><input type="submit" name="submit" value=" '.$lang['func_inc_15'].' "/></form>  ';
                                echo '<form method="get" action='.$viewClan.' style="display:inline; padding:5px"><input type="hidden" name="cid" value="'.$clanID.'"/><input type="submit" value=" '.$lang['func_inc_16'].' "/></form></center><br /></td>';
                                break;

                        }
                    }
                    echo '</tr>';
                }
                echo '</table>';
                if($enablePagination){
                    getPages($pagination[1], $pagination[2]);
               	}
            }
            echo '</center><br />';
        } elseif($tableName == "clan_members"){
            $query = ($enablePagination) ? mysql_query("SELECT * FROM `clans_members` LIMIT $start, $clansPerPage") : mysql_query("SELECT * FROM `clan_members` WHERE clan_id='{$clanID}'");

            if(mysql_num_rows($query)){
                echo '<link rel="stylesheet" href="./css/clans.css" type="text/css">';
                echo '<br /><br /><br /><center><table width="98%" cellpadding="0" cellspacing="0" class="t">';
                echo '<tr><th>'.$lang['func_inc_17'].'</th><th>'.$lang['func_inc_18'].'</th><th>'.$lang['func_inc_19'].'</th><th>'.$lang['func_inc_20'].'</th></tr>';
                while($clan = mysql_fetch_assoc($query)){
                    echo '<tr>';

                    foreach($clan as $key => $clanInfo){

                        switch($key){
                            case "clan_id":
                                //$clanStats = clanTotals($clanID);
                                $clanID   = $clanInfo;
                                $admin = isAdmin($userID, $clanID);
                                $adminID = $admin[0];
                                
                                
                                $joinClan = "http://www.pkmnplanet.net/rpg/joinclan.php?cid=".$clanInfo;
                                $viewClan = "http://www.pkmnplanet.net/rpg/clanpage.php?cid=".$clanInfo;
                                break;

                            case "members_id":
                                $membersID = $clanInfo;
                                $viewUser = "http://www.pkmnplanet.net/rpg/profile.php?id=".$membersID;
                                $battleUser = "http://www.pkmnplanet.net/rpg/battle_user.php?id=".$membersID;
                                $removeUser = "http://www.pkmnplanet.net/rpg/removeuser.php?id=".$membersID;
                                //$removeUser = "./removeuser.php?id=".$membersID;
                                break;
                            case "members_name":
                                echo '<td><center>'.$clanInfo.'</center></td>';
                                break;

                            case "members_money":
                                echo '<td><center>'.$clanInfo.'</center></td>';
                                break;

                            case "members_exp":
                                echo '<td><center>'.$clanInfo.'</center></td>';
                                break;

                            case "options";
				if($admin[1]){
					echo '<td><br /><center><form method="post" action="'.$viewUser.'" style="display:inline; padding:5px"><input type="hidden" name="id" value="'.$membersID.'"/><input type="submit" name="submit" value=" '.$lang['func_inc_21'].' "/></form>  ';

					echo '<form method="post" action="'.$removeUser.'" style="display:inline; padding:5px"><input type="hidden" name="id" value="'.$membersID.'"/><input type="hidden" name="adminID" value="'.$adminID.'"/><input type="hidden" name="clanID" value="'.$clanID.'"/><input type="submit" value=" '.$lang['func_inc_22'].' "/></form></center><br /></td>';

					break;
				} else {
					echo '<td><br /><center><form method="post" action='.$joinClan.' style="display:inline; padding:5px"><input type="hidden" name="cid" value="'.$clanID.'"/><input type="submit" value=" '.$lang['func_inc_23'].' "/></form>  ';
					echo '<form method="get" action="'.$viewClan.'" style="display:inline; padding:5px"><input type="submit" value=" '.$lang['func_inc_24'].' "/></form></center><br /></td>';
					break;									
				}

                            default:
                                break;

                        }
                    }
                    echo '</tr>';
                }
                echo '</table>';
                if($enablePagination){
                    getPages($pagination[1], $pagination[2]);
               	}

            }
            echo '</center><br />';
        }
    }

    function tablePagination($query){
        $clansPerPage = 20;
        $pagesQuery = mysql_query($query);
        $totalPages = ceil(mysql_result($pagesQuery, 0) / $clansPerPage);
        $page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;
        $start = ($page - 1) * $clansPerPage;
        return array($start, $page, $totalPages, $clansPerPage);
    }

    function getPages($page, $totalPages){
        echo '<h2 style="display:inline; font-size:150%;">'.$lang['func_inc_25'].'</h2><br />';
        echo ($page!=1) ? '<h2 style="display:inline; font-size:150%;"><a href="?page='.($page-1).'">< </a></h2>' : '';

        if($totalPages >= 1){
            for($x=1; $x<=$totalPages; $x++){
                echo ($x == $page) ? '<strong><a href="?page='.$x.'"><h2 style="display:inline; font-size:200%;"> '.$x.' </h2></a></strong>' : '<a href="?page='.$x.'"><h2 style="display:inline; font-size:150%;"> '.$x.' </h2></a>';
            }
        }
        echo ($page != $totalPages) ? '<a href="?page='.($page+1).'"> ></a></h2>' : '';
    }
	function isAdmin($userID, $clanID = false){					
		$getAdminID = mysql_query("SELECT * FROM clan_admin WHERE clan_id='$clanID'");		
		$adminArray = mysql_fetch_assoc($getAdminID);		
		$adminID = $adminArray['admin_uid'];
		$success = ($userID == $adminID) ? true : false;
		return array($adminID, $success);
	}

    function isSuccess($success){	
	$errors = 0;
	for($t=0;$t!=count($success);$t++){
		if(!$success[$t]){
			$errors++;	
		}
	}
	
	$isSuccess = ($errors == 0) ? true : false;
	return $isSuccess;	
    }
    
    function runQuery($queryStr){
        $queryStr = mysql_query($queryStr);
        $numRows = mysql_num_rows($queryStr);
        return array($queryStr, $numRows);
    }
    
    function removeClanMember($myID, $removeID, $clanID){
        $query = mysql_query("SELECT * FROM clan_members WHERE clan_id='{$clanID}'");
        $a = mysql_fetch_assoc($query);

        $id = $a['id'];
        
        
        mysql_query("DELETE FROM clan_members WHERE id='{$id}'") or die(mysql_error());

    	   	
    	

    }
    
    


?>