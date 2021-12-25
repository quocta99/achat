<template>
    <div class="modal fade" id="createNewChat" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="createNewChatLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header py-2 d-flex align-items-center">
                    <h5 class="modal-title" id="createNewChatLabel">Choose User?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="d-flex align-items-center">
                        <div class="input-group search">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fal fa-search text-secondary"></i>
                                </span>
                            </div>
                            <input type="text" class="form-control" placeholder="Search chat" />
                        </div>
                        <button class="btn btn-primary ml-2 new-chat" data-toggle="modal" data-target="#createNewChat">
                            <i class="fal fa-paper-plane"></i>
                        </button>
                    </div>
                    <div class="list-user mt-3 border">
                        <user-component />
                        <div class="side-bar__item d-flex align-items-center p-2">
                            <div class="avatar">
                                <img width="45" height="45" src="https://hinhnen123.com/wp-content/uploads/2021/06/hinh-anh-avatar-dep-nhat-6.jpg" class="img-fluid header-avatar mr-2 border" alt="" />
                            </div>
                            <div class="header-box flex-fill side-bar__item-content">
                                <p class="header-name mb-0 d-inline-block text-truncate">Lawrence Collins</p>
                                <span class="mb-0 text-secondary d-inline-block text-truncate">lawrece@gmail.com</span>
                            </div>
                        </div>
                        <div class="side-bar__item d-flex align-items-center p-2 active">
                            <div class="avatar">
                                <img width="45" height="45" src="https://hinhnen123.com/wp-content/uploads/2021/06/hinh-anh-avatar-dep-nhat-6.jpg" class="img-fluid header-avatar mr-2 border" alt="" />
                            </div>
                            <div class="header-box flex-fill side-bar__item-content">
                                <p class="header-name mb-0 d-inline-block text-truncate">Lawrence Collins</p>
                                <span class="mb-0 text-secondary d-inline-block text-truncate">lawrece@gmail.com</span>
                            </div>
                        </div>
                        <div class="side-bar__item d-flex align-items-center p-2">
                            <div class="avatar">
                                <img width="45" height="45" src="https://hinhnen123.com/wp-content/uploads/2021/06/hinh-anh-avatar-dep-nhat-6.jpg" class="img-fluid header-avatar mr-2 border" alt="" />
                            </div>
                            <div class="header-box flex-fill side-bar__item-content">
                                <p class="header-name mb-0 d-inline-block text-truncate">Lawrence Collins</p>
                                <span class="mb-0 text-secondary d-inline-block text-truncate">lawrece@gmail.com</span>
                            </div>
                        </div>
                        <div class="side-bar__item d-flex align-items-center p-2">
                            <div class="avatar">
                                <img width="45" height="45" src="https://hinhnen123.com/wp-content/uploads/2021/06/hinh-anh-avatar-dep-nhat-6.jpg" class="img-fluid header-avatar mr-2 border" alt="" />
                            </div>
                            <div class="header-box flex-fill side-bar__item-content">
                                <p class="header-name mb-0 d-inline-block text-truncate">Lawrence Collins</p>
                                <span class="mb-0 text-secondary d-inline-block text-truncate">lawrece@gmail.com</span>
                            </div>
                        </div>
                        <div class="side-bar__item d-flex align-items-center p-2">
                            <div class="avatar">
                                <img width="45" height="45" src="https://hinhnen123.com/wp-content/uploads/2021/06/hinh-anh-avatar-dep-nhat-6.jpg" class="img-fluid header-avatar mr-2 border" alt="" />
                            </div>
                            <div class="header-box flex-fill side-bar__item-content">
                                <p class="header-name mb-0 d-inline-block text-truncate">Lawrence Collins</p>
                                <span class="mb-0 text-secondary d-inline-block text-truncate">lawrece@gmail.com</span>
                            </div>
                        </div>
                        <div class="side-bar__item d-flex align-items-center p-2">
                            <div class="avatar">
                                <img width="45" height="45" src="https://hinhnen123.com/wp-content/uploads/2021/06/hinh-anh-avatar-dep-nhat-6.jpg" class="img-fluid header-avatar mr-2 border" alt="" />
                            </div>
                            <div class="header-box flex-fill side-bar__item-content">
                                <p class="header-name mb-0 d-inline-block text-truncate">Lawrence Collins</p>
                                <span class="mb-0 text-secondary d-inline-block text-truncate">lawrece@gmail.com</span>
                            </div>
                        </div>
                        <div class="side-bar__item d-flex align-items-center p-2">
                            <div class="avatar">
                                <img width="45" height="45" src="https://hinhnen123.com/wp-content/uploads/2021/06/hinh-anh-avatar-dep-nhat-6.jpg" class="img-fluid header-avatar mr-2 border" alt="" />
                            </div>
                            <div class="header-box flex-fill side-bar__item-content">
                                <p class="header-name mb-0 d-inline-block text-truncate">Lawrence Collins</p>
                                <span class="mb-0 text-secondary d-inline-block text-truncate">lawrece@gmail.com</span>
                            </div>
                        </div>
                        <div class="side-bar__item d-flex align-items-center p-2">
                            <div class="avatar">
                                <img width="45" height="45" src="https://hinhnen123.com/wp-content/uploads/2021/06/hinh-anh-avatar-dep-nhat-6.jpg" class="img-fluid header-avatar mr-2 border" alt="" />
                            </div>
                            <div class="header-box flex-fill side-bar__item-content">
                                <p class="header-name mb-0 d-inline-block text-truncate">Lawrence Collins</p>
                                <span class="mb-0 text-secondary d-inline-block text-truncate">lawrece@gmail.com</span>
                            </div>
                        </div>
                        <div class="side-bar__item d-flex align-items-center p-2">
                            <div class="avatar">
                                <img width="45" height="45" src="https://hinhnen123.com/wp-content/uploads/2021/06/hinh-anh-avatar-dep-nhat-6.jpg" class="img-fluid header-avatar mr-2 border" alt="" />
                            </div>
                            <div class="header-box flex-fill side-bar__item-content">
                                <p class="header-name mb-0 d-inline-block text-truncate">Lawrence Collins</p>
                                <span class="mb-0 text-secondary d-inline-block text-truncate">lawrece@gmail.com</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>