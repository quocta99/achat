<template>
    <div class="row m-0 h-100">
        <div class="col-xl-3 col-lg-5 col-md-5 col-sm-12 p-0 bg-white h-100 border-right d-flex flex-column">
            <header-component>
                <slot name="logout" />
            </header-component>
            <div class="side-bar flex-fill d-flex flex-column hidden-scrollbar">
                <conversation-component />
                <div class="side-bar__item d-flex align-items-center p-3">
                    <div class="avatar">
                        <img width="50" height="50" src="https://hinhnen123.com/wp-content/uploads/2021/06/hinh-anh-avatar-dep-nhat-6.jpg" class="img-fluid header-avatar mr-2 border" alt="" />
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
                        <img width="50" height="50" src="https://i.pinimg.com/736x/24/3f/e4/243fe4fa4293f1cb878d9dce142785a0.jpg" class="img-fluid header-avatar mr-2 border" alt="" />
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
                        <img width="50" height="50" src="https://hinhnen123.com/wp-content/uploads/2021/06/hinh-anh-avatar-dep-nhat-6.jpg" class="img-fluid header-avatar mr-2 border" alt="" />
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
                        <img width="50" height="50" src="https://i.pinimg.com/736x/24/3f/e4/243fe4fa4293f1cb878d9dce142785a0.jpg" class="img-fluid header-avatar mr-2 border" alt="" />
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
        <detail-conversation-component />
    </div>
</template>

<script>
    import {mapMutations} from 'vuex'

    export default {
        props: ['auth'],
        mounted() {
            this.setAuth(this.auth)  
        },
        methods: {
            ...mapMutations({
                setAuth: 'setAuth'
            })
        }
    }
</script>
