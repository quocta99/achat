<template>
    <div class="col-xl-9 col-lg-7 col-md-7 col-sm-0 p-0 d-flex flex-column h-100">
        <div class="header border-bottom p-2 px-3 bg-white">
            <div class="d-flex align-items-center">
                <img width="45" height="45" :src="_.get(conversation, 'participants.[0].user.avatar')" class="img-fluid header-avatar mr-2 border" alt="" />
                <div class="header-box flex-fill">
                    <p class="header-name mb-0" v-text="_.get(conversation, 'participants.[0].user.name')"></p>
                    <small class="text-secondary">Is online</small>
                </div>
            </div>
        </div>
        <div class="messages flex-fill d-flex flex-column hidden-scrollbar p-3" v-chat-scroll="{always: false, smooth: true, scrollonremoved:true, image: true}">
            <infinite-loading direction="top" @infinite="infiniteHandler"></infinite-loading>
            <template v-for="(message, index) in messages" >
                <message-component :key="index" :message="message" />
            </template>
            <!-- <div class="message__item">
                <div class="message__item-float d-flex">
                    <div class="avatar">
                        <img width="40" height="40" src="https://hinhnen123.com/wp-content/uploads/2021/06/hinh-anh-avatar-dep-nhat-6.jpg" class="img-fluid header-avatar mr-2 border" alt="" />
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
            <message-component />
            <div class="message__item mt-3">
                <div class="message__item-float d-flex">
                    <div class="avatar">
                        <img width="40" height="40" src="https://hinhnen123.com/wp-content/uploads/2021/06/hinh-anh-avatar-dep-nhat-6.jpg" class="img-fluid header-avatar mr-2 border" alt="" />
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
                        <img width="40" height="40" src="https://hinhnen123.com/wp-content/uploads/2021/06/hinh-anh-avatar-dep-nhat-6.jpg" class="img-fluid header-avatar mr-2 border" alt="" />
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
                        <img width="40" height="40" src="https://hinhnen123.com/wp-content/uploads/2021/06/hinh-anh-avatar-dep-nhat-6.jpg" class="img-fluid header-avatar mr-2 border" alt="" />
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
            <div class="message__item sender mt-2">
                <div class="message__item-float d-flex align-items-center flex-row justify-content-end">
                    <span class="mb-0 text-secondary d-inline-block text-truncate"><i class="fal fa-check"></i> Đã xem</span>
                    <div class="d-flex">
                        <img width="20" height="20" src="https://i.pinimg.com/736x/24/3f/e4/243fe4fa4293f1cb878d9dce142785a0.jpg" class="img-fluid header-avatar ml-1 border" alt="" />
                    </div>
                </div>
            </div> -->
        </div>
        <form-component />
    </div>
</template>
<script>
import { mapGetters, mapMutations } from 'vuex'
export default {
    data() {
        return {
            last_message_id: null
        }
    },
    mounted() {
        this.last_message_id = null
    },
    computed: {
        ...mapGetters({
            conversation: 'getConversationDetail',
            messages: 'getMessages'
        })
    },
    methods: {
        ...mapMutations({
            setMessages: 'setMessages'
        }),
        async infiniteHandler($state) {
            const res = await axios.get(`/chat/conversation/${this.conversation.id}/message`, this.last_message_id ? {
                params: {
                    last_message_id: this.last_message_id
                }
            } : {})
            if(!!res.data) {
                this.setMessages(_.get(res, 'data.data.messages', []))
                this.last_message_id = _.get(res, 'data.data.last_message_id', null)
            }
            $state.loaded()
            if(_.get(res, 'data.data.messages', []).length == 0) {
                $state.complete()
            }
        }
    }
}
</script>