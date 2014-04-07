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
                <input id="email" name="email" type="text" value=<?=$email?> class="form-control input-md">

            </div>
        </div>

        <!-- Textarea -->
        <div class="form-group">
            <label class="col-md-4 control-label" for="text">Текст сообщения:</label>
            <div class="col-md-4">
                <textarea class="form-control" id="text" name="text"></textarea>
            </div>
        </div>

        <!-- Button -->
        <div class="form-group">
            <label class="col-md-4 control-label" for="send"></label>
            <div class="col-md-4">
                <button id="send" name="send" class="btn btn-primary">Отправить</button>
            </div>
        </div>
        <? if(isset($message)) : ?>
        <p><?=$message?>
            <? endif; ?>
    </fieldset>
</form>
