<?php include __THEME__ . '/header.php'; ?>
<?php include __THEME__ . '/user/header.php'; ?>
<div class="n-user-comment-list">
    <div class="n-user-msg">
        <p id="n-user-msg">资料修改成功!</p>
    </div>
    <div class="n-user-edit">
        <input type="hidden" id="id" name="id" value="<?= $userData['base']['id']; ?>">
        <div class="form-control">
            <div class="input">
                <label for="nickname">昵称：</label>
                <input type="text" name="nickname" id="n-user-edit-nickname"
                       value="<?= $userData['base']['nickname']; ?>">
            </div>
        </div>
        <div class="form-control">
            <div class="input">
                <label for="email">邮箱地址：</label>
                <input type="text" name="email" id="n-user-edit-email" value="<?= $userData['base']['email']; ?>" placeholder="用于接收评论回复内容提醒，建议填写，承诺不会被公开！">
            </div>
        </div>
        <div class="form-control">
            <div class="input">
                <label for="email">博客地址：</label>
                <input type="text" name="email" id="n-user-edit-url" value="<?= $userData['base']['url']; ?>">
            </div>
        </div>
        <div class="form-control">
            <div class="input">
                <label for="description">个性签名：</label>
                <input type="text" placeholder="世事如书，我偏爱你这一句。" id="n-user-edit-description" name="description"
                       value="<?= $userData['base']['description']; ?>">
            </div>
        </div>
        <div class="edit-btn">
            <div class="edit-submit">
                提交修改
            </div>
        </div>
    </div>
</div>
<?php include __THEME__ . '/footer.php'; ?>
