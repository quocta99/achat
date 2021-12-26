<template>
    <div :class="{
        'side-bar__item d-flex align-items-center p-3': true,
        'active': selected.id == conversation.id
    }" @click="handleSelectConversation">
        <div class="avatar">
            <img width="50" height="50" :src="_.get(conversation, 'participants.[0].user.avatar')" class="img-fluid header-avatar mr-2 border" alt="" />
            <div :class="classStatus"></div>
        </div>
        <div class="header-box flex-fill side-bar__item-content">
            <p class="header-name mb-0 d-inline-block text-truncate" v-text="_.get(conversation, 'participants.[0].user.name')"></p>
            <span class="mb-0 text-secondary d-inline-block text-truncate">
                {{ _.get(conversation, 'last_message.sender_id', -1) == currentUser.id ? 'You: ' : '' }} {{ type }} {{ _.get(conversation, 'last_message.message', '...') }}
            </span>
        </div>
        <div class="time header-box ml-1">
            <span class="time__ago mb-1">{{ _.get(conversation, 'last_message.created_at', null) | moment("from", "now") }}</span>
            <span class="badge badge-pill badge-danger" :style="conversation.unread == 0 ? 'opacity: 0;' : ''" v-text="conversation.unread.length"></span>
        </div>
    </div>
</template>

<script>
import { mapGetters, mapMutations } from 'vuex'
export default {
    props: ['conversation'],
    computed: {
        ...mapGetters({
            selected: 'getConversationDetail'
        }),
        classStatus() {
            const ids = this.userOnline.map(el => el.id)
            return `status ${ids.indexOf(_.get(this.conversation, 'participants.[0].user.id')) != -1 ? 'bg-success' : 'bg-danger'}`
        },
        type() {
            const type = _.get(this.conversation, 'last_message.message_type', 'text')
            if(!!type && type == 'text') {
                return ''
            }
            if(type == 'image') {
                return '[Image] '
            }
            return '[Media] '
        }
    },
    methods: {
        ...mapMutations({
            setConversationDetail: 'setConversationDetail'
        }),
        handleSelectConversation() {
            if(this.selected.id == this.conversation.id) {
                return false
            }
            this.setConversationDetail(this.conversation)
            window.history.pushState('', '', `#conversation_${this.conversation.id}`)
        }
    }
}
</script>