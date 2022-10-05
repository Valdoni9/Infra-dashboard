<?php
  if (!isset($_SESSION['user']) && (!$_SESSION['access']) == '1') {
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Cadastro de Contatos</h1>
        </div>

      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <!-- left column -->
        <div class="col-md-4">
          <!-- general form elements -->
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Cadastrar contato</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form role="form" action="" method="post" enctype="multipart/form-data">
              <div class="card-body">
                <div class="form-group">
                  <label for="name">Nome</label>
                  <input type="text" class="form-control" name="nome" id="nome"
                    title="O campo nome não pode conter números" onkeypress="return onlyName();" required
                    placeholder="primeiro nome.ultimo nome">
                </div>
                <script>
                function onlyName(nameSpace) {
                  var theEvent = nameSpace || window.event;
                  var nome = document.getElementById('nome');
                  var key = theEvent.keyCode || theEvent.which;
                  key = String.fromCharCode(key);
                  /* var regex = /^[0-9.,]+$/; */ //não permite números
                  var regex = /^[a-z\s]+$/; //permite apenas letras
                  if (!regex.test(key)) {
                    theEvent.returnValue = false;
                    if (theEvent.preventDefault) theEvent.preventDefault();
                  }
                }
                </script>
                <!-- <div class="form-group">
                  <label for="phone">Telefone</label>
                  <input type="tel" class="form-control" name="telefone" id="telefone" title="Não pode conter letra"
                    onkeypress="return onlynumber();" pattern="\([0-9]{2}\) [0-9]{4,6}-[0-9]{3,4}$" required
                    placeholder="(00) 00000-0000">
                </div> -->
                <script>
                //Evitar que o usuário digite letras no campo
                function onlynumber(evt) {
                  var theEvent = evt || window.event;
                  var key = theEvent.keyCode || theEvent.which;
                  key = String.fromCharCode(key);
                  //var regex = /^[0-9.,]+$/;
                  var regex = /^[0-9.]+$/;
                  if (!regex.test(key)) {
                    theEvent.returnValue = false;
                    if (theEvent.preventDefault) theEvent.preventDefault();
                  }
                }
                /* Script para mascara do telefone da pagina cadastro_contato.php */
                const tel = document.getElementById('telefone') // Seletor do campo de telefone

                tel.addEventListener('keypress', (e) => mascaraTelefone(e.target
                  .value)) // Dispara quando digitado no campo
                tel.addEventListener('change', (e) => mascaraTelefone(e.target
                  .value)) // Dispara quando autocompletado o campo

                const mascaraTelefone = (valor) => {
                  valor = valor.replace(/\D/g, "")
                  valor = valor.replace(/^(\d{2})(\d)/g, "($1) $2")
                  valor = valor.replace(/(\d)(\d{4})$/, "$1-$2")
                  tel.value = valor // Insere o(s) valor(es) no campo

                  if (valor.length == 15) {
                    tel.setAttribute('maxlength', '14')
                  } else {}
                }
                </script>
                <div class="form-group">
                  <label for="exampleInputEmail1">Endereço de E-mail</label>
                  <input type="email" class="form-control" name="email" id="email" required
                    placeholder="Digite um e-mail">
                </div>

                <div class="form-group">
                  <label for="exampleInputFile">Foto do contato</label>
                  <div class="input-group">
                    <div class="custom-file">
                      <input type="file" class="form-control" name="foto" id="foto" required />
                      <img />
                      <input type="button" class="hide" value="Adicionar outro" />
                      <!-- <label class="custom-file" for="exampleInputFile">Arquivo de imagem</label> -->
                    </div>
                  </div>
                  <style>
                  input[type=file] {
                    float: right;
                    display: block;
                  }

                  .hide {
                    display: none;
                    float: right;
                  }
                  </style>

                  <script>
                  function readURL(input) {
                    if (input.files && input.files[0]) {
                      var reader = new FileReader();
                      reader.onload = function(e) {
                        $(input).next()
                          .attr('src', e.target.result)
                      };
                      reader.readAsDataURL(input.files[0]);
                    } else {
                      var img = input.value;
                      $(input).next().attr('src', img);
                    }
                  }

                  function verificaMostraBotao() {
                    $('input[type=file]').each(function(index) {
                      if ($('input[type=file]').eq(index).val() != "") {
                        readURL(this);
                        $('.hide').show();
                      }
                    });
                  }

                  $('input[type=file]').on("change", function() {
                    verificaMostraBotao();
                  });

                  $('.hide').on("click", function() {
                    $(document.body).append($('<input/>', {
                      type: "file"
                    }).change(verificaMostraBotao));
                    $(document.body).append($('<img/>'));
                    $('.hide').hide();
                  });
                  </script>
                </div>
                <!-- <div class="form-check">
                  <input type="checkbox" class="form-check-input" id="exampleCheck1" required>
                  <label class="form-check-label" for="exampleCheck1">Autorizo o cadastro do meu contato</label>
                </div> -->
              </div>
              <!-- /.card-body -->

              <div class="card-footer">
                <button type="submit" name="botao" class="btn btn-primary">Cadastrar Contato</button>
              </div>
            </form>

          </div>
        </div>

        <div class="col-md-8">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Contatos Recentes</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <!-- <th style="width: 10px">#</th> -->
                    <th>Nome</th>
                    <!-- <th>Telefone</th> -->
                    <th>E-mail</th>
                    <th style="width: 40px">Setor</th>
                  </tr>
                </thead>
                <tbody>
                  <!-- <?php
                      /* $select = "SELECT * FROM tb_contatos ORDER BY id_contatos DESC LIMIT 6";
                      try{
                        $result = $conect->prepare($select);
                        $cont = 1;
                        $result->execute();

                        $contar = $result->rowCount();
                        if($contar > 0){
                          while($show = $result->FETCH(PDO::FETCH_OBJ)){ */

                    ?>
 -->
                  <tr>
                    <td><?php echo $cont++;?></td>
                    <td><?php echo $show->nome_contatos;?></td>
                    <td>
                      <?php echo $show->fone_contatos;?>
                    </td>
                    <td>
                      <?php echo $show->email_contatos;?>
                    </td>
                    <td>
                      <div class="btn-group">
                        <a href="home.php?acao=editar&id=<?php echo $show->id_contatos;?>" class="btn btn-success"
                          title="Editar Contato"><i class="fas fa-user-edit"></i></button>
                          <a href="conteudo/del-contato.php?idDel=<?php echo $show->id_contatos;?>"
                            onclick="return confirm('Deseja remover o contato')" class="btn btn-danger"
                            title="Remover Contato"><i class="fas fa-user-times"></i></a>
                      </div>
                    </td>
                  </tr>
                  <?php
/* 
                            }

                          }else{

                          }
                        }catch (PDOException $e){
                            echo '<strong>ERRO DE PDO= </strong>'.$e->getMessage();
                        } */
                    ?>

                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>

      </div>
      <!--/.col (right) -->
    </div>
    <!-- /.row -->
</div><!-- /.container-fluid -->

<?php
  }
?>
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->