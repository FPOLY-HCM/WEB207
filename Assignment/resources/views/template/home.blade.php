<div class="row" ng-controller="HomeController">
    <div class="col-lg-3">
        <div class="d-grid">
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#startDiscussionModal">Đăng thảo luận</button>
        </div>
        <div class="mt-4">
            <ul class="list-group list-group-flush">
                <li class="list-group-item" ng-repeat="tag in tags">
                    <a href="#!t/%tag.slug%" style="color: %tag.color%">%tag.name%</a>
                </li>
            </ul>
        </div>
    </div>
    <div class="col-md-9">
        <div>
            <div class="d-flex align-items-start my-2 bg-body-tertiary p-3 rounded" ng-repeat="discussion in discussions">
                <img class="rounded-circle" style="max-width: 50px;" ng-src="%discussion.user.avatar_url%">
                <div class="ms-3">
                    <a ng-href="#!d/%discussion.id%">
                        <h6>%discussion.title%</h6>
                    </a>
                    <div class="small text-body-secondary">
                        <i class="fas fa-reply"></i>
                        <span class="fw-bold">%discussion.last_post.user.name%</span>
                        đã trả lời %discussion.last_post.created_at | since%
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="startDiscussionModal" tabindex="-1" aria-labelledby="startDiscussionModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="align-items: flex-end;">
        <div class="modal-content">
            <div class="modal-header">
                <input type="text" class="form-control" placeholder="Tiêu đề">
            </div>
            <div class="modal-body">
                <textarea name="content" id="content" rows="5" class="form-control" placeholder="Nội dung"></textarea>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Huỷ</button>
                <button type="button" class="btn btn-primary">Đăng</button>
            </div>
        </div>
    </div>
</div>
