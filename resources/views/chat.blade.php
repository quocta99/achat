@extends('layouts.no-header')

@section('content')
    <div class="row m-0 h-100">
        <div class="col-xl-3 col-lg-5 col-md-5 col-sm-12 p-0 bg-white h-100 border-right d-flex flex-column">
            <div class="header border-bottom p-2 px-3">
                <div class="d-flex align-items-center mb-4">
                    <img width="45" height="45" src="https://haycafe.vn/wp-content/uploads/2021/11/Anh-avatar-dep-chat-lam-hinh-dai-dien.jpg" class="img-fluid header-avatar mr-2" alt="" />
                    <div class="header-box flex-fill">
                        <p class="header-name mb-0">Lawrence Collins</p>
                    </div>
                    <span class="logout">
                        <i class="fal fa-sign-out-alt text-secondary"></i>
                    </span>
                </div>
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
                        <i class="fas fa-plus-circle"></i>
                    </button>
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
                                        <div class="side-bar__item d-flex align-items-center p-2">
                                            <div class="avatar">
                                                <img width="45" height="45" src="https://hinhnen123.com/wp-content/uploads/2021/06/hinh-anh-avatar-dep-nhat-6.jpg" class="img-fluid header-avatar mr-2" alt="" />
                                            </div>
                                            <div class="header-box flex-fill side-bar__item-content">
                                                <p class="header-name mb-0 d-inline-block text-truncate">Lawrence Collins</p>
                                                <span class="mb-0 text-secondary d-inline-block text-truncate">lawrece@gmail.com</span>
                                            </div>
                                        </div>
                                        <div class="side-bar__item d-flex align-items-center p-2 active">
                                            <div class="avatar">
                                                <img width="45" height="45" src="https://hinhnen123.com/wp-content/uploads/2021/06/hinh-anh-avatar-dep-nhat-6.jpg" class="img-fluid header-avatar mr-2" alt="" />
                                            </div>
                                            <div class="header-box flex-fill side-bar__item-content">
                                                <p class="header-name mb-0 d-inline-block text-truncate">Lawrence Collins</p>
                                                <span class="mb-0 text-secondary d-inline-block text-truncate">lawrece@gmail.com</span>
                                            </div>
                                        </div>
                                        <div class="side-bar__item d-flex align-items-center p-2">
                                            <div class="avatar">
                                                <img width="45" height="45" src="https://hinhnen123.com/wp-content/uploads/2021/06/hinh-anh-avatar-dep-nhat-6.jpg" class="img-fluid header-avatar mr-2" alt="" />
                                            </div>
                                            <div class="header-box flex-fill side-bar__item-content">
                                                <p class="header-name mb-0 d-inline-block text-truncate">Lawrence Collins</p>
                                                <span class="mb-0 text-secondary d-inline-block text-truncate">lawrece@gmail.com</span>
                                            </div>
                                        </div>
                                        <div class="side-bar__item d-flex align-items-center p-2">
                                            <div class="avatar">
                                                <img width="45" height="45" src="https://hinhnen123.com/wp-content/uploads/2021/06/hinh-anh-avatar-dep-nhat-6.jpg" class="img-fluid header-avatar mr-2" alt="" />
                                            </div>
                                            <div class="header-box flex-fill side-bar__item-content">
                                                <p class="header-name mb-0 d-inline-block text-truncate">Lawrence Collins</p>
                                                <span class="mb-0 text-secondary d-inline-block text-truncate">lawrece@gmail.com</span>
                                            </div>
                                        </div>
                                        <div class="side-bar__item d-flex align-items-center p-2">
                                            <div class="avatar">
                                                <img width="45" height="45" src="https://hinhnen123.com/wp-content/uploads/2021/06/hinh-anh-avatar-dep-nhat-6.jpg" class="img-fluid header-avatar mr-2" alt="" />
                                            </div>
                                            <div class="header-box flex-fill side-bar__item-content">
                                                <p class="header-name mb-0 d-inline-block text-truncate">Lawrence Collins</p>
                                                <span class="mb-0 text-secondary d-inline-block text-truncate">lawrece@gmail.com</span>
                                            </div>
                                        </div>
                                        <div class="side-bar__item d-flex align-items-center p-2">
                                            <div class="avatar">
                                                <img width="45" height="45" src="https://hinhnen123.com/wp-content/uploads/2021/06/hinh-anh-avatar-dep-nhat-6.jpg" class="img-fluid header-avatar mr-2" alt="" />
                                            </div>
                                            <div class="header-box flex-fill side-bar__item-content">
                                                <p class="header-name mb-0 d-inline-block text-truncate">Lawrence Collins</p>
                                                <span class="mb-0 text-secondary d-inline-block text-truncate">lawrece@gmail.com</span>
                                            </div>
                                        </div>
                                        <div class="side-bar__item d-flex align-items-center p-2">
                                            <div class="avatar">
                                                <img width="45" height="45" src="https://hinhnen123.com/wp-content/uploads/2021/06/hinh-anh-avatar-dep-nhat-6.jpg" class="img-fluid header-avatar mr-2" alt="" />
                                            </div>
                                            <div class="header-box flex-fill side-bar__item-content">
                                                <p class="header-name mb-0 d-inline-block text-truncate">Lawrence Collins</p>
                                                <span class="mb-0 text-secondary d-inline-block text-truncate">lawrece@gmail.com</span>
                                            </div>
                                        </div>
                                        <div class="side-bar__item d-flex align-items-center p-2">
                                            <div class="avatar">
                                                <img width="45" height="45" src="https://hinhnen123.com/wp-content/uploads/2021/06/hinh-anh-avatar-dep-nhat-6.jpg" class="img-fluid header-avatar mr-2" alt="" />
                                            </div>
                                            <div class="header-box flex-fill side-bar__item-content">
                                                <p class="header-name mb-0 d-inline-block text-truncate">Lawrence Collins</p>
                                                <span class="mb-0 text-secondary d-inline-block text-truncate">lawrece@gmail.com</span>
                                            </div>
                                        </div>
                                        <div class="side-bar__item d-flex align-items-center p-2">
                                            <div class="avatar">
                                                <img width="45" height="45" src="https://hinhnen123.com/wp-content/uploads/2021/06/hinh-anh-avatar-dep-nhat-6.jpg" class="img-fluid header-avatar mr-2" alt="" />
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
                </div>
            </div>
            <div class="side-bar flex-fill d-flex flex-column hidden-scrollbar">
                <div class="side-bar__item d-flex align-items-center p-3">
                    <div class="avatar">
                        <img width="50" height="50" src="https://hinhnen123.com/wp-content/uploads/2021/06/hinh-anh-avatar-dep-nhat-6.jpg" class="img-fluid header-avatar mr-2" alt="" />
                    </div>
                    <div class="header-box flex-fill side-bar__item-content">
                        <p class="header-name mb-0 d-inline-block text-truncate">Lawrence Collins</p>
                        <span class="mb-0 text-secondary d-inline-block text-truncate">Apple pie bonbon cheesecake tiramisu</span>
                    </div>
                    <div class="time header-box ml-1">
                        <span class="time__ago mb-1">2.38pm</span>
                        <span class="badge badge-pill badge-danger">4</span>
                    </div>
                </div>
                <div class="side-bar__item d-flex align-items-center p-3 active">
                    <div class="avatar">
                        <img width="50" height="50" src="https://i.pinimg.com/736x/24/3f/e4/243fe4fa4293f1cb878d9dce142785a0.jpg" class="img-fluid header-avatar mr-2" alt="" />
                    </div>
                    <div class="header-box flex-fill side-bar__item-content">
                        <p class="header-name mb-0 d-inline-block text-truncate">Nicolas Collins</p>
                        <span class="mb-0 text-secondary d-inline-block text-truncate">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam tenetur autem maxime, facilis ipsa natus incidunt ullam a dignissimos, quod numquam qui beatae odit dolorem saepe inventore veniam quas similique.</span>
                    </div>
                    <div class="time header-box ml-1">
                        <span class="time__ago mb-1">2.38pm</span>
                        <span class="badge badge-pill badge-danger">4</span>
                    </div>
                </div>
                <div class="side-bar__item d-flex align-items-center p-3">
                    <div class="avatar">
                        <img width="50" height="50" src="https://hinhnen123.com/wp-content/uploads/2021/06/hinh-anh-avatar-dep-nhat-6.jpg" class="img-fluid header-avatar mr-2" alt="" />
                    </div>
                    <div class="header-box flex-fill side-bar__item-content">
                        <p class="header-name mb-0 d-inline-block text-truncate">Lawrence Collins</p>
                        <span class="mb-0 text-secondary d-inline-block text-truncate">Apple pie bonbon cheesecake tiramisu</span>
                    </div>
                    <div class="time header-box ml-1">
                        <span class="time__ago mb-1">2.38pm</span>
                        <span class="badge badge-pill badge-danger">4</span>
                    </div>
                </div>
                <div class="side-bar__item d-flex align-items-center p-3">
                    <div class="avatar">
                        <img width="50" height="50" src="https://i.pinimg.com/736x/24/3f/e4/243fe4fa4293f1cb878d9dce142785a0.jpg" class="img-fluid header-avatar mr-2" alt="" />
                    </div>
                    <div class="header-box flex-fill side-bar__item-content">
                        <p class="header-name mb-0 d-inline-block text-truncate">Nicolas Collins</p>
                        <span class="mb-0 text-secondary d-inline-block text-truncate">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam tenetur autem maxime, facilis ipsa natus incidunt ullam a dignissimos, quod numquam qui beatae odit dolorem saepe inventore veniam quas similique.</span>
                    </div>
                    <div class="time header-box ml-1">
                        <span class="time__ago mb-1">2.38pm</span>
                        <span class="badge badge-pill badge-danger">4</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-9 col-lg-7 col-md-7 col-sm-0 p-0 d-flex flex-column h-100">
            <div class="header border-bottom p-2 px-3 bg-white">
                <div class="d-flex align-items-center">
                    <img width="45" height="45" src="https://haycafe.vn/wp-content/uploads/2021/11/Anh-avatar-dep-chat-lam-hinh-dai-dien.jpg" class="img-fluid header-avatar mr-2" alt="" />
                    <div class="header-box flex-fill">
                        <p class="header-name mb-0">Lawrence Collins</p>
                        <small class="text-secondary">Is online</small>
                    </div>
                </div>
            </div>
            <div class="messages flex-fill d-flex flex-column hidden-scrollbar p-3">
                <div class="message__item">
                    <div class="message__item-float d-flex">
                        <div class="avatar">
                            <img width="40" height="40" src="https://hinhnen123.com/wp-content/uploads/2021/06/hinh-anh-avatar-dep-nhat-6.jpg" class="img-fluid header-avatar mr-2" alt="" />
                        </div>
                        <div class="header-box flex-fill side-bar__item-content">
                            <div class="message__item-content border">
                                <div class="text-type p-2 bg-white px-3">
                                    Lawrence Collins
                                </div>
                            </div>
                            <span class="mb-0 mt-1 text-secondary d-inline-block text-truncate">Lawrence Collins, 2.38pm</span>
                        </div>
                    </div>
                </div>
                <div class="message__item mt-3">
                    <div class="message__item-float d-flex">
                        <div class="avatar">
                            <img width="40" height="40" src="https://hinhnen123.com/wp-content/uploads/2021/06/hinh-anh-avatar-dep-nhat-6.jpg" class="img-fluid header-avatar mr-2" alt="" />
                        </div>
                        <div class="header-box flex-fill side-bar__item-content">
                            <div class="message__item-content border">
                                <div class="text-type p-2 bg-white px-3">
                                    Lorem ipsum, dolor sit amet consectetur adipisicing elit. Ex repudiandae rem exercitationem recusandae cumque sed ipsum consequuntur, odio eos sit, quae officiis vero dignissimos dolores hic animi? Dolore, error quae.
                                </div>
                            </div>
                            <span class="mb-0 mt-1 text-secondary d-inline-block text-truncate">Lawrence Collins, 2.38pm</span>
                        </div>
                    </div>
                </div>
                <div class="message__item sender mt-3">
                    <div class="message__item-float d-flex">
                        <div class="avatar">
                            <img width="40" height="40" src="https://hinhnen123.com/wp-content/uploads/2021/06/hinh-anh-avatar-dep-nhat-6.jpg" class="img-fluid header-avatar mr-2" alt="" />
                        </div>
                        <div class="header-box flex-fill side-bar__item-content">
                            <div class="message__item-content border">
                                <div class="text-type p-2 bg-white px-3">
                                    Lorem ipsum, dolor sit amet consectetur adipisicing elit. Ex repudiandae rem exercitationem recusandae cumque sed ipsum consequuntur, odio eos sit, quae officiis vero dignissimos dolores hic animi? Dolore, error quae.
                                </div>
                            </div>
                            <span class="mb-0 mt-1 text-secondary d-inline-block text-truncate">Lawrence Collins, 2.38pm</span>
                        </div>
                    </div>
                </div>
                <div class="message__item sender mt-3">
                    <div class="message__item-float d-flex">
                        <div class="avatar">
                            <img width="40" height="40" src="https://hinhnen123.com/wp-content/uploads/2021/06/hinh-anh-avatar-dep-nhat-6.jpg" class="img-fluid header-avatar mr-2" alt="" />
                        </div>
                        <div class="header-box flex-fill side-bar__item-content">
                            <div class="message__item-content border">
                                <div class="image-type bg-white">
                                    <a href="https://pdp.edu.vn/wp-content/uploads/2021/05/hinh-anh-avatar-de-thuong.jpg" class="w-100 h-100" data-fancybox>
                                        <img src="https://pdp.edu.vn/wp-content/uploads/2021/05/hinh-anh-avatar-de-thuong.jpg" class="img-fluid" />
                                    </a>
                                </div>
                                <div class="text-type p-2 bg-white px-3">
                                    Lorem ipsum, dolor sit amet ?
                                </div>
                            </div>
                            <span class="mb-0 mt-1 text-secondary d-inline-block text-truncate">Lawrence Collins, 2.38pm</span>
                        </div>
                    </div>
                </div>
                <div class="message__item sender mt-1">
                    <div class="message__item-float d-flex">
                        <span class="mb-0 mt-1 text-secondary d-inline-block text-truncate"><i class="fal fa-check"></i> Đã xem</span>
                    </div>
                </div>
            </div>
            <div class="d-flex align-items-center p-2 border-top bg-white">
                <div class="input-group search">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <i class="fal fa-images"></i>
                        </span>
                    </div>
                    <input type="text" class="form-control" placeholder="Typing..." />
                </div>
                <button class="btn btn-primary ml-2 new-chat">
                    <i class="fal fa-paper-plane"></i>
                </button>
            </div>
        </div>
    </div>
@endsection