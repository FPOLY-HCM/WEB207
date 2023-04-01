<div class="row">
    <div class="col-lg-3">
        <div class="d-grid">
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#{{ auth()->check() ? 'startDiscussion' : 'login' }}Modal">Đăng thảo luận</button>
        </div>
        <div class="mt-4">
            <ul class="list-group list-group-flush">
                <li class="list-group-item" ng-repeat="tag in tags">
                    <a href="#!t/%tag.slug%" class="fw-semibold text-decoration-none" style="color: %tag.color%">
                        %tag.name%
                    </a>
                    <span class="small">(%tag.discussions_count%)</span>
                </li>
            </ul>
        </div>
    </div>
    <div class="col-lg-9">
        <div>
            <div class="d-flex align-items-start my-2 bg-body-tertiary p-3 rounded" ng-repeat="discussion in discussions">
                <img class="rounded-circle" style="max-width: 50px;" ng-src="%discussion.user.avatar_url%">
                <div class="ms-3 d-flex align-items-center justify-content-between w-100">
                    <div>
                        <a ng-href="#!d/%discussion.id%">
                            <h6>%discussion.title%</h6>
                        </a>
                        <div class="small text-body-secondary">
                            <i class="fas fa-reply"></i>
                            <span class="fw-bold">%discussion.last_post.user.name%</span>
                            đã trả lời %discussion.last_post.created_at | since%
                        </div>
                    </div>
                    <div class="d-flex align-items-center gap-4">
                        <div>
                            <span class="badge" ng-style="{backgroundColor: tag.color}" ng-repeat="tag in discussion.tags">
                                %tag.name%
                            </span>
                        </div>
                        <div class="text-body-secondary small">
                            <i class="fas fa-comment"></i>
                            <span>%discussion.posts_count%</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div ng-controller="StartDiscussionController" class="modal fade" id="startDiscussionModal" tabindex="-1" aria-labelledby="startDiscussionModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="align-items: flex-end;">
        <div class="modal-content">
            <div class="modal-header">
                <input type="text" ng-model="title" autofocus class="form-control" placeholder="Tiêu đề">
            </div>
            <div class="modal-body">
                <textarea ng-model="content" id="content" rows="5" class="form-control" placeholder="Nội dung"></textarea>
                <div class="form-check mt-3">
                    <input class="form-check-input" type="checkbox" ng-model="autoAnswer" id="auto_answer">
                    <label class="form-check-label" for="auto_answer">
                        AI tự động trả lời
                    </label>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Huỷ</button>
                <button type="button" ng-click="start()" class="btn btn-primary">
                    <i class="fas fa-spinner fa-spin" ng-show="loading"></i>
                    <span ng-bind="loading ? 'Đang đăng' : 'Đăng'"></span>
                </button>
            </div>
        </div>
    </div>
</div>
