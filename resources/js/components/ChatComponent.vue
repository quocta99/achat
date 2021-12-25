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
        <no-message-component />
        <!-- <detail-conversation-component /> -->
    </div>
</template>

<script>
    import {mapGetters, mapMutations} from 'vuex'

    export default {
        props: ['auth'],
        data() {
            return {
                last_conversation_id: null
            }
        },
        async mounted() {
            this.setAuth(this.auth)
        },
        computed: {
            ...mapGetters({
                conversations: 'getConversations'
            })
        },
        methods: {
            ...mapMutations({
                setAuth: 'setAuth',
                setConversations: 'setConversations'
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
