<div ng-controller="DiscussionController">
    <div class="p-5 mb-4 bg-primary rounded-3">
        <div class="container-fluid py-5">
            <h1 class="display-5 fw-bold text-white text-center">%discussion.title%</h1>
        </div>
    </div>
    <div class="row mt-5">
        <div class="col-md-10">
            <div class="d-flex gap-4 align-items-start border-bottom py-4 mb-4" ng-repeat="post in discussion.posts">
                <div class="text-center">
                    <img ng-src="%post.user.avatar_url%" class="rounded-circle" width="80">
                </div>
                <div>
                    <div class="mb-2">
                        <div class="d-flex gap-3">
                            <a href="#!/u/%post.user.id%">
                                <h6 class="mb-0">%post.user.name%</h6>
                            </a>
                        </div>
                        <span class="mt-1 small text-secondary">Đăng lúc %post.created_at | since%</span>
                    </div>
                    <div class="mt-3" ng-bind-html="post.content_html"></div>
                </div>
            </div>
        </div>
        <div class="col-md-2">
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#replyDiscussionModal">Trả lời chủ đề</button>
        </div>
    </div>
</div>

<div ng-controller="ReplyDiscussionController" class="modal fade" id="replyDiscussionModal" tabindex="-1" aria-labelledby="replyDiscussionModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="align-items: flex-end;">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">Trả lời chủ đề: %discussion.title%</h6>
            </div>
            <div class="modal-body">
                <textarea name="content" id="content" rows="5" class="form-control" placeholder="Nội dung"></textarea>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Huỷ</button>
                <button type="button" ng-click="reply()" class="btn btn-primary">Trả lời</button>
            </div>
        </div>
    </div>
</div>

