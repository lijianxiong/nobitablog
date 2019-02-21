<div class="nobita-comment-container">
    <div class="n-comment-list">
        <div class="n-comment-list-header">
            Comments: <?=$commentNum;?>
        </div>
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
                                <span><a href="#comment-form">@回复</a></span>
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
                                            <span><a href="#comment-form">@回复</a></span>
                                        </div>
                                        <div class="n-comment-content-item">
                                            <p class="n-comment-content-<?= $children['id']; ?>">
                                                @<?= $children['parent_author'] ?> <?= $children['content'] ?></p>
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
    <div id="newcom"></div>
    <div id="want-comment" class="want-comment">「人生在世，留句话给我吧」</div>
    <div id="comment-form" class="n-comment-form-inpput">
        <div class="n-comment-table">
            <div class="comment-trigger">
                <div class="avatar"><img
                            src="<?= $_N['session']['face_url'] ? $_N['session']['face_url'] : '/theme/nobita/images/face.jpg' ?>">
                </div>
                <div class="trigger-title">撰写评论</div>
            </div>

            <div class="new-comment"><textarea name="content" rows="2" class="textarea-box"
                                               id="comment-content"></textarea>
                <span class="comment-error">评论成功啦</span>

            </div>
            <div class="comment-triggered">
                <?php if ($_N['session']['id']): ?>
                <div class="input-body">
                    <ul class="ident n-comment-form-info" style="display: block;" onload="setCookie()">
                        <input type="hidden" name="value" value="<?= $article['id']; ?>" class="value">
                        <input type="hidden" name="user_id" value="<?= $article['user_id']; ?>" class="user_id">
                        <input type="hidden" name="author_id"
                               value="<?= $_N['session']['id'] ? $_N['session']['id'] : ''; ?>" class="author_id">
                        <input type="hidden" name="type" value="<?= $article['type']; ?>" class="type">
                        <input type="hidden" name="title" value="<?= $article['title']; ?>" class="title">
                        <input type="hidden" name="parent_author" value="" class="parent_author">
                        <input type="hidden" name="parent_content" value="" class="parent_content">
                        <input type="hidden" name="parent_id" id="parent_id" value="0">
                        <li>
                            <input type="text" class="form-control" id="author" name="author" placeholder="昵称"
                                   value="<?= $_N['session']['nickname'] ? $_N['session']['nickname'] : ''; ?>">

                        </li>
                        <li>
                            <input type="email" class="form-control" id="email" name="email" placeholder="邮箱"
                                   value="<?= $_N['session']['email'] ? $_N['session']['email'] : ''; ?>">
                        </li>
                        <li>
                            <input type="text" class="form-control" id="url" name="url" placeholder="网站"
                                   value="<?= $_N['session']['url'] ? $_N['session']['url'] : ''; ?>">
                        </li>
                    </ul>
                    <div class="send-btns">
                        <span id="comment-submit">提交评论</span>
                    </div>
                </div>
                <?php else: ?>
                <div class="input-body">
                    <ul class="ident n-comment-form-info" style="display: block;" onload="setCookie()">
                        <input type="hidden" name="value" value="<?= $article['id']; ?>" class="value">
                        <input type="hidden" name="user_id" value="<?= $article['user_id']; ?>" class="user_id">
                        <input type="hidden" name="author_id"
                               value="<?= $_N['session']['id'] ? $_N['session']['id'] : ''; ?>" class="author_id">
                        <input type="hidden" name="type" value="<?= $article['type']; ?>" class="type">
                        <input type="hidden" name="title" value="<?= $article['title']; ?>" class="title">
                        <input type="hidden" name="parent_author" value="" class="parent_author">
                        <input type="hidden" name="parent_content" value="" class="parent_content">
                        <input type="hidden" name="parent_id" id="parent_id" value="0">
                        <li>
                            <input type="text" class="form-control" id="author" name="author" placeholder="昵称"
                                   value="<?= $_N['session']['nickname'] ? $_N['session']['nickname'] : ''; ?>">

                        </li>
                        <li>
                            <input type="email" class="form-control" id="email" name="email" placeholder="邮箱"
                                   value="<?= $_N['session']['email'] ? $_N['session']['email'] : ''; ?>">
                        </li>
                        <li>
                            <input type="text" class="form-control" id="url" name="url" placeholder="网站"
                                   value="<?= $_N['session']['url'] ? $_N['session']['url'] : ''; ?>">
                        </li>
                    </ul>
                    <div class="send-btns">
                        <span id="comment-submit">提交评论</span>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

</div>