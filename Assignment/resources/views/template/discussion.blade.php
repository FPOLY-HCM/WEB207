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
                        <span class="ms-3 mb-2 small text-secondary">%discussion.first_post.created_at%</span>
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
                        <span class="ms-3 mb-2 small text-secondary">%post.created_at%</span>
                    </div>
                    <div class="mt-3">
                        %post.content%
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-2">
            hello
        </div>
    </div>
</div>
