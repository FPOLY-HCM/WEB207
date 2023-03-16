<div class="row" ng-controller="HomeController">
    <div class="col-lg-2">
        <div class="d-grid">
            <button class="btn btn-primary">Đăng thảo luận</button>
        </div>
    </div>
    <div class="col-md-10">
        <div>
            <div class="d-flex align-items-start my-2 bg-body-tertiary p-3 rounded" ng-repeat="discussion in discussions">
                <img class="rounded-circle" style="max-width: 50px;" ng-src="%discussion.user.avatar_url%">
                <div class="ms-3">
                    <a ng-href="#!d/%discussion.id%">
                        <h6>%discussion.title%</h6>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
