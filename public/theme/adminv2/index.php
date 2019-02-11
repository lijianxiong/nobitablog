<?php include __THEME__.'/header.php'; ?>
<!-- Dashboard Counts Section-->
<section class="dashboard-counts no-padding-bottom">
    <div class="container-fluid">
        <div class="row bg-white has-shadow">
            <!-- Item -->
            <div class="col-xl-3 col-sm-6">
                <div class="item d-flex align-items-center">
                    <div class="icon bg-violet"><i class="icon-user"></i></div>
                    <div class="title"><span>New<br>Visitor</span>
                        <div class="progress">
                            <div role="progressbar" style="width: 25%; height: 4px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" class="progress-bar bg-violet"></div>
                        </div>
                    </div>
                    <div class="number"><strong><?=$statistical['visitor'];?></strong></div>
                </div>
            </div>
            <!-- Item -->
            <div class="col-xl-3 col-sm-6">
                <div class="item d-flex align-items-center">
                    <div class="icon bg-red"><i class="icon-padnote"></i></div>
                    <div class="title"><span>Sum<br>Article</span>
                        <div class="progress">
                            <div role="progressbar" style="width: 70%; height: 4px;" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" class="progress-bar bg-red"></div>
                        </div>
                    </div>
                    <div class="number"><strong><?=$statistical['article_sum'];?></strong></div>
                </div>
            </div>
            <!-- Item -->
            <div class="col-xl-3 col-sm-6">
                <div class="item d-flex align-items-center">
                    <div class="icon bg-green"><i class="icon-bill"></i></div>
                    <div class="title"><span>Sum<br>Comment</span>
                        <div class="progress">
                            <div role="progressbar" style="width: 40%; height: 4px;" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" class="progress-bar bg-green"></div>
                        </div>
                    </div>
                    <div class="number"><strong><?=$statistical['comment_sum'];?></strong></div>
                </div>
            </div>
            <!-- Item -->
            <div class="col-xl-3 col-sm-6">
                <div class="item d-flex align-items-center">
                    <div class="icon bg-orange"><i class="icon-check"></i></div>
                    <div class="title"><span>Like<br>Article</span>
                        <div class="progress">
                            <div role="progressbar" style="width: 50%; height: 4px;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" class="progress-bar bg-orange"></div>
                        </div>
                    </div>
                    <div class="number"><strong><?=$statistical['article_like'];?></strong></div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Projects Section-->
<section class="projects">
    <div class="container-fluid">
        <!-- Project-->
        <div class="project">
            <div class="row bg-white has-shadow">
                <div class="left-col col-lg-6 d-flex align-items-center justify-content-between">
                    <div class="project-title d-flex align-items-center">
                        <div class="image has-shadow"><img src="<?=__PUBLIC__?>/img/project-1.jpg" alt="..." class="img-fluid"></div>
                        <div class="text">
                            <h3 class="h4">Project Title</h3><small>Lorem Ipsum Dolor</small>
                        </div>
                    </div>
                    <div class="project-date"><span class="hidden-sm-down">Today at 4:24 AM</span></div>
                </div>
                <div class="right-col col-lg-6 d-flex align-items-center">
                    <div class="time"><i class="fa fa-clock-o"></i>12:00 PM </div>
                    <div class="comments"><i class="fa fa-comment-o"></i>20</div>
                    <div class="project-progress">
                        <div class="progress">
                            <div role="progressbar" style="width: 45%; height: 6px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" class="progress-bar bg-red"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Project-->
        <div class="project">
            <div class="row bg-white has-shadow">
                <div class="left-col col-lg-6 d-flex align-items-center justify-content-between">
                    <div class="project-title d-flex align-items-center">
                        <div class="image has-shadow"><img src="<?=__PUBLIC__?>/img/project-2.jpg" alt="..." class="img-fluid"></div>
                        <div class="text">
                            <h3 class="h4">Project Title</h3><small>Lorem Ipsum Dolor</small>
                        </div>
                    </div>
                    <div class="project-date"><span class="hidden-sm-down">Today at 4:24 AM</span></div>
                </div>
                <div class="right-col col-lg-6 d-flex align-items-center">
                    <div class="time"><i class="fa fa-clock-o"></i>12:00 PM </div>
                    <div class="comments"><i class="fa fa-comment-o"></i>20</div>
                    <div class="project-progress">
                        <div class="progress">
                            <div role="progressbar" style="width: 60%; height: 6px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" class="progress-bar bg-green"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Project-->
        <div class="project">
            <div class="row bg-white has-shadow">
                <div class="left-col col-lg-6 d-flex align-items-center justify-content-between">
                    <div class="project-title d-flex align-items-center">
                        <div class="image has-shadow"><img src="<?=__PUBLIC__?>/img/project-3.jpg" alt="..." class="img-fluid"></div>
                        <div class="text">
                            <h3 class="h4">Project Title</h3><small>Lorem Ipsum Dolor</small>
                        </div>
                    </div>
                    <div class="project-date"><span class="hidden-sm-down">Today at 4:24 AM</span></div>
                </div>
                <div class="right-col col-lg-6 d-flex align-items-center">
                    <div class="time"><i class="fa fa-clock-o"></i>12:00 PM </div>
                    <div class="comments"><i class="fa fa-comment-o"></i>20</div>
                    <div class="project-progress">
                        <div class="progress">
                            <div role="progressbar" style="width: 50%; height: 6px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" class="progress-bar bg-violet"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Project-->
        <div class="project">
            <div class="row bg-white has-shadow">
                <div class="left-col col-lg-6 d-flex align-items-center justify-content-between">
                    <div class="project-title d-flex align-items-center">
                        <div class="image has-shadow"><img src="<?=__PUBLIC__?>/img/project-4.jpg" alt="..." class="img-fluid"></div>
                        <div class="text">
                            <h3 class="h4">Project Title</h3><small>Lorem Ipsum Dolor</small>
                        </div>
                    </div>
                    <div class="project-date"><span class="hidden-sm-down">Today at 4:24 AM</span></div>
                </div>
                <div class="right-col col-lg-6 d-flex align-items-center">
                    <div class="time"><i class="fa fa-clock-o"></i>12:00 PM </div>
                    <div class="comments"><i class="fa fa-comment-o"></i>20</div>
                    <div class="project-progress">
                        <div class="progress">
                            <div role="progressbar" style="width: 50%; height: 6px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" class="progress-bar bg-orange"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Updates Section                                                -->
