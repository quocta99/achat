import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

const store = new Vuex.Store({
    state: {
        auth: '',
        conversations: [],
        conversationDetail: '',
        messages: [],
        userOnline: []
    },
    getters: {
        getAuth: state => {
            return state.auth
        },
        getConversations: state => {
            return state.conversations
        },
        getConversationDetail: state => {
            return state.conversationDetail
        },
        getMessages: state => {
            return state.messages
        },
        getUserOnline: state => {
            return state.userOnline
        }
    },
    mutations: {
        setAuth(state, payload) {
            state.auth = payload
        },
        setConversations(state, payload) {
            state.conversations = [...state.conversations, ...payload]
        },
        setConversationDetail(state, payload) {
            state.conversationDetail = payload
            state.messages = []
        },
        setMessages(state, payload) {
            state.messages = [...payload,...state.messages]
        },
        pushFirstConversation(state, payload) {
            const index = state.conversations.findIndex(el => el.id == payload.id)
            if(index == -1) {
                state.conversations = [payload, ...state.conversations]
            }else{
                state.conversations = [
                    payload,
                    ...state.conversations.slice(0, index),
                    ...state.conversations.slice(index + 1)
                ]
            }
        },
        readedConversation(state, payload) {
            const index = state.conversations.findIndex(el => el.id == payload)
            if(index != -1) {
                state.conversations = [
                    ...state.conversations.slice(0, index),
                    {
                        ...state.conversations[index],
                        unread: []
                    },
                    ...state.conversations.slice(index + 1)
                ]
            }
        },
        pushUnReadConversation(state, {conversation, message}) {
            const index = state.conversations.findIndex(el => el.id == conversation)
            if(index != -1) {
                state.conversations = [
                    ...state.conversations.slice(0, index),
                    {
                        ...state.conversations[index],
                        unread: [
                            ..._.get(state.conversations[index], 'unread', []),
                            message
                        ]
                    },
                    ...state.conversations.slice(index + 1)
                ]
            }
        },
        pushNewMessage(state, payload) {
            if(!!payload) {
                state.messages = [...state.messages, payload]
            }
        },
        setUserOnline(state, payload) {
            state.userOnline = payload
        },
        readedMessage(state, {message, user}) {
            if(state.messages.length) {
                const index = state.messages.findIndex(el => el.id == message)
                if(index != -1) {
                    state.messages = [
                        ...state.messages.slice(0, index),
                        {
                            ...state.messages[index],
                            readed: [...state.messages[index].readed, user]
                        },
                        ...state.messages.slice(index + 1)
                    ]
                }
            }
        }
    },
    actions: {
        pushMessageToConversations({dispatch, commit, state}, {conversation, message}) {
            const index = state.conversations.findIndex(el => el.id == conversation.id)
            if(index != -1) {
                conversation = state.conversations[index]
            }
            commit("pushFirstConversation", {
                ...conversation,
                last_message: message
            })
        },
        async readMessage({dispatch, commit, state}, conversation) {
            const res = await axios.post(`/chat/conversation/${conversation}/message/read`, {
                user_id: state.auth.id
            })

            if(res.status == 200) {
                commit("readedConversation", conversation)
            }
        }
    }
})

export default store