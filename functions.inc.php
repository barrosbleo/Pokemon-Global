<?php

    // Returns user stats
    function getUserStats($userID){        
    	$userStats = array();        
    	$expQuery = "SELECT SUM(`exp`) AS `total_exp` FROM `user_pokemon` WHERE `uid`='{$userID}'";        $getUsers = "SELECT * FROM users WHERE id='{$userID}'";		$userStats['total_exp'] = $expQuery ? end(fetchAssoc($expQuery, $conn)) : 0;		
        $result = $conn->query($getUsers);
		while($userInfo = $result->fetch_assoc()){            
	        $userStats['username'] = $userInfo['username'];            
	        $userStats['money'] = $userInfo['money'] + $userInfo['bank'];            
	        $userStats['battles_won'] = $userInfo['won'];            
	        $userStats['battles_lost'] = $userInfo['lost'];        
        }        
        return $userStats;    
    }

	// Join Clan
    function joinClan($userID, $clanID){
        $query = "SELECT * FROM clan_members WHERE members_id='{$userID}'";
        $numRows = numRows($query, $conn);
        
        if($numRows == 0){
            $query = "SELECT * FROM clans WHERE id='{$clanID}'";
            $claninfo = fetchAssoc($query, $conn);
            $userStats = getUserStats($userID);
            $totalExp  = $userStats['total_exp'];
            $totalMoney  = $userStats['money'];
            $userName  = $userStats['username'];
            $clanName = $claninfo['clan_name'];
            
            
            $query = $conn->query("INSERT INTO clan_members SET clan_id='{$clanID}', members_id='{$userID}', clan_name='{$clanName}', members_name='{$userName}', members_money='{$totalMoney}', members_exp='{$totalExp}', clan_access='0'");
            
            if($query){
                $query = "SELECT * FROM clans WHERE id='{$clanID}'";
                $queryData = fetchAssoc($query, $conn);
                $totalMoney += $queryData['total_money'];
                $totalExp += $queryData['total_exp'];
                $totalMembers = $queryData['total_members'] + 1;
                
                $query = $conn->query("UPDATE clans SET total_money='{$totalMoney}', total_exp='{$totalExp}', total_members='{$totalMembers}' WHERE id='{$clanID}'");
                
                if($query){
                    echo "<center><b>".$lang['func_inc_00']." ".$clanName."! <a href='./clanpage.php?cid=".$clanID."'>".$lang['func_inc_01']."</a></b></center>";
                
                }
                
            }
            
        } else echo $lang['func_inc_02'];
    
    }

    // Returns total exp and total money for clan
    function clanTotals($clanID){		

    	$moneyQuery = "SELECT SUM(`members_money`) AS `total_money` FROM `clan_members` WHERE `clan_id`='{$clanID}'";        
    	$expQuery = "SELECT SUM(`members_exp`) AS `total_exp` FROM `clan_members` WHERE `clan_id`='{$clanID}'";        
    	$totalarray = fetchAssoc($moneyQuery, $conn);        
    	$totalMoney = $totalarray['total_money'];        
    	$totalarray = fetchAssoc($expQuery, $conn);        
    	$totalexp = $totalarray['total_exp'];
        return array($totalexp, $totalMoney);    
    }



    function validateCreation($formData){        
    	$clanName = $conn->real_escape_string($formData['clan_name']);        
    	$clanPass = $conn->real_escape_string($formData['clan_password']);        
    	$confirmPass = $conn->real_escape_string($formData['confirm_clan_password']);
    	
    	$requiredMoney = 100000;        
    	$userID = (int) $formData['user_id'];
    	$query = "SELECT * FROM clan_admin WHERE admin_uid='{$userID}'";
    	$rows = numRows($query, $conn);
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
		            
			            $query = $conn->query("INSERT INTO clans SET clan_name='{$clanName}', leader_id='{$userID}', clan_leader='{$userName}', total_money='{$totalMoney}', total_exp='{$totalExp}',  total_members='1'");                
			            if($query){					
			            	$success[] = true;                    
			            	
			            	$query = "SELECT * FROM clans WHERE clan_name='{$clanName}'";                    
			            	$clans = fetchAssoc($query, $conn);                    
			            	$clanID = $clans['id'];
			                $clanNameAdmin = strtolower($clanName);
			            	$query = $conn->query("INSERT INTO clan_admin SET clan_id='{$clanID}', clan_name='{$clanNameAdmin}', clan_password='{$hashedPass}', admin_uid='{$userID}'");
			            
			            	if($query){						
			           		$success[] = true;                        
			           	 	$query = $conn->query("INSERT INTO clan_members SET clan_id='{$clanID}', members_id='{$userID}', clan_name='{$clanName}', members_name='{$userName}', members_money='{$totalMoney}', members_exp='{$totalExp}', clan_access='2'");						
			                  
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


            $query = ($enablePagination) ? "SELECT * FROM `clans` LIMIT $start, $clansPerPage" : "SELECT * FROM `clans`";

            
            if($query){
                echo '<link rel="stylesheet" href="./css/clans.css" type="text/css">';
                echo '<br /><br /><br /><center><table width="98%" cellpadding="0" cellspacing="0" class="t">';
                echo '<tr><th>'.$lang['func_inc_09'].'</th><th>'.$lang['func_inc_10'].'</th><th>'.$lang['func_inc_11'].'</th><th>'.$lang['func_inc_12'].'</th><th>'.$lang['func_inc_13'].'</th><th>'.$lang['func_inc_14'].'</th></tr>';
                $result = $conn->query($query);
				while($clan = $result->fetch_assoc()){
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
            $query = ($enablePagination) ? "SELECT * FROM `clans_members` LIMIT $start, $clansPerPage" : "SELECT * FROM `clan_members` WHERE clan_id='{$clanID}'";

            if(numRows($query, $conn)){
                echo '<link rel="stylesheet" href="./css/clans.css" type="text/css">';
                echo '<br /><br /><br /><center><table width="98%" cellpadding="0" cellspacing="0" class="t">';
                echo '<tr><th>'.$lang['func_inc_17'].'</th><th>'.$lang['func_inc_18'].'</th><th>'.$lang['func_inc_19'].'</th><th>'.$lang['func_inc_20'].'</th></tr>';
                $result = $conn->query($query);
				while($clan = $result->fetch_assoc()){
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
//remake this function
    //function tablePagination($query){
		//$clansPerPage = 20;
		//$pagesQuery = $conn->query($query);
		//$totalPages = ceil(mysql_result($pagesQuery, 0) / $clansPerPage);
		//$page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;
		//$start = ($page - 1) * $clansPerPage;
		//return array($start, $page, $totalPages, $clansPerPage);
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
		$getAdminID = "SELECT * FROM clan_admin WHERE clan_id='$clanID'";		
		$adminArray = fetchAssoc($getAdminID, $conn);		
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
        $queryStr = $queryStr;
        $numRows = numRows($queryStr, $conn);
        return array($queryStr, $numRows);
    }
    
    function removeClanMember($myID, $removeID, $clanID){
        $query = "SELECT * FROM clan_members WHERE clan_id='{$clanID}'";
        $a = fetchAssoc($query, $conn);

        $id = $a['id'];
        
        
        $conn->query("DELETE FROM clan_members WHERE id='{$id}'") or die("Error functions.inc L315");

    	   	
    	

    }
    
    


?>