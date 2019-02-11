<?php include __THEME__.'/header.php'; ?>
    <style>
        .note-body {
            margin: 0;
            width: 100%;
            height: 100vh;
            overflow: overlay;
        }
    </style>
    <div id="write-item" class="col-md-10">
        <link rel="stylesheet" href="/static/markdown/css/editormd.css" />
        <div id="layout">
            <form action="/admin/article/update" method="post">
                <input type="hidden" name="id" value="<?=$data['id']?$data['id']:0?>">
                <div class="c-title a-input">
                    <input class="form-control" name="title" type="text" value="<?=$data['title']?>" placeholder="##请在此输入创作标题##">
                </div>
                <div class="c-category a-input">

                    <span class="c-more"><i class="czs-setting-l"></i> 更多选项</span>

                </div>
                <div class="mask"></div>
                <div class="input-more">
                    <div class="a-input category">
                    <p class="c-status">文章分类</p>
                    <select name="category_id">
                        <?php foreach ($userCategory as $item): ?>
                            <option value="<?=$item['id']?>" <?=$data['category_id'] == $item['id'] ? 'selected' :''?>><?=str_repeat('-',$item['deep'] * 2).$item['title']?></option>
                        <?php endforeach; ?>
                    </select>
                    </div>
                    <div class="form-group a-input">
                        <label for="allow_comment">
                            <input type="checkbox" id="allow_comment" name="allow_comment" <?=$data['allow_comment']==1 ? 'checked' : '';?>> 允许评论
                        </label>
                    </div>
                    <div class="form-group status a-input">
                        <p class="c-status">文章状态</p>
                        <label class="radio-inline">
                            <input type="radio" name="status" value="1" <?=($data['status']==1 || ($data['status']==0 && empty($data['content']))) ? 'checked' : '';?>> 发布
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="status" value="0" <?=($data['status']==0 && !empty($data['content'])) ? 'checked' : '';?>> 草稿
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="status" value="2" <?=$data['status']==2 ? 'checked' : '';?>> 加密
                        </label>
                    </div>
                    <div class="c-time a-input password" style="display: none">
                        <p>文章密码</p>
                        <input class="form-control" name="password" type="text" value="<?=@$data['password']?@$data['password']:''?>" placeholder="输入文章密码">
                    </div>
                    <div class="c-time a-input">
                        <p>创建时间</p>
                        <input class="form-control" name="create_time" type="text" value="<?=$data['create_time']?>" placeholder="输入创作时间">
                    </div>
                    <div class="c-desc a-input">
                        <p>创作简介</p>
                        <input type="text" class="form-control" name="description" placeholder="输入简介内容建议200文字以内..." value="<?=$data['description']?>">
                    </div>

                    <div>

                        <div class="more-submit"><i class="czs-close-l"></i></div>

                    </div>

                </div>

                <div id="test-editormd" class="a-input">
                    <textarea style="display:none;" name="content"><?=$data['content']?></textarea>
                </div>
                <div class="a-submit create-item">
                    <button type="submit"> 发布创作</button>
                </div>
            </form>
        </div>

        <!-- Latest compiled and minified JavaScript -->
        <script src="/static/markdown/editormd.js"></script>
        <script type="text/javascript">
            let testEditor;
            $(function() {
                testEditor = editormd("test-editormd", {
                    width: "100%",
                    height: '77vh',
                    path : '/static/markdown/lib/',
                    codeFold : true,
                    saveHTMLToTextarea : true,
                    searchReplace : true,
                    htmlDecode : "style,script,iframe|on*",
                    imageUpload : true,
                    imageFormats : ["jpg", "jpeg", "gif", "png", "bmp", "webp"],
                    imageUploadURL : "/admin/base/upload",
                });
            });
        </script>
    </div>
<?php include __THEME__.'/footer.php'; ?>