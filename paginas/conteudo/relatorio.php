  <!-- Content Wrapper. Contains page content -->
  <?php
 if (isset($_SESSION['user'] ) && (($_SESSION['access']) == '1') && (isset($_SESSION['grupo'])))
 /* Quebrando a string em Array e seletando qual array preciso acessar */
      $str = str_replace(' ','',$_SESSION["grupo"]);
      $attr = explode(',', $str);
      /* print_r($attr); */
      // Verificando se o usuário tem acesso ao menu de cadastro de usuários e Dados de Usúarios
      if(in_array('TI',$attr) || in_array('GerenciaDev',$attr)){    
?>

  <div class="content-wrapper">
    <section class="content">
      <div class="container-fluid">

        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Lista de contatos</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <!-- Fazer relatorio https://melonfire.com/archives/trog/article/using-php-with-ldap-part-1 -->
            <table id="example1" class="table table-bordered table-hover">
              <thead>
                <tr class="text-center">
                  <th class="ul">Primeiro Nome</th>
                  <th class="ul">Ultimo Nome</th>
                  <th class="ul">Grupo</th>
                  <th class="ul">Ultimo acesso</th>
                  <th class="ul">Editar</th>
                  <!-- <th class="ul">Bloqueio</th> -->
                </tr>
              </thead>
              <?php
                     
                   include_once("dados-.php");

                    $conn = ldap_connect(LDAP_HOSTNAME) or die("Could not connect to server");

                    // bind to the LDAP server specified above
                    $bind = ldap_bind($conn,ldap_username,ldap_password) or die("Could not bind to server");
              
                    // set base DN and required attribute list
                    $base_dn = "dc=coplan, dc=local";
                    $filter = "(&(sn=*)(objectClass=user))";
                    $params = array("cn", "sn", "name","lastLogon","whenCreated","memberOf");
              
                    // list all entries from the base DN
                    $result = ldap_search($conn, $base_dn,$filter,$params);
              
              // get entries
              $info = ldap_get_entries($conn, $result);

              for ($i=0; $i<$info["count"]; $i++) {
                  echo "<tr>";
                  echo "<td>".$info[$i]["cn"][0]."</td>";
                  echo "<td>".$info[$i]["sn"][0]."</td>";
                  if(isset($info[$i]["memberof"][0])){
                    $grp = $info[$i]["memberof"][0];
                    $grp = str_replace("CN=", " ", $grp);                   
                    $grp = str_replace("OU=", " ", $grp);
                    $grp = str_replace("DC=", " ", $grp);
                   echo "<td>".$grp."</td>"; 
                   
                  }else{
                    echo "<td>Não possui grupo</td>";
                  }
                  if(isset($info[$i]["lastlogon"][0])){
                   
                    $lastlogon = $info[$i]['lastlogon'][0];
                  // divide by 10.000.000 to get seconds from 100-nanosecond intervals
                    $winInterval = round($lastlogon / 10000000);
                  // substract seconds from 1601-01-01 -> 1970-01-01
                      $unixTimestamp = ($winInterval - 11644473600);
                  // show date/time in local time zone
                  echo "<td>".date("Y-m-d H:i:s",$unixTimestamp) ."\n"."</td>";
                  echo "<td class='text-center'>"; 
                  ?>


              <ion-icon type="button" class="btn btn-success" name="create-outline" data-toggle="modal"
                data-target="#modalExemplo">
              </ion-icon></a>

              <!-- Modal -->
              <div class="modal fade" id="modalExemplo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Editar usuário</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <div class="container">
                        <div class="row">
                          <div class="form-group mb-2">
                            <a class="ul">Trocar Senha</a>
                            <div class="col-sm-10"></div>
                            <input type="text" class="input">
                          </div>
                          <div class="form-group mb-2">
                            <a class="ul">Confirmar Senha</a>
                            <div class="col-sm-10">
                              <input type="text" class="input">
                            </div>
                          </div>
                          <div class="form-group mb-2">
                            <a class="ul">Bloquear Conta</a>
                            <div class="col-sm-10">
                              <input type="checkbox" checked data-toggle="toggle" data-style="ios" data-on="Ativo"
                                data-off="Negativo" data-width="110">
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                      <button type="button" class="btn btn-primary">Salvar mudanças</button>
                    </div>
                  </div>
                </div>
              </div>
              <?php 
                    echo "</td>";
                    echo "</tr>";
                    
                  }else{
                    echo "<td>Não possui registro do último acesso</td>";
                    echo "<td class='text-center'>";
                    ?>
              <ion-icon type="button" class="btn btn-success" name="create-outline" data-toggle="modal"
                data-target="#modalExemplo">
              </ion-icon></a>

              <!-- Modal -->
              <div class="modal fade" id="modalExemplo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Editar usuário</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <div class="container">
                        <div class="row">
                          <div class="form-group mb-2">
                            <a class="ul">Trocar Senha</a>
                            <div class="col-sm-10"></div>
                            <input type="text" class="input">
                          </div>
                          <div class="form-group mb-2">
                            <a class="ul">Confirmar Senha</a>
                            <div class="col-sm-10">
                              <input type="text" class="input">
                            </div>
                          </div>
                          <div class="form-group mb-2">
                            <a class="ul">Bloquear Conta</a>
                            <div class="col-sm-10">
                              <input type="checkbox" checked data-toggle="toggle" data-style="ios" data-on="Ativo"
                                data-off="Negativo" data-width="110">
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                      <button type="button" class="btn btn-primary">Salvar mudanças</button>
                    </div>
                  </div>
                </div>
              </div>
              <?php
                     echo "</td>";
                    
              echo "</tr>";
              }
              }
              // all done? clean up
              ldap_close($conn);
              ?>
            </table>
          </div>
        </div>
      </div>
    </section>
  </div>
  <?php
}else {
  header("Location: home.php?acao=report_tel"); 
}

  ?>
  <style>
.toggle.ios,
.toggle-on.ios,
.toggle-off.ios {
  border-radius: 12rem;
}

.toggle.ios .toggle-handle {
  border-radius: 13rem;

}
  </style>

  </div>
  </div>