<section class="updates no-padding-top">
    <div class="container-fluid">
        <div class="row">
            <!-- Recent Updates-->
            <div class="col-lg-4">
                <div class="recent-updates card">
                    <div class="card-close">
                        <div class="dropdown">
                            <button type="button" id="closeCard6" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-ellipsis-v"></i></button>
                            <div aria-labelledby="closeCard6" class="dropdown-menu dropdown-menu-right has-shadow"><a href="#" class="dropdown-item remove"> <i class="fa fa-times"></i>Close</a><a href="#" class="dropdown-item edit"> <i class="fa fa-gear"></i>Edit</a></div>
                        </div>
                    </div>
                    <div class="card-header">
                        <h3 class="h4">Recent Updates</h3>
                    </div>
                    <div class="card-body no-padding">
                        <!-- Item-->
                        <div class="item d-flex justify-content-between">
                            <div class="info d-flex">
                                <div class="icon"><i class="icon-rss-feed"></i></div>
                                <div class="title">
                                    <h5>Lorem ipsum dolor sit amet.</h5>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit sed.</p>
                                </div>
                            </div>
                            <div class="date text-right"><strong>24</strong><span>May</span></div>
                        </div>
                        <!-- Item-->
                        <div class="item d-flex justify-content-between">
                            <div class="info d-flex">
                                <div class="icon"><i class="icon-rss-feed"></i></div>
                                <div class="title">
                                    <h5>Lorem ipsum dolor sit amet.</h5>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit sed.</p>
                                </div>
                            </div>
                            <div class="date text-right"><strong>24</strong><span>May</span></div>
                        </div>
                        <!-- Item        -->
                        <div class="item d-flex justify-content-between">
                            <div class="info d-flex">
                                <div class="icon"><i class="icon-rss-feed"></i></div>
                                <div class="title">
                                    <h5>Lorem ipsum dolor sit amet.</h5>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit sed.</p>
                                </div>
                            </div>
                            <div class="date text-right"><strong>24</strong><span>May</span></div>
                        </div>
                        <!-- Item-->
                        <div class="item d-flex justify-content-between">
                            <div class="info d-flex">
                                <div class="icon"><i class="icon-rss-feed"></i></div>
                                <div class="title">
                                    <h5>Lorem ipsum dolor sit amet.</h5>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit sed.</p>
                                </div>
                            </div>
                            <div class="date text-right"><strong>24</strong><span>May</span></div>
                        </div>
                        <!-- Item-->
                        <div class="item d-flex justify-content-between">
                            <div class="info d-flex">
                                <div class="icon"><i class="icon-rss-feed"></i></div>
                                <div class="title">
                                    <h5>Lorem ipsum dolor sit amet.</h5>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit sed.</p>
                                </div>
                            </div>
                            <div class="date text-right"><strong>24</strong><span>May</span></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Daily Feeds -->
            <div class="col-lg-4">
                <div class="daily-feeds card">
                    <div class="card-close">
                        <div class="dropdown">
                            <button type="button" id="closeCard7" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-ellipsis-v"></i></button>
                            <div aria-labelledby="closeCard7" class="dropdown-menu dropdown-menu-right has-shadow"><a href="#" class="dropdown-item remove"> <i class="fa fa-times"></i>Close</a><a href="#" class="dropdown-item edit"> <i class="fa fa-gear"></i>Edit</a></div>
                        </div>
                    </div>
                    <div class="card-header">
                        <h3 class="h4">Daily Feeds</h3>
                    </div>
                    <div class="card-body no-padding">
                        <!-- Item-->
                        <div class="item">
                            <div class="feed d-flex justify-content-between">
                                <div class="feed-body d-flex justify-content-between"><a href="#" class="feed-profile"><img src="<?=__PUBLIC__?>/img/avatar-5.jpg" alt="person" class="img-fluid rounded-circle"></a>
                                    <div class="content">
                                        <h5>Aria Smith</h5><span>Posted a new blog </span>
                                        <div class="full-date"><small>Today 5:60 pm - 12.06.2014</small></div>
                                    </div>
                                </div>
                                <div class="date text-right"><small>5min ago</small></div>
                            </div>
                        </div>
                        <!-- Item-->
                        <div class="item">
                            <div class="feed d-flex justify-content-between">
                                <div class="feed-body d-flex justify-content-between"><a href="#" class="feed-profile"><img src="<?=__PUBLIC__?>/img/avatar-2.jpg" alt="person" class="img-fluid rounded-circle"></a>
                                    <div class="content">
                                        <h5>Frank Williams</h5><span>Posted a new blog </span>
                                        <div class="full-date"><small>Today 5:60 pm - 12.06.2014</small></div>
                                        <div class="CTAs"><a href="#" class="btn btn-xs btn-secondary"><i class="fa fa-thumbs-up"> </i>Like</a><a href="#" class="btn btn-xs btn-secondary"><i class="fa fa-heart"> </i>Love    </a></div>
                                    </div>
                                </div>
                                <div class="date text-right"><small>5min ago</small></div>
                            </div>
                        </div>
                        <!-- Item-->
                        <div class="item clearfix">
                            <div class="feed d-flex justify-content-between">
                                <div class="feed-body d-flex justify-content-between"><a href="#" class="feed-profile"><img src="<?=__PUBLIC__?>/img/avatar-3.jpg" alt="person" class="img-fluid rounded-circle"></a>
                                    <div class="content">
                                        <h5>Ashley Wood</h5><span>Posted a new blog </span>
                                        <div class="full-date"><small>Today 5:60 pm - 12.06.2014</small></div>
                                    </div>
                                </div>
                                <div class="date text-right"><small>5min ago</small></div>
                            </div>
                            <div class="quote has-shadow"> <small>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s. Over the years.</small></div>
                            <div class="CTAs pull-right"><a href="#" class="btn btn-xs btn-secondary"><i class="fa fa-thumbs-up"> </i>Like</a></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Recent Activities -->
            <div class="col-lg-4">
                <div class="recent-activities card">
                    <div class="card-close">
                        <div class="dropdown">
                            <button type="button" id="closeCard8" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-ellipsis-v"></i></button>
                            <div aria-labelledby="closeCard8" class="dropdown-menu dropdown-menu-right has-shadow"><a href="#" class="dropdown-item remove"> <i class="fa fa-times"></i>Close</a><a href="#" class="dropdown-item edit"> <i class="fa fa-gear"></i>Edit</a></div>
                        </div>
                    </div>
                    <div class="card-header">
                        <h3 class="h4">Recent Activities</h3>
                    </div>
                    <div class="card-body no-padding">
                        <div class="item">
                            <div class="row">
                                <div class="col-4 date-holder text-right">
                                    <div class="icon"><i class="icon-clock"></i></div>
                                    <div class="date"> <span>6:00 am</span><br><span class="text-info">6 hours ago</span></div>
                                </div>
                                <div class="col-8 content">
                                    <h5>Meeting</h5>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud.</p>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="row">
                                <div class="col-4 date-holder text-right">
                                    <div class="icon"><i class="icon-clock"></i></div>
                                    <div class="date"> <span>6:00 am</span><br><span class="text-info">6 hours ago</span></div>
                                </div>
                                <div class="col-8 content">
                                    <h5>Meeting</h5>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud.</p>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="row">
                                <div class="col-4 date-holder text-right">
                                    <div class="icon"><i class="icon-clock"></i></div>
                                    <div class="date"> <span>6:00 am</span><br><span class="text-info">6 hours ago</span></div>
                                </div>
                                <div class="col-8 content">
                                    <h5>Meeting</h5>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php include __THEME__.'/footer.php'; ?>
