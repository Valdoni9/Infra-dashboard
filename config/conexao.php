<?php
 //Conexão de banco para fazer validação dos testes
  /* try{

    @DEFINE('HOST','localhost');
    @DEFINE('BD','infra_dashboard');
    @DEFINE('USER','user');
    @DEFINE('PASS','pass');

    $conect = new PDO('pgsql:host='.HOST.';dbname='.BD,USER,PASS);
    $conect -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

}catch(PDOException $e){
    echo "<strong>ERRO DE PDO = </strong>".$e->getMessage();
} 
*/

function authenticate($user, $password){
	//Testa se deu erro de conexão ou usuario e senha em branco (tentativa de injection)
	if(empty($user) || empty($password)) return false;
  
  @define("ldap_host","00.000.000.000");
  @define("ldap_port","000");
  @define("ldap_dn","OU=organizacao,DC=nome,DC=local");
  @define("ldap_user_group","grupo");
  @define("ldap_usr_dom","local.host");
  @define("ldap_admin","user"."ldap_usr_dom");
  @define("ldap_password","password");

	$user = strtolower($user);
     	
	$ldap_conn = ldap_connect(ldap_host, ldap_port) or die("Could not connect to LDAP server.");
	
	ldap_set_option($ldap_conn,LDAP_OPT_PROTOCOL_VERSION,3);
	ldap_set_option($ldap_conn,LDAP_OPT_REFERRALS,0);
  
	// verify user and password
	 if($bind = @ldap_bind($ldap_conn, $user.'@'.ldap_usr_dom, $password)) {
		// valid user
		$filter = "(sAMAccountName=".$user.")"; 

		$attr = array('memberOf','sAMAccountName', 'memberOf', 'dn','lastLogon','whenCreated');
		$result = ldap_search($ldap_conn, ldap_dn, $filter, $attr) or exit("Unable to search LDAP server");
		$entries = ldap_get_entries($ldap_conn, $result);
	ldap_unbind($ldap_conn);
	
 	// check groups
	 $access = 0;
	 foreach($entries[0] as $grps) {
		
		// is user
		
	if(@strpos(@$grps, ldap_user_group)) $access = 1; 
		
 	/* if (strpos($grps, $ldap_user_group)) { $access = 2; break; } */
	/*retirar os sobrinhados do grupo*/
      $grps = str_replace("CN=", " ", $grps);
			$grps = str_replace("OU=", " ", $grps);
			$grps = str_replace("DC=", " ", $grps);
			$grps = str_replace ("Operacao=", " ", $grps);
	} 

 	if($access != 0) { 
		// establish session variables
		
		$_SESSION['user'] = $user;
		$_SESSION['access'] = $access;
		 /* $_SESSION['last_login'] = time();  */
	  $_SESSION['grupo'] = $grps;
	
	return true;
	} else {
		// user has no rights
		return false;
				} 
			}
		}