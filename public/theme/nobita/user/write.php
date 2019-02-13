<?php include __THEME__ . '/header.php'; ?>
<?php include __THEME__ . '/user/header.php'; ?>
<link rel="stylesheet" href="/static/markdown/css/editormd.css"/>
<div class="n-user-comment-list">
    <div class="n-user-msg">
        <p id="n-user-msg"></p>
    </div>
    <div class="n-user-article-edit">
        <form action="/admin/article/update" method="post">
            <input type="hidden" name="id" id="id" value="<?= $data['id'] ? $data['id'] : 0 ?>">
            <div class="form-group a-header">
                <div class="a-title"><input class="form-control title-input col-lg-11" name="title" id="title"
                                            type="text" value="<?= $data['title'] ?>" placeholder="##请在此输入创作标题##"></div>
                <div class="a-more">
                    <span class="btn btn-primary a-more-btn">更多选项</span>
                </div>
            </div>

            <div class="a-mask"></div>
            <div class="article-more">
                <div class="form-group">
                    <select name="category_id">
                        <?php foreach ($userCategory as $item): ?>
                            <option value="<?= $item['id'] ?>" <?= $data['category_id'] == $item['id'] ? 'selected' : '' ?>><?= str_repeat('-', $item['deep'] * 2) . $item['title'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="allow_comment">
                        <input type="checkbox" id="allow_comment"
                               name="allow_comment" <?= $data['allow_comment'] == 1 ? 'checked' : ''; ?>> 允许评论
                    </label>
                </div>
                <div class="form-group status">
                    <p class="c-status">文章状态</p>
                    <label class="radio-inline">
                        <input type="radio" name="status"
                               value="1" <?= ($data['status'] == 1 || ($data['status'] == 0 && empty($data['content']))) ? 'checked' : ''; ?>>
                        发布
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="status"
                               value="0" <?= ($data['status'] == 0 && !empty($data['content'])) ? 'checked' : ''; ?>> 草稿
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="status" value="2" <?= $data['status'] == 2 ? 'checked' : ''; ?>> 加密
                    </label>
                </div>
                <div class="form-group password" style="<?= @$data['password'] ? '' : 'display: none' ?>">
                    <input class="form-control" name="password" type="text"
                           value="<?= @$data['password'] ? @$data['password'] : '' ?>" placeholder="输入文章密码">
                </div>
                <div class="form-group">
                    <label class="form-control-label">创建时间</label>
                    <input class="form-control" name="create_time" type="text" value="<?= $data['create_time'] ?>"
                           placeholder="输入创作时间">
                </div>
                <div class="form-group">
                    <label class="form-control-label">创作简介</label>
                    <input type="text" class="form-control" name="description" placeholder="输入简介内容建议200文字以内..."
                           value="<?= $data['description'] ?>">
                </div>
                <div class="form-group">
                    <span class="btn btn-primary col-lg-12 auto-save" onclick="autoSave()">备份到服务器</span>
                </div>
            </div>

            <div class="form-group a-content-form">
                <div id="test-editormd" class="a-input">
                    <textarea style="display:none;" name="content" id="a-content"><?= $data['content'] ?></textarea>
                </div>
            </div>
            <div class="form-group">
                <input type="submit" value="<?= $title; ?>" class="btn btn-primary submit-btn">
            </div>
        </form>
    </div>
</div>
<script src="/static/markdown/editormd.js"></script>
<script type="text/javascript">
    var testEditor;
    $(function () {
        testEditor = editormd("test-editormd", {
            width: "100%",
            height: '60vh',
            path: '/static/markdown/lib/',
            codeFold: true,
            saveHTMLToTextarea: true,
            searchReplace: true,
            htmlDecode: "style,script,iframe|on*",
            imageUpload: true,
            imageFormats: ["jpg", "jpeg", "gif", "png", "bmp", "webp"],
            imageUploadURL: "/admin/base/upload",
        });
    });
</script>
<script data-no-instant>
    function showTipsAlert(value) {
        $('#n-user-msg').text(value);
        $('.n-user-msg').show(500);
        setTimeout(function () {
            $('.n-user-msg').hide(500)
        }, 10000);
    }

    function autoSave(from) {
        let id = $("#id").val();
        let title = $("#title").val();
        let content = testEditor.getMarkdown();
        if (content.length > 0) {
            $.post("/admin/article/autosave", {
                'id': id,
                'title': title,
                'content': content
            }, function (data) {
                if (data.err == 1001) {
                    showTipsAlert(data.msg);
                    $("#id").val(data.id);
                } else {
                    showTipsAlert(data.msg);
                    $("#id").val(data.id);
                }
            });
        }
    }

    //自动保存草稿
    setInterval(function () {
        autoSave()
    }, 180000);
</script>
<?php include __THEME__ . '/footer.php'; ?>
