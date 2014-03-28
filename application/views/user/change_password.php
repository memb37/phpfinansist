<form class="form-horizontal" method="POST">
    <fieldset>

        <!-- Password input-->
        <div class="form-group">
            <label class="col-md-4 control-label" for="password">Пароль</label>
            <div class="col-md-4">
                <input id="password" name="password" type="password" placeholder="password" class="form-control input-md">

            </div>
        </div>

        <!-- Password input-->
        <div class="form-group">
            <label class="col-md-4 control-label" for="re_password">Повторите пароль</label>
            <div class="col-md-4">
                <input id="re_password" name="re_password" type="password" placeholder="password" class="form-control input-md">

            </div>
        </div>

        <!-- Button -->
        <div class="form-group">
            <label class="col-md-4 control-label" for="change_password"></label>
            <div class="col-md-4">
                <button id="change_password" name="change_password" class="btn btn-primary">Сменить пароль</button>
            </div>
        </div>

    </fieldset>


<? if (!empty($data)) : ?>
    <? foreach($data as $msg) : ?>
    <p><?= $msg ?>
        <? endforeach; ?>
        <? endif; ?>
</form>
