<form class="form-horizontal" method="POST">
    <fieldset>

        <!-- Form Name -->
        <legend>Регистрация</legend>

        <!-- Email input-->
        <div class="form-group">
            <label class="col-md-4 control-label" for="email">Email</label>

            <div class="col-md-4">
                <input id="email" name="email" type="text" placeholder="email" class="form-control input-md"
                       >

            </div>
        </div>

        <!-- Password input-->
        <div class="form-group">
            <label class="col-md-4 control-label" for="password">Пароль</label>

            <div class="col-md-4">
                <input id="password" name="password" type="password" placeholder="пароль" class="form-control input-md"
                       >

            </div>
        </div>

        <!-- Password input-->
        <div class="form-group">
            <label class="col-md-4 control-label" for="re_password">Повторите пароль</label>
            <div class="col-md-4">
                <input id="re_password" name="re_password" type="password" placeholder="пароль" class="form-control input-md">

            </div>
        </div>

        <!-- Text input-->
        <div class="form-group">
            <label class="col-md-4 control-label" for="name">Имя</label>

            <div class="col-md-4">
                <input id="name" name="name" type="text" placeholder="имя" class="form-control input-md" >

            </div>
        </div>

        <!-- Captcha -->
        <div class="form-group">
            <div class="col-md-4 col-md-offset-4">
                <img src="/additions/captcha">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-4 control-label" for="captcha">Введите символы:</label>

            <div class="col-md-4">
                <input id="captcha" name="captcha" type="text" class="form-control input-md" >

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
<? if (!empty($data)) : ?>
    <? foreach($data as $msg) : ?>
        <p><?= $msg ?>
    <? endforeach; ?>
<? endif; ?>
