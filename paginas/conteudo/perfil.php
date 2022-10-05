<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Editar Senha</h1>
        </div>

      </div>
    </div><!-- /.container-fluid -->
  </section>
  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <!-- left column -->
        <div class="col-md-6">
          <!-- general form elements -->
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Editar Senha</h3>
            </div>
            <!-- /.card-header -->


            <!-- form start -->
            <form role="form" action="" method="post" enctype="multipart/form-data">
              <div class="card-body">
                <!-- <div class="form-group">
                  <label for="exampleInputEmail1">Nome</label>
                  <input type="text" class="form-control" name="loginUse" id="loginUse" required value="">
                </div> -->

                <!-- <div class="form-group">
                    <label for="exampleInputEmail1">Endereço de E-mail</label>
                    <input type="email" class="form-control" name="email" id="email" required
                      value="">
                  </div> -->
                <div class="form-group">
                  <label for="exampleInputPassword1">Senha</label>
                  <input type="password" class="form-control" name="senhaUse" id="senhaUse" required value="">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Senha Nova</label>
                  <input type="password" class="form-control" name="senha_nova" id="senhaUse" required value="">
                </div>


                <!-- 
                <div class="form-group">
                  <label for="exampleInputFile">Avatar do usuário</label> -->
                <!-- <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" name="foto" id="foto">
                        <label class="custom-file-label" for="exampleInputFile">Arquivo de imagem</label>
                      </div>

                    </div> -->
                <!--  </div> -->
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <!-- <button type="submit" name="upPerfil" class="btn btn-primary">Alterar dados do usuário</button> -->
              </div>
            </form>
          </div>
        </div>

        <div class="col-md-6">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Dados do Usuário</h3>
              <div class="card-body" style="text-align: center; margin-bottom: 98px;">
                <img src="../img/Puto.gif" style="width:120px; height:120px; border-radius:50%;"
                  class="img-circle elevation-2" alt="User Image">
                <!-- style="width: 200px; border-radius: 100%; margin-top: 30px"> -->
                <h1 style="margin-left: 120px;"><?= $_SESSION['user'] ?></h1>
                <h4 style=" margin-left: 120px; color:#6CC4A1;">Grupo</h4>
                <span style=" margin-left: 120px; color:#6CC4A1;"><?= $_SESSION['grupo']?></span>
              </div>


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
</section>
<!-- /.content -->
</div>