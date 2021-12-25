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
    }
})

export default store