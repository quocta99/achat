<template>
    <div class="d-flex align-items-center p-2 border-top bg-white">
        <div class="input-group search">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    <i class="fal fa-images"></i>
                </span>
            </div>
            <input type="text" v-model="formData.message" @keyup.enter="handleSend" class="form-control" placeholder="Typing..." />
        </div>
        <button class="btn btn-primary ml-2 new-chat" @click="handleSend">
            <i class="fal fa-paper-plane"></i>
        </button>
    </div>
</template>

<script>
import { mapGetters, mapMutations } from 'vuex'
export default {
    data() {
        return {
            formData: {
                message: '',
                type: 'text'
            }
        }
    },
    mounted() {
        this.setOriginalData()
    },
    computed: {
        ...mapGetters({
            conversation: 'getConversationDetail'
        })  
    },
    methods: {
        ...mapMutations({
            pushNewMessage: 'pushNewMessage'
        }),
        async handleSend() {
            const response = await axios.post(`/chat/conversation/${this.conversation.id}/message/send`, {
                ...this.formData
            })
            this.setOriginalData()
            this.pushNewMessage(_.get(response, 'data.data', null))
        },
        setOriginalData() {
            this.formData = {
                message: '',
                type: 'text'
            }
        }
    }
}
</script>