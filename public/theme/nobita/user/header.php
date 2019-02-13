<style>
    .nobita-sidebar {
        display: none;
    }
</style>
<div class="nobita-post-list">
    <div class="n-post-list">
        <div class="nobita-user-meta">
            <div class="n-user-gravatar">
                <img src="<?= $userData['base']['face_url']; ?>" alt="<?= $userData['base']['nickname']; ?>">
            </div>
            <div class="n-user-display">
                <div class="n-user-nickname">
                    <h4><?= $userData['base']['nickname']; ?></h4>
                </div>
                <div class="n-user-description">
                    <p><?= $userData['base']['description'] ? $userData['base']['description'] : '这个家伙很懒，什么也没有留下'; ?></p>
                </div>
                <div class="n-user-additional">
                    文章数<?= $userData['center']['article_sum']; ?> 评论数<?= $userData['center']['comment_sum']; ?> 关注0 被关注0
                </div>
            </div>
        </div>
        <div class="n-user-nav">
            <ul>

                <li><a href="/profile/comment" class="<?= $activeComment; ?>">评论</a></li>
                <li><a href="/profile/msg" class="<?= $activeMsg ?>">消息</a></li>
                <?= $userData['base']['group'] == 1 ? '<li><a href="/profile/dynamic" class="<?= $dynamicActive; ?>">动态</a></li><li><a href="/profile/article" class="<?= $activeArticle; ?>">个人文章</a></li><li><a href="/profile/write" target="_blank">写文章</a></li>' : '' ?>
                <li><a href="/profile/edit" class="<?= $editActive; ?>"><i class="czs-setting-l"> </i> 修改资料</a></li>
                <li><a href="javascript:;" class="user-login-out"><i class="czs-out-l"> </i> 退出登录</a></li>
            </ul>
        </div>
    </div>
</div>