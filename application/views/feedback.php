<form class="form-horizontal" method="POST">
    <fieldset>

        <!-- Form Name -->
        <legend>Обратная связь</legend>

        <!-- Text input-->
        <div class="form-group">
            <label class="col-md-4 control-label" for="subject">Тема сообщения:</label>
            <div class="col-md-4">
                <input id="subject" name="subject" type="text" placeholder="" class="form-control input-md">

            </div>
        </div>

        <!-- Text input-->
        <div class="form-group">
            <label class="col-md-4 control-label" for="email">Ваш email:</label>
            <div class="col-md-4">
                <input id="email" name="email" type="text"
                       <? if(isset($_SESSION['user'])): ?>
                            value="<?=$_SESSION['user']['email']?>"
                       <? endif; ?>
                class="form-control input-md">

            </div>
        </div>

        <!-- Textarea -->
        <div class="form-group">
            <label class="col-md-4 control-label" for="text">Текст сообщения:</label>
            <div class="col-md-4">
                <textarea class="form-control" id="text" name="text"></textarea>
            </div>
        </div>

        <!-- Captcha -->
        <? if(!isset($_SESSION['user'])): ?>
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
        <? endif;?>

        <!-- Button -->
        <div class="form-group">
            <label class="col-md-4 control-label" for="send"></label>
            <div class="col-md-4">
                <button id="send" name="send" class="btn btn-primary">Отправить</button>
            </div>
        </div>
        <? if (!empty($data)) : ?>
        <? foreach($data as $msg) : ?>
        <p><?= $msg ?>
            <? endforeach; ?>
            <? endif; ?>
    </fieldset>
</form>
