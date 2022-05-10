<?php
require_once("config.controller.php");
function mailboxpowerloginrd($user,$pass){
	 $ldaprdn = trim($user).'@'.DOMINIO;
     $ldappass = trim($pass);
     $ds = DOMINIO;
     $dn = DN;
     $puertoldap = 389;
     $ldapconn = ldap_connect($ds,$puertoldap);
       ldap_set_option($ldapconn, LDAP_OPT_PROTOCOL_VERSION,3);
       ldap_set_option($ldapconn, LDAP_OPT_REFERRALS,0);
       $ldapbind = @ldap_bind($ldapconn, $ldaprdn, $ldappass);
       if ($ldapbind){
		 	 	 $filter="(|(SAMAccountName=".trim($user)."))";
         $fields = array("SAMAccountName");
         $sr = @ldap_search($ldapconn, $dn, $filter);
         $info = @ldap_get_entries($ldapconn, $sr);
				 $rol = $info[0]["title"][0];
		     $array = $info[0]["samaccountname"][0];
				 $icnum = $info[0]["employeeid"][0];
         
	   }else{
         	$array=0;
       }
     ldap_close($ldapconn);
		 $resultado = array('usuario' => $array, 'rol' => $rol, 'icnum' => $icnum);
		 // return $array;
		 return $resultado;


} 
?>
