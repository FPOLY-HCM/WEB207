<div ng-controller="DiscussionController">
    <div class="p-5 mb-4 bg-primary rounded-3">
        <div class="container-fluid py-5">
            <h1 class="display-5 fw-bold text-white text-center">%discussion.title%</h1>
        </div>
    </div>
    <div class="row mt-5">
        <div class="col-md-10">
            <div class="row align-items-start">
                <div class="col-md-2 text-center">
                    <img ng-src="%discussion.user.avatar_url%" class="rounded-circle">
                </div>
                <div class="col-md-10">
                    <div class="d-flex align-items-center">
                        <h6>%discussion.user.name%</h6>
                        <span class="ms-3 mb-2 small text-secondary">%discussion.first_post.created_at | since%</span>
                    </div>
                    <div class="mt-3">
                        %discussion.first_post.content%
                    </div>
                </div>
            </div>

            <div class="row align-items-start border-top my-4 pt-4" ng-repeat="post in discussion.posts">
                <div class="col-md-2 text-center">
                    <img ng-src="%discussion.user.avatar_url%" class="rounded-circle">
                </div>
                <div class="col-md-10">
                    <div class="d-flex align-items-center">
                        <h6>%post.user.name%</h6>
                        <span class="ms-3 mb-2 small text-secondary">%post.created_at | since%</span>
                    </div>
                    <div class="mt-3">
                        %post.content%
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-2">
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#commentDiscussionModal">Trả lời chủ đề</button>
        </div>
    </div>
</div>

<div class="modal fade" id="commentDiscussionModal" tabindex="-1" aria-labelledby="commentDiscussionModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="align-items: flex-end;">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">Trả lời chủ đề: %discussion.title%</h5>
            </div>
            <div class="modal-body">
                <textarea name="content" id="content" rows="5" class="form-control" placeholder="Nội dung"></textarea>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Huỷ</button>
                <button type="button" class="btn btn-primary">Trả lời</button>
            </div>
        </div>
    </div>
</div>

