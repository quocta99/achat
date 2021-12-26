import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

const store = new Vuex.Store({
    state: {
        auth: '',
        conversations: [],
        conversationDetail: '',
        messages: []
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
                    state.conversations[index],
                    ...state.conversations.slice(0, index),
                    ...state.conversations.slice(index + 1)
                ]
            }
        },
        pushNewMessage(state, payload) {
            if(!!payload) {
                state.messages = [...state.messages, payload]
            }
        }
    }
})

export default store