<template>
    <div class="col-xl-9 col-lg-7 col-md-7 col-sm-0 p-0 d-flex flex-column h-100">
        <div class="header border-bottom p-2 px-3 bg-white">
            <div class="d-flex align-items-center">
                <div class="avatar">
                    <img width="45" height="45" :src="_.get(conversation, 'participants.[0].user.avatar')" class="img-fluid header-avatar mr-2 border" alt="" />
                    <div :class="`status ${isOnline ? 'bg-success' : 'bg-danger'}`"></div>
                </div>
                <div class="header-box flex-fill">
                    <p class="header-name mb-0" v-text="_.get(conversation, 'participants.[0].user.name')"></p>
                    <small class="text-secondary" v-if="isOnline">Is online</small>
                </div>
            </div>
        </div>
        <div class="messages flex-fill d-flex flex-column hidden-scrollbar p-3" v-chat-scroll="{always: true, smooth: true, scrollonremoved: true, image: true}">
            <infinite-loading direction="top" @infinite="infiniteHandler"></infinite-loading>
            <template v-for="(message, index) in messages" >
                <message-component :key="index" :message="message" />
            </template>
            <div class="message__item sender mt-2" v-if="messages.length && currentUser.id == _.get(lastMessage, 'sender.id', -1) && isReaded">
                <div class="message__item-float d-flex align-items-center flex-row justify-content-end">
                    <small class="mb-0 text-secondary d-inline-block text-truncate"><i class="fal fa-check"></i> Seen by {{ _.get(lastMessage, 'sender.name', '') }}</small>
                </div>
            </div>
        </div>
        <form-component />
    </div>
</template>
<script>
import { mapActions, mapGetters, mapMutations } from 'vuex'
export default {
    data() {
        return {
            last_message_id: null
        }
    },
    async mounted() {
        this.last_message_id = null
        await this.readMessage(this.conversation.id)
    },
    computed: {
        ...mapGetters({
            conversation: 'getConversationDetail',
            messages: 'getMessages'
        }),
        isOnline() {
            const ids = this.userOnline.map(el => el.id)
            return ids.indexOf(_.get(this.conversation, 'participants.[0].user.id')) != -1
        },
        lastMessage() {
            if(this.messages.length) {
                return this.messages.slice(-1)[0]
            }
            return null
        },
        isReaded() {
            if(!this.lastMessage) {
                return false
            }
            const isSeen = _.get(this.lastMessage, 'readed', []).filter((el) => {
                return el.id != this.currentUser.id
            })[0] || null

            if(isSeen) {
                return true
            }
            return false
        }
    },
    methods: {
        ...mapMutations({
            setMessages: 'setMessages'
        }),
        ...mapActions({
            readMessage: 'readMessage'
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