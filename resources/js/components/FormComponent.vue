<template>
    <div class="p-2 border-top bg-white readed-form">
        <div class="readed bg-white border" v-if="typingData.typing && typingData.conversation.id == conversation.id">
            <span class="d-block">{{ typingData.user.name }} is typing a new message...</span>
        </div>
        <div :class="{'mb-2': true, 'd-none': !formData.image_review}">
            <div class="image-review">
                <div class="image-review__box">
                    <i class="fal fa-times-circle" @click="handleRemoveImage"></i>
                </div>
                <img :src="formData.image_review" accept="image/png,image/jpeg,image/bmp,image/gif" width="200" alt="..." class="img-thumbnail img-fluid height-auto">
            </div>
        </div>
        <div class="d-flex align-items-center">
            <span class="input-group-text new-chat" @click="$refs.image.click()" style="cursor: pointer;">
                <i class="fal fa-images"></i>
                <input type="file" name="" class="d-none" ref="image" @change="handleChooseImage" />
            </span>
            <div class="input-group search form-send-message">
                <textarea @keyup="isTyping" type="text" ref="input" @keyup.enter.exact="handleSend" v-model="formData.message" class="form-control" placeholder="Typing..." rows="1"></textarea>
            </div>
            <button class="btn btn-primary ml-2 new-chat" @click="handleSend">
                <i class="fal fa-paper-plane"></i>
            </button>
        </div>
    </div>
</template>

<script>
import { mapActions, mapGetters, mapMutations } from 'vuex'
export default {
    data() {
        return {
            formData: {
                message: '',
                type: 'text',
                image_review: '',
                file: ''
            },
            typingData: '',
            timeout: null
        }
    },
    created() {
        Echo.join('online-event')
            .listenForWhisper('typing', (e) => {
                clearTimeout(this.timeout)
                this.typingData = e

                this.timeout = setTimeout(() => {
                    this.typingData.typing = false
                }, 1000);
            });
    },
    mounted() {
        this.setOriginalData()
        let textarea = this.$refs.input;
        textarea.addEventListener("keyup", () => {
            textarea.style.height = this.calcHeight(textarea.value) + "px";
        });
    },
    computed: {
        ...mapGetters({
            conversation: 'getConversationDetail'
        })  
    },
    methods: {
        ...mapMutations({
            pushNewMessage: 'pushNewMessage',
        }),
        ...mapActions({
            pushMessageToConversations: 'pushMessageToConversations'
        }),
        async handleSend() {
            if(!this.formData.message) {
                return false
            }

            let payload = new FormData()
            payload.append('message', this.formData.message)
            payload.append('type', this.formData.type)
            if(this.formData.type != 'text') {
                payload.append('file', this.$refs.image.files[0])
            }

            const response = await axios.post(`/chat/conversation/${this.conversation.id}/message/send`, payload)
            this.setOriginalData()
            const message = _.get(response, 'data.data', null)
            if(!!message) {
                this.pushNewMessage(message)
                this.pushMessageToConversations({conversation: this.conversation, message})
            }
        },
        calcHeight(value) {
            let numberOfLineBreaks = (value.match(/\n/g) || []).length;
            // min-height + lines x line-height + padding + border
            let newHeight = 23 + numberOfLineBreaks * 23 + 12 + 2;
            return newHeight;
        },
        setOriginalData() {
            this.formData = {
                message: '',
                type: 'text'
            }
            this.$refs.input.focus()
        },
        handleChooseImage() {
            const image = this.$refs.image.files[0]

            const extention = image.type.split('/').pop().toLowerCase();
            if (extention != "jpeg" && extention != "jpg" && extention != "png" && extention != "bmp" && extention != "gif") {
                this.$refs.image.value = ""
                return false;
            }
            
            const reader = new FileReader()
            reader.onload = () => {
                this.formData = {
                    ...this.formData,
                    image_review: reader.result,
                    file: image,
                    type: 'image'
                }

                this.$refs.input.focus()
                this.$refs.input.value = this.$refs.input.value 
            }
            reader.readAsDataURL(image)
        },
        handleRemoveImage() {
            this.formData = {
                ...this.formData,
                image_review: '',
                file: '',
                type: 'text'
            }
        },
        isTyping() {
            let channel = Echo.join('online-event');

            channel.whisper('typing', {
                conversation: this.conversation,
                user: this.currentUser,
                typing: true
            });
        },
    }
}
</script>