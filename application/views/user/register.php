<form class="form-horizontal" method="POST">
<fieldset>

<!-- Form Name -->
<legend>Регистрация</legend>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="login">Логин</label>  
  <div class="col-md-4">
  <input id="login" name="login" type="text" placeholder="логин" class="form-control input-md" required="">
    
  </div>
</div>

<!-- Password input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="password">Пароль</label>
  <div class="col-md-4">
    <input id="password" name="password" type="password" placeholder="пароль" class="form-control input-md" required="">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="name">Имя</label>  
  <div class="col-md-4">
  <input id="name" name="name" type="text" placeholder="имя" class="form-control input-md" required="">
    
  </div>
</div>

<!-- Email input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="email">Email</label>  
  <div class="col-md-4">
  <input id="email" name="email" type="email" placeholder="email" class="form-control input-md" required="">
    
  </div>
</div>

<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label" for="submit_reg"></label>
  <div class="col-md-4">
    <button id="submit_reg" name="submit_reg" class="btn btn-primary">Зарегистрироваться</button>
  </div>
</div>

</fieldset>
</form>
<? if(!empty($data['message'])) : ?>
 	<p><?=$data['message']?>
<? endif; ?>
