<template>
    <div class="modal fade" id="createNewChat" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="createNewChatLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header py-2 d-flex align-items-center">
                    <h5 class="modal-title" id="createNewChatLabel">Choose User?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="d-flex align-items-center">
                        <div class="input-group search">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fal fa-search text-secondary"></i>
                                </span>
                            </div>
                            <input type="text" v-model="keyword" class="form-control" placeholder="Search chat" />
                        </div>
                        <button @click="handleCreateConversation" class="btn btn-primary ml-2 new-chat" data-toggle="modal" data-target="#createNewChat">
                            <i class="fal fa-paper-plane"></i>
                        </button>
                    </div>
                    <div class="list-user mt-3 border">
                        <template v-for="(user, index) in users">
                            <user-component @select="handleSelected" :key="index" :user="user" :selected="selected" />
                        </template>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { mapMutations } from 'vuex'
export default {
    data() {
        return {
            users: [],
            keyword: '',
            selected: []
        }
    },
    async mounted() {
        await this.fetchUsers()
    },
    methods: {
        ...mapMutations({
            pushFirstConversation: 'pushFirstConversation'
        }),
        async fetchUsers(keyword = null) {
            const response = await axios.get('/chat/user', {
                params: {keyword}
            })

            this.users = _.get(response, 'data.data', [])
        },
        handleSelected(user) {
            this.selected = [user.id]
        },
        async handleCreateConversation() {
            const response = await axios.post('/chat/conversation/create', {
                participants: this.selected,
                setting: []
            })

            this.pushFirstConversation(_.get(response, 'data.data', null))
        }
    },
    watch: {
        keyword: _.debounce(async function(to, from) {
            await this.fetchUsers(to)
        }, 500)
    }
}
</script>