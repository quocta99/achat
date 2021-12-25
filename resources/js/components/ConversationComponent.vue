<template>
    <div class="side-bar__item d-flex align-items-center p-3">
        <div class="avatar">
            <img width="50" height="50" :src="_.get(conversation, 'participants.[0].user.avatar')" class="img-fluid header-avatar mr-2 border" alt="" />
        </div>
        <div class="header-box flex-fill side-bar__item-content">
            <p class="header-name mb-0 d-inline-block text-truncate" v-text="_.get(conversation, 'participants.[0].user.name')"></p>
            <span class="mb-0 text-secondary d-inline-block text-truncate">
                {{ _.get(conversation, 'last_message.sender_id', -1) == currentUser.id ? 'You: ' : '' }}{{ _.get(conversation, 'last_message.message', '') }}
            </span>
        </div>
        <div class="time header-box ml-1">
            <span class="time__ago mb-1">{{ conversation.last_message_created_at | moment("from", "now") }}</span>
            <span class="badge badge-pill badge-danger" style="opacity: 0;">0</span>
        </div>
    </div>
</template>

<script>
export default {
    props: ['conversation']
}
</script>