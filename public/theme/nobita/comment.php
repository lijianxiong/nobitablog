<div class="nobita-comment-container">
    <div class="n-comment-list">
        <?php
        if (!empty($comment)):?>
            <?php foreach ($comment as $item): ?>
                <div id="n-comment-<?= $item['id']; ?>" class="n-comment-item-dom">
                    <div id="n-comment-item-<?= $item['id']; ?>" class="n-comment-item">
                        <div class="n-comment-gravatar">
                            <img src="<?= $item['email']; ?>" alt="<?= $item['author']; ?>">
                        </div>
                        <div class="n-comment-content">
                            <div class="n-comment-meta">
                                <div class="n-comment-author">
                                    <a href="<?= $item['url']; ?>"
                                       class="n-comment-author-<?= $item['id']; ?>" rel="nofollow"
                                       target="_blank"><?= $item['author']; ?></a>
                                </div>
                                <div class="n-comment-time">
                                    <?= $item['time']; ?>
                                </div>
                                <?= $userId == $article['user_id'] ? '<div class="n-comment-del" data-id="' . $item['id'] . '">&nbsp; 删除评论</div>' : '' ?>
                            </div>
                            <div class="n-comment-reply" data-id="<?= $item['id']; ?>">
                                <span>@回复</span>
                            </div>
                            <div class="n-comment-content-item">
                                <p class="n-comment-content-<?= $item['id']; ?>"><?= $item['content']; ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="n-comment-item-children">
                        <?php if (!empty($item['reply'])): ?>
                            <?php foreach ($item['reply'] as $children): ?>
                                <div id="n-comment-item-<?= $children['id']; ?>" class="n-comment-item">
                                    <div class="n-comment-gravatar">
                                        <img src="<?= $children['email']; ?>" alt="<?= $children['author']; ?>">
                                    </div>
                                    <div class="n-comment-content">
                                        <div class="n-comment-meta">
                                            <div class="n-comment-author">
                                                <a href="<?= $children['url'] ?>"
                                                   class="n-comment-author-<?= $children['id']; ?>" rel="nofollow"
                                                   target="_blank"><?= $children['author'] ?></a>
                                            </div>
                                            <div class="n-comment-time">
                                                <?= $children['time'] ?>
                                            </div>
                                            <?= $userId == $article['user_id'] ? '<div class="n-comment-del" data-id="' . $children['id'] . '">&nbsp 删除评论</div>' : '' ?>
                                        </div>
                                        <div class="n-comment-reply" data-id="<?= $children['id']; ?>">
                                            <span>@回复</span>
                                        </div>
                                        <div class="n-comment-content-item">
                                            <p>@<?= $children['parent_author'] ?> <?= $children['content'] ?></p>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>

        <?php else: ?>
    </div>
    <div id="empty_comment">暂无评论</div>
    <?php endif; ?>
    <div id="want-comment" class="want-comment">「人生在世，留句话给我吧」</div>
    <div class="nobita-send-comment" style="display: none">
        <div class="n-send-form">
            <div class="n-form-body">
                <div class="n-send-header">
                    <h4>发布评论</h4>
                    <p><?= $_N['session']['id'] ? '' : '<span class="n-edit-from">##修改表单信息##</span>'; ?> <span
                                class="n-close-form">取消回复 <span class="parent_author"></span></span> <?=$_N['session']['id']?'':'<a href="javascript:;" class="user-login">## QQ登录</a>';?></p>
                </div>
                <?php if ($_N['session']['id']): ?>
                    <div class="n-comment-form-info" style="display: block;">
                        <input type="hidden" name="value" value="<?= $article['id']; ?>" class="value">
                        <input type="hidden" name="user_id" value="<?= $article['user_id']; ?>" class="user_id">
                        <input type="hidden" value="<?= $_N['session']['face_url']; ?>" class="face_url">
                        <input type="hidden" name="author_id"
                               value="<?= $_N['session']['id'] ? $_N['session']['id'] : ''; ?>" class="author_id">
                        <input type="hidden" name="type" value="<?= $article['type']; ?>" class="type">
                        <input type="hidden" name="title" value="<?= $article['title']; ?>" class="title">
                        <input type="hidden" name="parent_author" value="" class="parent_author">
                        <input type="hidden" name="parent_content" value="" class="parent_content">
                        <input type="hidden" name="parent_id" id="parent_id" value="0">
                        <div class="form-group">
                            <label for="author">昵称：</label>
                            <input type="text" class="form-control" id="author" name="author" aria-required="true"
                                   required="required"
                                   value="<?= $_N['session']['nickname'] ? $_N['session']['nickname'] : ''; ?>">
                        </div>
                        <div class="form-group">
                            <label for="email">邮箱：</label>
                            <input type="email" class="form-control" id="email" name="email" aria-required="true"
                                   required="required"
                                   value="<?= $_N['session']['email'] ? $_N['session']['email'] : ''; ?>">
                        </div>
                        <div class="form-group">
                            <label for="url">网址：</label>
                            <input type="text" class="form-control" id="url" name="url" aria-required="true"
                                   required="required"
                                   value="<?= $_N['session']['url'] ? $_N['session']['url'] : ''; ?>">
                        </div>
                    </div>
                    <div class="form-group" style="border: 0px solid #eee;">
                    <textarea class="form-control" rows="4" placeholder="世事如书，我偏爱你这一句。" id="comment-content"
                              name="content"></textarea>
                    </div>
                    <p class="n-comment-tips"></p>
                    <div class="send-btn">
                        <span id="comment-submit">点我，提交评论</span>
                    </div>
                <?php else: ?>
                    <form autocomplete="on" onload="setCookie()">
                        <div class="n-comment-form-info" style="display: block;">
                            <input type="hidden" name="value" value="<?= $article['id']; ?>" class="value">
                            <input type="hidden" name="user_id" value="<?= $article['user_id']; ?>" class="user_id">
                            <input type="hidden" name="author_id"
                                   value="<?= $_N['session']['id'] ? $_N['session']['id'] : ''; ?>" class="author_id">
                            <input type="hidden" name="type" value="<?= $article['type']; ?>" class="type">
                            <input type="hidden" name="title" value="<?= $article['title']; ?>" class="title">
                            <input type="hidden" name="parent_author" value="" class="parent_author">
                            <input type="hidden" name="parent_content" value="" class="parent_content">
                            <input type="hidden" name="parent_id" id="parent_id" value="0">
                            <div class="form-group">
                                <label for="author">昵称：</label>
                                <input type="text" class="form-control" id="author" name="author" aria-required="true"
                                       required="required"
                                       value="<?= $_N['session']['nickname'] ? $_N['session']['nickname'] : ''; ?>">
                            </div>
                            <div class="form-group">
                                <label for="email">邮箱：</label>
                                <input type="email" class="form-control" id="email" name="email" aria-required="true"
                                       required="required"
                                       value="<?= $_N['session']['email'] ? $_N['session']['email'] : ''; ?>">
                            </div>
                            <div class="form-group">
                                <label for="url">网址：</label>
                                <input type="text" class="form-control" id="url" name="url" aria-required="true"
                                       required="required"
                                       value="<?= $_N['session']['url'] ? $_N['session']['url'] : ''; ?>">
                            </div>
                        </div>
                        <div class="form-group" style="border: 0px solid #eee;">
                    <textarea class="form-control" rows="4" placeholder="世事如书，我偏爱你这一句。" id="comment-content"
                              name="content"></textarea>
                        </div>
                        <p class="n-comment-tips"></p>
                        <div class="send-btn">
                            <span id="comment-submit">点我，提交评论</span>
                        </div>
                    </form>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>