<template>
    <div :class="{
        'message__item mt-3': true,
        'sender': currentUser.id ==  _.get(message, 'sender.id', -1)
    }">
        <div class="message__item-float d-flex">
            <div class="avatar">
                <img width="40" height="40" :src="_.get(message, 'sender.avatar', '')" class="img-fluid header-avatar mr-2 border" alt="" />
            </div>
            <div class="header-box flex-fill side-bar__item-content">
                <div class="message__item-content border">
                    <div class="text-type p-2 bg-white px-3" v-if="message.message_type == 'text'" v-text="message.message"></div>
                </div>
                <span class="mb-0 mt-1 text-secondary d-inline-block text-truncate">{{ currentUser.id !=  _.get(message, 'sender.id', -1) ? _.get(message, 'sender.name', '') : 'You' }}, {{ message.created_at | moment("from", "now") }}</span>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ['message']
}
</script>