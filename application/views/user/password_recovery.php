<form class="form-horizontal" method="POST">
    <fieldset>

        <!-- Form Name -->
        <legend>Восстановление пароля</legend>

        <!-- Email input-->
        <div class="form-group">
            <label class="col-md-4 control-label" for="email">Email</label>

            <div class="col-md-4">
                <input id="email" name="email" type="text" placeholder="email" class="form-control input-md"
                    >

            </div>
        </div>

        <!-- Captcha -->
        <div class="form-group">
            <div class="col-md-4 col-md-offset-4">
                <img src="/captcha">
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
            <label class="col-md-4 control-label" for="recoverypass"></label>

            <div class="col-md-4">
                <button id="recoverypass" name="recoverypass" class="btn btn-primary">Восстановить</button>
            </div>
        </div>
        <? if (!empty($data)) : ?>
        <? foreach($data as $msg) : ?>
        <p><?= $msg ?>
            <? endforeach; ?>
            <? endif; ?>
    </fieldset>
</form>