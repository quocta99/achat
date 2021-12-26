<template>
    <div class="row m-0 h-100">
        <div class="col-xl-3 col-lg-5 col-md-5 col-sm-12 p-0 bg-white h-100 border-right d-flex flex-column">
            <header-component>
                <slot name="logout" />
            </header-component>
            <div class="side-bar flex-fill d-flex flex-column hidden-scrollbar">
                <template v-for="(conversation, index) in conversations">
                    <conversation-component :key="index" :conversation="conversation" />
                </template>
                <infinite-loading @infinite="infiniteHandler"></infinite-loading>
            </div>
        </div>
        <div v-if="!selected" class="col-xl-9 bg-white col-lg-7 col-md-7 col-sm-0 p-0 d-flex flex-column align-items-center justify-content-center h-100">
            <div class="no-content d-flex flex-column align-items-center">
                <span class="mb-2">
                    <i class="fal fa-ballot text-secondary" style="font-size: 7rem"></i>
                </span>
                <p class="text-secondary mb-0">No conversation selected?</p>
            </div>
        </div>
        <detail-conversation-component :key="_.get(selected, 'id', -1)" v-else />
    </div>
</template>

<script>
    import {mapActions, mapGetters, mapMutations} from 'vuex'

    export default {
        props: ['auth'],
        data() {
            return {
                last_conversation_id: null
            }
        },
        created() {
            Echo.private(`message-event.${this.auth.id}`)
                .listen('MessageEvent', ({message, payload}) => {
                    if(!!this.selected && this.selected.id == payload.conversation_id) {
                        this.pushNewMessage(payload)
                        this.pushMessageToConversations({
                            conversation: this.selected,
                            message: payload
                        })
                        this.readMessage()
                    }else {
                        this.pushMessageToConversations({
                            conversation: payload.conversation, 
                            message: payload
                        })
                        this.pushUnReadConversation({
                            conversation: payload.conversation_id,
                            message: payload.id
                        })
                    }
                });

            Echo.join('online-event')
                .here((users) => {
                    this.setUserOnline(users)
                })
                .joining((user) => {
                    this.setUserOnline([...this.userOnline, user])
                    console.log(user);
                })
                .leaving((user) => {
                    const index = this.userOnline.findIndex(el => el.id == user.id)
                    if(index != -1) {
                        this.setUserOnline([
                            ...this.userOnline.slice(0, index),
                            ...this.userOnline.slice(index + 1)
                        ])
                    }
                })
                .error((error) => {
                    console.error(error);
                });
        },
        async mounted() {
            this.setAuth(this.auth)
            try {
                const conversaionID = window.location.hash.replace('#conversation_', '')
                if(!!conversaionID && conversaionID != undefined) {
                    const res = await axios.get(`/chat/conversation/${conversaionID}`)
                    if(_.get(res, 'data.data')) {
                        this.setConversationDetail(_.get(res, 'data.data', ''))
                    }
                }
            } catch (error) {
                console.log('error', error);
            }
        },
        computed: {
            ...mapGetters({
                conversations: 'getConversations',
                selected: 'getConversationDetail'
            })
        },
        methods: {
            ...mapMutations({
                setAuth: 'setAuth',
                setConversations: 'setConversations',
                setConversationDetail: 'setConversationDetail',
                pushNewMessage: 'pushNewMessage',
                setUserOnline: 'setUserOnline',
                pushUnReadConversation: 'pushUnReadConversation'
            }),
            ...mapActions({
                pushMessageToConversations: 'pushMessageToConversations',
                readMessage: 'readMessage'
            }),
            async fetchConversations(query = {}) {
                return await axios.get('/chat/conversation', query)
            },
            async infiniteHandler($state) {
                const res = await axios.get('/chat/conversation', this.last_conversation_id ? {
                    params: {
                        last_conversation_id: this.last_conversation_id
                    }
                } : {})
                if(!!res.data) {
                    this.setConversations(_.get(res, 'data.data.conversations', []))
                    this.last_conversation_id = _.get(res, 'data.data.last_conversation_id', null)
                }
                $state.loaded()
                if(_.get(res, 'data.data.conversations', []).length == 0) {
                    $state.complete()
                }
            }
        }
    }
</script>
